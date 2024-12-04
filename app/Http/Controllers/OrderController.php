<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $menu = Menu::all(); // Mengambil semua data menu
        return view('order-now', compact('menu'));
    }

    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->route('menu')->with('error', 'Menu tidak ditemukan.');
        }

        // Ambil menu lain sebagai rekomendasi, kecuali menu yang dipilih
        $recommendedMenu = Menu::where('id', '!=', $id)->take(4)->get();
        return view('order-now', compact('menu', 'recommendedMenu'));
    }

    // Tambahkan method lainnya sesuai kebutuhan (create, store, edit, update, destroy)
}
