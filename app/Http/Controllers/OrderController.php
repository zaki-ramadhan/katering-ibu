<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\ItemPesanan;
use Illuminate\Http\Request;
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
        $pesanan = new Pesanan();
        $pesanan->user_id = Auth::id();
        $pesanan->payment_method = $request->input('payment_method');
        $pesanan->pickup_method = $request->input('pickup_method');
        $pesanan->delivery_address = $request->input('pickup_method') === 'delivery' ? $request->input('delivery_address') : null;
        $pesanan->shipping_cost = $request->input('pickup_method') === 'delivery' ? 10000 : 0; // Contoh ongkir
        $pesanan->total_amount = $this->calculateTotalAmount($pesanan, $request);
        $pesanan->save();

        foreach (Keranjang::where('user_id', Auth::id())->get() as $cartItem) {
            $itemPesanan = new ItemPesanan();
            $itemPesanan->pesanan_id = $pesanan->id;
            $itemPesanan->menu_id = $cartItem->menu_id;
            $itemPesanan->quantity = $cartItem->jumlah;
            $itemPesanan->price = $cartItem->harga;
            $itemPesanan->save();
        }

        Keranjang::where('user_id', Auth::id())->delete();

        return redirect()->route('customer.order-history')->with('success', 'Pesanan berhasil diproses.');
    }

    // Menghitung total jumlah pesanan
    private function calculateTotalAmount($pesanan, $request)
    {
        $totalAmount = 0;
        $cartItems = Keranjang::where('user_id', Auth::id())->get();
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->jumlah * $cartItem->harga;
        }
        return $totalAmount + $pesanan->shipping_cost;
    }
}
