<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
        public function index()
    {
        // Mengambil semua data menu dari database
        $menu = Menu::all(); // atau bisa dengan query lain jika diperlukan
        
        // Mengirim data menu ke view
        return view('admin.data-menu', compact('menu'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'foto_menu' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
        ]);

        // Upload foto
        $file = $request->file('foto_menu');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/menu_images', $filename);  // Store in 'public/menu_images' folder

        // Save data to database
        $menu = new Menu();
        $menu->foto_menu = $path;
        $menu->nama_menu = $request->nama_menu;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;
        $menu->save();

        // Redirect to the menu list with a success message
        return redirect()->route('admin.data-menu')->with('success', 'Menu successfully added!');
    }
}
