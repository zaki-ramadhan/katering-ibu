<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\ItemPesanan;
use Illuminate\Http\Request;
use App\Models\KeranjangItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan halaman detail menu
    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->route('menu')->with('error', 'Menu tidak ditemukan.');
        }

        $baseMenuName = '';

        if (strpos($menu->nama_menu, 'Nasi Liwet') !== false) {
            $baseMenuName = 'Nasi Liwet';
        } elseif (strpos($menu->nama_menu, 'Nasi Kuning') !== false) {
            $baseMenuName = 'Nasi Kuning';
        }

        if ($baseMenuName) {
            $variantMenu = Menu::where('nama_menu', 'like', '%' . $baseMenuName . '%')
                               ->where('id', '!=', $id)
                               ->take(4)
                               ->get();
        } else {
            $variantMenu = collect();
        }

        $recommendedMenu = Menu::where('id', '!=', $id)
                               ->when($baseMenuName, function ($query) use ($baseMenuName) {
                                   return $query->where('nama_menu', 'not like', '%' . $baseMenuName . '%');
                               })
                               ->take(4)
                               ->get();

        return view('order-now', compact('menu', 'variantMenu', 'recommendedMenu'));
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

        return redirect()->route('customer.order-history')->with('success', 'Pesanan berhasil diproses.');
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
                'created_date' => $order->created_at->format('d M Y'),
                'menus' => $order->items->pluck('menu.nama_menu')->toArray(),
                'portions' => $order->items->pluck('quantity')->toArray(),
                'total_price' => $order->total_amount,
                'pickup_method' => $order->pickup_method,
                'address' => $order->delivery_address,
                'payment_method' => $order->payment_method,
                'status' => $order->status ?? 'Pending', // Asumsi ada kolom status
            ];
        });
        
        return view('customer.order-history', compact('data')); // Pastikan 'data' diteruskan ke view
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
                'status' => $order->status ?? 'Pending', // Asumsi ada kolom status
            ];
        });

        return view('admin.data-pesanan', compact('pesanan', 'jmlPesanan')); // Pastikan 'data' diteruskan ke view
    }

    // ? update data pesanan
    public function edit(Pesanan $pesanan)
    {
        $pesanan->load('user', 'items.menu');
        return view('admin.edit-pesanan', compact('pesanan'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $pesanan->update([
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.data-pesanan')->with('success', 'Pesanan berhasil diperbarui.');
    }

}
