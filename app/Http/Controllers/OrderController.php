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

        $orderHistory = $orders->map(function ($order) {
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
        $pesanan->delivery_address = $request->input('pickup_method') === 'Delivery' ? $request->input('delivery_address') : null;
        $pesanan->shipping_cost = $request->input('pickup_method') === 'Delivery' ? 10000 : 0;

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

        $data = $orders->map(function ($order) {
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

            $orderHistory = $orders->map(function ($order) {
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

        $pesanan = $orders->map(function ($order) {
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
            round((($penjualanHarian - $penjualanHarianSebelumnya) / $penjualanHarianSebelumnya) * 100, 2);

        // Laporan penjualan mingguan
        $penjualanMingguan = Pesanan::where('status', 'Completed')
            ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_amount');

        $penjualanMingguanSebelumnya = Pesanan::where('status', 'Completed')
            ->whereBetween('updated_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->sum('total_amount');

        $perubahanPenjualanMingguan = $penjualanMingguanSebelumnya == 0 ?
            ($penjualanMingguan > 0 ? 100 : 0) :
            round((($penjualanMingguan - $penjualanMingguanSebelumnya) / $penjualanMingguanSebelumnya) * 100, 2);

        // Laporan penjualan bulanan
        $penjualanBulanan = Pesanan::where('status', 'Completed')
            ->whereMonth('updated_at', now()->month)
            ->sum('total_amount');

        $penjualanBulananSebelumnya = Pesanan::where('status', 'Completed')
            ->whereMonth('updated_at', now()->subMonth()->month)
            ->sum('total_amount');

        $perubahanPenjualanBulanan = $penjualanBulananSebelumnya == 0 ?
            ($penjualanBulanan > 0 ? 100 : 0) :
            round((($penjualanBulanan - $penjualanBulananSebelumnya) / $penjualanBulananSebelumnya) * 100, 2);

        return view('admin.data-penjualan', compact(
            'pesananSelesai',
            'penjualanHarian',
            'penjualanHarianSebelumnya',
            'perubahanPenjualanHarian',
            'penjualanMingguan',
            'penjualanMingguanSebelumnya',
            'perubahanPenjualanMingguan',
            'penjualanBulanan',
            'penjualanBulananSebelumnya',
            'perubahanPenjualanBulanan'
        ));
    }
    public function payOrder($id)
    {
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
        $rules = [
            'status' => 'required|string',
        ];

        if ($pesanan->payment_method !== 'Cash') {
            $rules['status_payment_proof'] = 'required|string';
        }

        $request->validate($rules);

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
            'status_payment_proof' => $pesanan->payment_method !== 'Cash' ? $request->input('status_payment_proof') : 'Pending',
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
            $orderId = $pesanan->id;
            $userName = $pesanan->user->name;

            $statusMessage = '';
            $title = '';

            if ($pesanan->status_payment_proof === 'Accepted') {
                $title = "Pesanan #$orderId - Pembayaran Diterima";
                $statusMessage = "Halo $userName!\n\nPembayaran pesanan #$orderId telah diterima dan diverifikasi.\nPesanan akan segera diproses.";
            } elseif ($pesanan->status_payment_proof === 'Rejected') {
                $title = "Pesanan #$orderId - Pembayaran Ditolak";
                $statusMessage = "Halo $userName!\n\nBukti pembayaran pesanan #$orderId ditolak.\nSilakan upload ulang bukti pembayaran yang benar.";
            } else {
                $title = "Pesanan #$orderId - Verifikasi Pembayaran";
                $statusMessage = "Halo $userName!\n\nBukti pembayaran pesanan #$orderId sedang diverifikasi.\nProses verifikasi: 5-10 menit.";
            }

            Notification::create([
                'user_id' => $pesanan->user_id,
                'order_id' => $pesanan->id,
                'title' => $title,
                'message' => $statusMessage,
                'type' => 'status_bukti_pembayaran',
            ]);
        }

        // Buat notifikasi berdasarkan perubahan status pesanan
        if ($previousOrderStatus !== $pesanan->status) {
            $orderId = $pesanan->id;
            $userName = $pesanan->user->name;
            $pickupMethod = $pesanan->pickup_method == 'Pickup' ? 'diambil' : 'dikirim';

            // Format tanggal pengiriman
            $deliveryDate = '';
            if ($pesanan->delivery_date) {
                $date = Carbon::parse($pesanan->delivery_date);

                $dayNames = [
                    'Sunday' => 'Minggu',
                    'Monday' => 'Senin',
                    'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis',
                    'Friday' => 'Jumat',
                    'Saturday' => 'Sabtu'
                ];

                $monthNames = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember'
                ];

                $dayName = $dayNames[$date->format('l')];
                $day = $date->day;
                $monthName = $monthNames[$date->month];
                $year = $date->year;

                $deliveryDate = "$dayName, $day $monthName $year";
            }

            switch ($request->input('status')) {
                case 'Processed':
                    $title = "Pesanan #$orderId - Sedang Dimasak";
                    $message = "Halo $userName!\n\nPesanan #$orderId sedang dimasak." .
                        ($deliveryDate ? "\nJadwal $pickupMethod: $deliveryDate" : "");
                    break;

                case 'Completed':
                    if ($pesanan->pickup_method == 'Pickup') {
                        $title = "Pesanan #$orderId - Siap Diambil";
                        $message = "Pesanan #$orderId siap diambil!\n\nSilakan datang ke lokasi Katering Ibu" .
                            ($deliveryDate ? "\nTanggal: $deliveryDate" : "") .
                            "\nJam operasional: 08.00 - 20.00 WIB";
                    } else {
                        $title = "Pesanan #$orderId - Siap Dikirim";
                        $message = "Pesanan #$orderId siap dikirim!\n\nKurir sedang dalam perjalanan" .
                            ($deliveryDate ? "\nTanggal: $deliveryDate" : "") .
                            "\nPastikan nomor HP dapat dihubungi";
                    }
                    break;

                case 'Cancelled':
                    $title = "Pesanan #$orderId - Dibatalkan";
                    $message = "Pesanan #$orderId telah dibatalkan.\n\nHubungi kami untuk info lebih lanjut:\n0812-3456-7890";
                    break;

                default:
                    $title = "Pesanan #$orderId - Update Status";
                    $message = "Status pesanan #$orderId: " . $pesanan->status;
                    break;
            }

            Notification::create([
                'user_id' => $pesanan->user_id,
                'order_id' => $pesanan->id,
                'title' => $title,
                'message' => $message,
                'type' => 'status_pesanan',
            ]);
        }

        // SIMPAN STATUS LAMA
        $previousOrderStatus = $pesanan->status;

        // UPDATE PESANAN
        $pesanan->update([
            'status' => $request->input('status'),
            'delivery_date' => $request->input('delivery_date') ? Carbon::parse($request->input('delivery_date'))->format('Y-m-d') : null,
            'status_payment_proof' => $pesanan->payment_method !== 'Cash' ? $request->input('status_payment_proof') : 'Pending',
        ]);

        // BUAT NOTIFIKASI JIKA STATUS BERUBAH
        if ($previousOrderStatus !== $pesanan->status) {
            $this->createOrderStatusNotification($pesanan, $previousOrderStatus, $pesanan->status);
        }

        return redirect()->route('admin.data-pesanan')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }

    private function createOrderStatusNotification($pesanan, $oldStatus, $newStatus)
    {
        $userName = $pesanan->user->name;

        // Format tanggal pengiriman yang user-friendly
        $deliveryDate = '';
        if ($pesanan->delivery_date) {
            $date = Carbon::parse($pesanan->delivery_date);

            // Nama hari dalam bahasa Indonesia
            $dayNames = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];

            // Nama bulan dalam bahasa Indonesia
            $monthNames = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            ];

            $dayName = $dayNames[$date->format('l')];
            $day = $date->day;
            $monthName = $monthNames[$date->month];
            $year = $date->year;

            // Format: "Senin, 5 Juni 2025"
            $deliveryDate = "$dayName, $day $monthName $year";
        }

        $statusMessages = [
            'Pending' => "Halo $userName! 👋\n\n🕒 Pesanan Anda telah kami terima dan sedang menunggu konfirmasi.\n\n📞 Tim kami akan segera menghubungi Anda untuk konfirmasi!",

            'Processed' => "Kabar gembira $userName! 🎉\n\n👨‍🍳 Pesanan Anda sedang dimasak dengan bahan-bahan segar pilihan.\n\n⏰" .
                ($deliveryDate ? "\n📅 Dijadwalkan untuk: $deliveryDate" : ""),

            'Completed' => $pesanan->pickup_method === 'delivery' ?
                "Pesanan siap dikirim $userName! 🚚✨\n\n📦 Makanan lezat Anda sudah jadi dan akan segera diantar!\n📅 Pengiriman: $deliveryDate\n\n🛵 Kurir kami sedang dalam perjalanan menuju lokasi Anda\n📞 Mohon pastikan nomor telepon dapat dihubungi\n\n🙏 Terima kasih telah mempercayai Katering Ibu!" :
                "Pesanan siap $userName! 🍽️✨\n\n🎊 Makanan lezat Anda sudah jadi dan siap diambil!\n📅 Siap diambil: $deliveryDate\n📍 Silakan datang ke lokasi kami\n\n🙏 Terima kasih telah mempercayai Katering Ibu!",

            'Cancelled' => "Maaf $userName 😔\n\n❌ Pesanan #$pesanan->id dibatalkan\n💬 Hubungi kami di WhatsApp untuk info lebih lanjut\n\n🔄 Kami siap melayani pesanan Anda kapan saja!"
        ];

        $statusTitles = [
            'Pending' => "🕒 Pesanan #$pesanan->id - Menunggu Konfirmasi",
            'Processed' => "👨‍🍳 Pesanan #$pesanan->id - Sedang Dimasak",
            'Completed' => $pesanan->pickup_method === 'delivery' ?
                "🚚 Pesanan #$pesanan->id - Siap Dikirim!" :
                "🍽️ Pesanan #$pesanan->id - Siap Diambil!",
            'Cancelled' => "❌ Pesanan #$pesanan->id - Dibatalkan",
        ];

        if (isset($statusMessages[$newStatus]) && isset($statusTitles[$newStatus])) {
            Notification::create([
                'user_id' => $pesanan->user_id,
                'order_id' => $pesanan->id,
                'title' => $statusTitles[$newStatus] . " - Pesanan #$pesanan->id",
                'message' => $statusMessages[$newStatus],
                'type' => 'status_pesanan',
            ]);

            Log::info('Order status notification created with delivery date', [
                'order_id' => $pesanan->id,
                'user_id' => $pesanan->user_id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'delivery_date' => $deliveryDate,
                'pickup_method' => $pesanan->pickup_method
            ]);
        }
    }

    private function createPaymentStatusNotification($pesanan, $oldStatus, $newStatus)
    {
        $statusMessages = [
            'Pending' => 'Bukti pembayaran Anda sedang dalam proses verifikasi',
            'Accepted' => 'Bukti pembayaran Anda telah diterima dan diverifikasi. Pesanan akan segera diproses.',
            'Rejected' => 'Bukti pembayaran Anda ditolak. Silakan upload ulang bukti pembayaran yang valid.',
        ];

        $statusTitles = [
            'Pending' => 'Verifikasi Pembayaran',
            'Accepted' => 'Pembayaran Diterima',
            'Rejected' => 'Pembayaran Ditolak',
        ];

        if (isset($statusMessages[$newStatus]) && isset($statusTitles[$newStatus])) {
            Notification::create([
                'user_id' => $pesanan->user_id,
                'order_id' => $pesanan->id,
                'title' => $statusTitles[$newStatus] . ' - Pesanan #' . $pesanan->id,
                'message' => $statusMessages[$newStatus],
                'type' => 'status_bukti_pembayaran',
            ]);

            Log::info('Payment status notification created', [
                'order_id' => $pesanan->id,
                'user_id' => $pesanan->user_id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
            ]);
        }
    }
}
