<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\KeranjangItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::where('user_id', Auth::id())->with('items.menu')->first();
        // Debugging
        // dd($keranjang);
        return view('customer.keranjang', compact('keranjang'));
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
            $keranjangItem = KeranjangItem::create([
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

        // Tindakan berdasarkan tombol yang diklik
        if ($request->action == 'order_now') {
            // Arahkan ke halaman detail pesanan
            return redirect()->route('customer.pesanan-detail', $keranjang->id)->with('success', 'Pesanan berhasil dilakukan.');
        } else {
            // Arahkan ke halaman keranjang
            return redirect()->route('customer.keranjang')->with('success', 'Item ditambahkan ke keranjang.');
        }
    }


    public function destroy($id)
    {
        $keranjangItem = KeranjangItem::findOrFail($id);
        $keranjangItem->delete();

        $keranjang = Keranjang::where('user_id', Auth::id())->first();
        $totalHarga = $keranjang->items->sum('total_harga_item');
        $keranjang->update(['total_harga' => $totalHarga]);

        return redirect()->route('customer.keranjang')->with('success', 'Item dihapus dari keranjang.');
    }
}
