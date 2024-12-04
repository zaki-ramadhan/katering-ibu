<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->route('menu')->with('error', 'Menu tidak ditemukan.');
        }

        // Variabel untuk menyimpan nama dasar menu
        $baseMenuName = '';

        // Tentukan nama dasar menu berdasarkan nama menu yang dipilih
        if (strpos($menu->nama_menu, 'Nasi Liwet') !== false) {
            $baseMenuName = 'Nasi Liwet';
        } elseif (strpos($menu->nama_menu, 'Nasi Kuning') !== false) {
            $baseMenuName = 'Nasi Kuning';
        }

        // Ambil varian menu berdasarkan nama dasar menu
        if ($baseMenuName) {
            $variantMenu = Menu::where('nama_menu', 'like', '%' . $baseMenuName . '%')
                               ->where('id', '!=', $id)
                               ->take(4)
                               ->get();
        } else {
            $variantMenu = collect(); // Jika bukan varian Nasi Liwet atau Nasi Kuning, kosongkan varian menu
        }

        // Ambil saran menu lain, kecuali menu yang dipilih dan variannya
        $recommendedMenu = Menu::where('id', '!=', $id)
                               ->when($baseMenuName, function ($query) use ($baseMenuName) {
                                   return $query->where('nama_menu', 'not like', '%' . $baseMenuName . '%');
                               })
                               ->take(4)
                               ->get();

        return view('order-now', compact('menu', 'variantMenu', 'recommendedMenu'));
    }
}
