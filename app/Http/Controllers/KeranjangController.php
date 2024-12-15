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
        return view('keranjang', compact('keranjang'));
    }

    public function store(Request $request)
    {
        $keranjang = Keranjang::firstOrCreate(['user_id' => Auth::id()]);

        $menu = Menu::find($request->menu_id);
        $jumlah = $request->jumlah;

        $keranjangItem = KeranjangItem::create([
            'keranjang_id' => $keranjang->id,
            'menu_id' => $menu->id,
            'jumlah' => $jumlah,
            'harga' => $menu->harga,
            'total_harga_item' => $menu->harga * $jumlah,
        ]);

        $totalHarga = $keranjang->items->sum('total_harga_item');
        $keranjang->update(['total_harga' => $totalHarga]);

        return redirect()->route('keranjang.index')->with('success', 'Item ditambahkan ke keranjang.');
    }

    public function destroy($id)
    {
        $keranjangItem = KeranjangItem::findOrFail($id);
        $keranjangItem->delete();

        $keranjang = Keranjang::where('user_id', Auth::id())->first();
        $totalHarga = $keranjang->items->sum('total_harga_item');
        $keranjang->update(['total_harga' => $totalHarga]);

        return redirect()->route('keranjang.index')->with('success', 'Item dihapus dari keranjang.');
    }
}
