<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Notification;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\ItemPesanan;
use Illuminate\Http\Request;
use App\Models\KeranjangItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // Menampilkan halaman detail menu

    public function dashboard()
    {
    $orders = Pesanan::where('user_id', Auth::id())->with('items.menu')->orderBy('created_at', 'desc')->limit(4)->get();
    
    $orderHistory = $orders->map(function($order) {
        return [
            'id' => $order->id,
            'created_date' => Carbon::parse($order->created_at)->format('d M Y'),
            'menus' => $order->items->pluck('menu.nama_menu')->toArray(),
            'portions' => $order->items->pluck('quantity')->toArray(),
            'total_price' => $order->total_amount,
            'pickup_method' => $order->pickup_method,
            'address' => $order->delivery_address,
            'payment_method' => $order->payment_method,
            'status' => $order->status ?? 'Pending', // Asumsi ada kolom status
            'payment_proof' => $order->payment_proof, // Kolom bukti pembayaran
            'delivery_date' => $order->delivery_date, // Kolom tanggal pengiriman
        ];
    });
    
    return view('customer.dashboard', compact('orderHistory'));
    }

    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->route('menu')->with('error', 'Menu tidak ditemukan.');
        }

        // Mengatur nama dasar menu dan variasi
        $baseMenuName = '';
        if (strpos($menu->nama_menu, 'Nasi Liwet') !== false) {
            $baseMenuName = 'Nasi Liwet';
        } elseif (strpos($menu->nama_menu, 'Nasi Kuning') !== false) {
            $baseMenuName = 'Nasi Kuning';
        }

        // Mengambil menu varian berdasarkan nama dasar menu
        if ($baseMenuName) {
            $variantMenu = Menu::where('nama_menu', 'like', '%' . $baseMenuName . '%')
                            ->where('id', '!=', $id)
                            ->take(4)
                            ->get();
        } else {
            $variantMenu = collect();
        }

        // Mengambil menu rekomendasi yang tidak termasuk dalam varian menu
        $recommendedMenu = Menu::where('id', '!=', $id)
                            ->where('nama_menu', 'like', '%' . $baseMenuName . '%')
                            ->orWhere(function ($query) use ($baseMenuName) {
                                if ($baseMenuName) {
                                    $query->where('nama_menu', 'not like', '%' . $baseMenuName . '%');
                                }
                            })
                            ->take(4)
                            ->get();

        // Mengambil menu terlaris (top 4)
        $topMenus = Menu::orderBy('terjual', 'desc')->take(4)->pluck('id')->toArray();

        return view('order-now', compact('menu', 'variantMenu', 'recommendedMenu', 'topMenus'));
    }

    // Menampilkan halaman pesanan detail
    public function showOrderDetail()
    {
        $keranjang = Keranjang::where('user_id', Auth::id())->with('items.menu')->first();
        $cartItems = $keranjang ? $keranjang->items : collect();
        return view('customer.pesanan-detail', compact('cartItems'));
    }

    // Memproses pesanan
    public function processOrder(Request $request)
    {
        $keranjang = Keranjang::where('user_id', Auth::id())->first();

        $pesanan = new Pesanan();
        $pesanan->user_id = Auth::id();
        $pesanan->payment_method = $request->input('payment_method');
        $pesanan->pickup_method = $request->input('pickup_method');
        $pesanan->delivery_address = $request->input('pickup_method') === 'delivery' ? $request->input('delivery_address') : null;
        $pesanan->shipping_cost = $request->input('pickup_method') === 'delivery' ? 10000 : 0;

        // Hitung total amount sebelum menyimpan pesanan
        $pesanan->total_amount = $this->calculateTotalAmount($keranjang, $pesanan->shipping_cost);
        $pesanan->save();

        foreach (KeranjangItem::where('keranjang_id', $keranjang->id)->with('menu')->get() as $cartItem) {
            $itemPesanan = new ItemPesanan();
            $itemPesanan->pesanan_id = $pesanan->id;
            $itemPesanan->menu_id = $cartItem->menu_id;
            $itemPesanan->quantity = $cartItem->jumlah; // Pastikan 'quantity' tidak null
            $itemPesanan->price = $cartItem->menu->harga; // Pastikan 'price' tidak null
            $itemPesanan->save();
        }

        KeranjangItem::where('keranjang_id', $keranjang->id)->delete();

        return redirect()->route('customer.order-history')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function store(Request $request)
    {
        $keranjang = Keranjang::firstOrCreate(['user_id' => Auth::id()]);

        $menu = Menu::find($request->menu_id);
        $jumlah = $request->jumlah;

        // Cari item yang sudah ada di keranjang
        $keranjangItem = KeranjangItem::where('keranjang_id', $keranjang->id)
                                    ->where('menu_id', $menu->id)
                                    ->first();

        if ($keranjangItem) {
            // Jika item sudah ada, tambahkan jumlah dan perbarui total harga item
            $keranjangItem->jumlah += $jumlah;
            $keranjangItem->total_harga_item += $menu->harga * $jumlah;
            $keranjangItem->save();
        } else {
            // Jika item belum ada, buat item baru
            KeranjangItem::create([
                'keranjang_id' => $keranjang->id,
                'menu_id' => $menu->id,
                'jumlah' => $jumlah,
                'harga' => $menu->harga,
                'total_harga_item' => $menu->harga * $jumlah,
            ]);
        }

        // Perbarui total harga keranjang
        $totalHarga = $keranjang->items->sum('total_harga_item');
        $keranjang->update(['total_harga' => $totalHarga]);

        // Arahkan ke halaman detail pesanan
        return redirect()->route('order.detail', $keranjang->id)->with('success', 'Pesanan berhasil dilakukan.');
    }

    
    // Menghitung total jumlah pesanan
    private function calculateTotalAmount($keranjang, $shippingCost)
    {
        $totalAmount = 0;
        $cartItems = KeranjangItem::where('keranjang_id', $keranjang->id)->with('menu')->get();
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->jumlah * $cartItem->menu->harga;
        }
        return $totalAmount + $shippingCost;
    }

    // Menampilkan riwayat pesanan
    public function orderHistory()
    {
        $orders = Pesanan::where('user_id', Auth::id())->with('items.menu')->orderBy('created_at', 'desc')->get();
        
        $data = $orders->map(function($order) {
            return [
                'id' => $order->id,
                'created_date' => $order->created_at->format('d M Y'),
                'menus' => $order->items->pluck('menu.nama_menu')->toArray(),
                'portions' => $order->items->pluck('quantity')->toArray(),
                'total_price' => $order->total_amount,
                'pickup_method' => $order->pickup_method,
                'address' => $order->delivery_address,
                'payment_method' => $order->payment_method,
                'status' => $order->status ?? 'Pending', // Asumsi ada kolom status
                'payment_proof' => $order->payment_proof, // Kolom bukti pembayaran
                'status_payment_proof' => $order->status_payment_proof ?? 'Pending', // Asumsi ada kolom status
                'delivery_date' => $order->delivery_date, // Kolom tanggal pengiriman
            ];
        });
        
        return view('customer.order-history', compact('data')); // Pastikan 'data' diteruskan ke view
    }

    public function getCartItemTypesCount()
{
    if (Auth::check()) {
        $itemTypesCount = KeranjangItem::whereHas('keranjang', function ($query) {
            $query->where('user_id', Auth::id());
        })->distinct('menu_id')->count('menu_id');
        return $itemTypesCount;
    }

    return 0;
    }

    public function getOrderHistory()
    {
        if (Auth::check()) {
            $orders = Pesanan::where('user_id', Auth::id())->with('items.menu')->orderBy('created_at', 'desc')->get();

            $orderHistory = $orders->map(function($order) {
                return [
                    'id' => $order->id,
                    'created_date' => Carbon::parse($order->created_at)->format('d M Y'),
                    'menus' => $order->items->pluck('menu.nama_menu')->toArray(),
                    'portions' => $order->items->pluck('quantity')->toArray(),
                    'total_price' => $order->total_amount,
                    'pickup_method' => $order->pickup_method,
                    'address' => $order->delivery_address,
                    'payment_method' => $order->payment_method,
                    'status' => $order->status ?? 'Pending', // Asumsi ada kolom status
                    'payment_proof' => $order->payment_proof, // Kolom bukti pembayaran
                    'delivery_date' => $order->delivery_date, // Kolom tanggal pengiriman
                ];
            });
            return $orderHistory;
        }
        return collect();
    }

    public function dataPesanan()
    {
        $jmlPesanan = Pesanan::count();
        $orders = Pesanan::with('user', 'items.menu')->orderBy('created_at', 'desc')->get();
        
        $pesanan = $orders->map(function($order) {
            return [
                'id' => $order->id,
                'created_date' => $order->created_at->format('d M Y'),
                'name' => $order->user->name,
                'foto_profile' => $order->user->foto_profile,
                'email' => $order->user->email,
                'menus' => $order->items->pluck('menu.nama_menu')->toArray(),
                'portions' => $order->items->pluck('quantity')->toArray(),
                'total_price' => $order->total_amount,
                'pickup_method' => $order->pickup_method,
                'address' => $order->delivery_address,
                'payment_method' => $order->payment_method,
                'status' => $order->status ?? 'Pending', // Kolom status
                'payment_proof' => $order->payment_proof, // Kolom bukti pembayaran
                'status_payment_proof' => $order->status_payment_proof ?? 'Pending', // Kolom status
                'delivery_date' => $order->delivery_date, // Kolom tanggal pengiriman
            ];
        });

        return view('admin.data-pesanan', compact('pesanan', 'jmlPesanan'));
    }

    // Menampilkan halaman data penjualan (penjualan)
    public function penjualan()
    {
        // Ambil pesanan dengan status 'Completed'
        $pesananSelesai = Pesanan::with('items.menu', 'user')
            ->where('status', 'Completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Laporan penjualan harian
        $penjualanHarian = Pesanan::where('status', 'Completed')
            ->whereDate('updated_at', today())
            ->sum('total_amount');

        $penjualanHarianSebelumnya = Pesanan::where('status', 'Completed')
            ->whereDate('updated_at', today()->subDay())
            ->sum('total_amount');

        $perubahanPenjualanHarian = $penjualanHarianSebelumnya == 0 ? 
            ($penjualanHarian > 0 ? 100 : 0) : 
            round((($penjualanHarian - $penjualanHarianSebelumnya) / $penjualanHarianSebelumnya) * 100, 2) ;

        // Laporan penjualan mingguan
        $penjualanMingguan = Pesanan::where('status', 'Completed')
            ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_amount');

        $penjualanMingguanSebelumnya = Pesanan::where('status', 'Completed')
            ->whereBetween('updated_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->sum('total_amount');

        $perubahanPenjualanMingguan = $penjualanMingguanSebelumnya == 0 ? 
            ($penjualanMingguan > 0 ? 100 : 0) : 
            round((($penjualanMingguan - $penjualanMingguanSebelumnya) / $penjualanMingguanSebelumnya) * 100, 2) ;

        // Laporan penjualan bulanan
        $penjualanBulanan = Pesanan::where('status', 'Completed')
            ->whereMonth('updated_at', now()->month)
            ->sum('total_amount');

        $penjualanBulananSebelumnya = Pesanan::where('status', 'Completed')
            ->whereMonth('updated_at', now()->subMonth()->month)
            ->sum('total_amount');

        $perubahanPenjualanBulanan = $penjualanBulananSebelumnya == 0 ? 
            ($penjualanBulanan > 0 ? 100 : 0) : 
            round((($penjualanBulanan - $penjualanBulananSebelumnya) / $penjualanBulananSebelumnya) * 100, 2) ;

        return view('admin.data-penjualan', compact(
            'pesananSelesai', 
            'penjualanHarian', 'penjualanHarianSebelumnya', 'perubahanPenjualanHarian',
            'penjualanMingguan', 'penjualanMingguanSebelumnya', 'perubahanPenjualanMingguan',
            'penjualanBulanan', 'penjualanBulananSebelumnya', 'perubahanPenjualanBulanan'
        ));
    }
    public function payOrder($id) {
        $pesanan = Pesanan::findOrFail($id);
        return view('customer.detail-pembayaran', compact('pesanan'));
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
        ]);

        // Simpan file yang diunggah
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof')->store('payment_proofs', 'public');

            // Hapus bukti pembayaran lama jika ada
            $pesanan = Pesanan::findOrFail($id);
            if ($pesanan->payment_proof && Storage::exists('public/payment_proofs/' . $pesanan->payment_proof)) {
                Storage::delete('public/payment_proofs/' . $pesanan->payment_proof);
            }

            // Update database
            $pesanan->payment_proof = basename($file);
            $pesanan->save();

            return redirect()->route('customer.order-history')->with('success', 'Bukti pembayaran berhasil diunggah.');
        }

        return redirect()->route('customer.order-history')->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    // ? update data pesanan
    public function edit(Pesanan $pesanan)
    {
        $pesanan->load('user', 'items.menu');
        return view('admin.edit-pesanan', compact('pesanan'));
    }

public function update(Request $request, Pesanan $pesanan)
{
    // Validasi umum
    $request->validate([
        'status' => 'required|string',
        'status_payment_proof' => 'required|string',
    ]);

    // Validasi tambahan hanya jika status pesanan adalah Completed atau Delivered
    if (in_array($request->input('status'), ['Completed'])) {
        $request->validate([
            'delivery_date' => 'required|date',
        ]);
    }

    // Dapatkan status sebelumnya
    $previousPaymentStatus = $pesanan->status_payment_proof;
    $previousOrderStatus = $pesanan->status;

    // Perbarui pesanan
    $pesanan->update([
        'status' => $request->input('status'),
        'delivery_date' => $request->input('delivery_date') ? Carbon::parse($request->input('delivery_date'))->format('Y-m-d') : null,
        'status_payment_proof' => $request->input('status_payment_proof'),
    ]);

    // Jika status berubah menjadi Completed, perbarui terjual pada setiap menu
    if ($previousOrderStatus !== 'Completed' && $pesanan->status === 'Completed') {
        foreach ($pesanan->items as $item) {
            $menu = $item->menu;
            $menu->increment('terjual', $item->quantity);
        }
    }

    // Buat notifikasi berdasarkan perubahan status bukti pembayaran
    if ($previousPaymentStatus !== $pesanan->status_payment_proof) {
        $statusMessage = '';
    
        if ($pesanan->status_payment_proof === 'Accepted') {
            $statusMessage = 'diterima';
        } elseif ($pesanan->status_payment_proof === 'Rejected') {
            $statusMessage = 'ditolak';
        } else {
            $statusMessage = $pesanan->status_payment_proof; // Jika ada status lain
        }
    
        Notification::create([
            'user_id' => $pesanan->user_id,
            'title' => 'Perubahan Status Bukti Pembayaran',
            'message' => 'Status bukti pembayaran Anda ' . $statusMessage,
            'type' => 'status_bukti_pembayaran',
        ]);
    }
    

    // Buat notifikasi berdasarkan perubahan status pesanan
    if ($previousOrderStatus !== $pesanan->status) {
        $pickupMethod = $pesanan->pickup_method == 'Pickup' ? 'ambil langsung' : 'dikirim ke lokasi';
        $paymentMethod = $pesanan->payment_method;
    
        switch ($request->input('status')) {
            case 'Processed':
                $title = 'Pesanan Sedang Dikerjakan';
                if ($paymentMethod === 'Transfer') {
                    $message = 'Pesanan Anda sedang dikerjakan. Kami akan segera memberitahukan Anda ketika pesanan siap ' . $pickupMethod . '.';
                } else {
                    $message = 'Pesanan Anda sedang dikerjakan. Kami akan segera memberitahukan Anda ketika pesanan siap ' . $pickupMethod . '.';
                }
                break;
            case 'Completed':
                $title = 'Pesanan Berhasil Diproses';
                if ($paymentMethod === 'Transfer') {
                    if($pesanan->pickup_method == 'Pickup') {
                        $message = 'Pembayaran Anda telah berhasil diverifikasi. Silahkan ambil pesanan Anda';
                    } else {
                        $message = 'Pembayaran Anda telah berhasil diverifikasi. Pesanan Anda kini sedang dalam proses untuk ' . $pickupMethod . '.';
                    }
                } else {
                    $message = 'Pesanan Anda kini sedang dalam proses untuk ' . $pickupMethod . '.';
                }
                break;
            case 'Cancelled':
                $title = 'Pesanan Dibatalkan';
                $message = 'Pesanan Anda telah dibatalkan. Silakan hubungi kami jika ada pertanyaan lebih lanjut.';
                break;
            default:
                $title = 'Status Pesanan Diperbarui';
                $message = 'Status pesanan Anda telah berubah menjadi ' . $pesanan->status . '.';
                break;
        }
        Notification::create([
            'user_id' => $pesanan->user_id,
            'title' => $title,
            'message' => $message,
            'type' => 'status_pesanan',
        ]);
    }    

    return redirect()->route('admin.data-pesanan')->with('success', 'Pesanan berhasil diperbarui.');
}
    
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
