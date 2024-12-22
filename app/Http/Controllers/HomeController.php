<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Ulasan;
use Carbon\Carbon; // untuk memformat timestamp 



class HomeController extends Controller
{
    public function index()
    {
            // Mengambil 4 data menu dari database]
            $menu = Menu::take(4)->get();
            $bestSellingMenus = Menu::orderBy('terjual', 'desc')->limit(4)->get();
            // Menghitung jumlah data menu
            $jumlahMenu = $menu->count();

            $ulasan = Ulasan::with('user')->take(4)->get();

            foreach ($ulasan as $item) {
                $item->formatted_date = Carbon::parse($item->created_at)->translatedFormat('d F Y');
            }
    
            
            // Mengirim data menu ke view
            return view('home', compact('menu', 'jumlahMenu', 'ulasan', 'bestSellingMenus'));
    }
}
