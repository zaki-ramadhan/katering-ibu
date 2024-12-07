<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // untuk memformat timestamp 


class MenuController extends Controller {
    public function index() {
        // Mengambil semua data menu dari database
        $menu = Menu::all();

        // Menghitung jumlah data menu
        $jumlahMenu = $menu->count();
        
        // Mengirim data menu ke view
        return view('admin.data-menu', compact('menu', 'jumlahMenu'));
    }
    
    public function showMenu(Request $request) {
        // Mengambil query pencarian jika ada
        $query = $request->input('find');
    
        // Jika ada query pencarian, lakukan pencarian, jika tidak ambil semua data
        if ($query) {
            $menu = Menu::where('nama_menu', 'LIKE', "%{$query}%")->get();
        } else {
            $menu = Menu::all();
        }
    
        // Memformat tanggal menggunakan Carbon
        foreach ($menu as $item) {
            $item->formatted_date = Carbon::parse($item->created_at)->translatedFormat('d F Y');
        }
    
        // Menghitung jumlah data menu yang ditemukan
        $jumlahMenu = $menu->count();
    
        // Mengirim data menu dan query ke view
        return view('menu', compact('menu', 'jumlahMenu', 'query'));
    }

    public function showMenuFooter() {
        // Mengambil semua data menu dari database
        $menu = Menu::all();
        
        // Mengirim data menu ke view
        return view('footer', compact('menu'));
    }
    

    public function create() {
        return view('admin.create-menu');
    }

    public function store(Request $request) {
        $request->validate([
            'foto_menu' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
        ]);
    
        // Upload foto
        $file = $request->file('foto_menu')->store('menu_images', 'public');
    
        // Simpan data ke database
        Menu::create([
            'foto_menu' => $file,
            'nama_menu' => $request->nama_menu,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);
    
        // Redirect ke daftar menu dengan pesan sukses
        return redirect()->route('admin.data-menu')->with('message', 'Data berhasil ditambahkan!');
    }
    

    public function search(Request $request) {
        return $this->showMenu($request);
    }
}
