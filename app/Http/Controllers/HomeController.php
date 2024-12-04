<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;


class HomeController extends Controller
{
    public function index()
    {
            // Mengambil 4 data menu dari database]
            $menu = Menu::take(4)->get();
    
            // Menghitung jumlah data menu
            $jumlahMenu = $menu->count();
            
            // Mengirim data menu ke view
            return view('home', compact('menu', 'jumlahMenu'));
    }
}
