<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller {
    public function index(){
        // Mengambil semua data menu dari database
        $menu = Menu::all();

        // Menghitung jumlah data menu
        $jumlahMenu = $menu->count();
        
        // Mengirim data menu ke view
        return view('admin.data-menu', compact('menu', 'jumlahMenu'));
    }

    public function create() {
        return view('admin.create-menu');
    }

    public function store(Request $request){
        $request->validate([
            'foto_menu' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
    ]);

    // Upload foto
    $file = $request->file('foto_menu') ? $request->file('foto_menu')->store( 'menu_images', 'public') : null;

    // Save data to database
    Menu::create([
        'foto_menu' => $file,
        'nama_menu' => $request->nama_menu,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
    ]);

        // Redirect to the menu list with a success message
        return redirect()->route('admin.data-menu')->with('message', 'Data berhasil ditambahkan!');
    }
}
