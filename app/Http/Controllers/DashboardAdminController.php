<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
Use App\Models\User;
use App\Models\Ulasan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengirim data untuk ditampilkan ke halaman dashboard admin
        $jmlMenu = Menu::count();
        $jmlPelanggan = User::where('role', 'customer')->count();
        $jmlPesanan = Pesanan::count();
        $jmlUlasan = Ulasan::count();

        
        $pelangganTerbaru = User::where('role', 'customer')->orderBy('created_at', 'desc')->take(3)->get();
        // Memformat tanggal menggunakan Carbon
        foreach ($pelangganTerbaru as $items) {
            $items->formatted_date = Carbon::parse($items->created_at)->translatedFormat('d M');
        }        
        
        $menuTerbaru = Menu::orderBy('created_at', 'desc')->take(3)->get();
        foreach ($menuTerbaru as $items) {
            $items->formatted_date = Carbon::parse($items->created_at)->translatedFormat('d M');
        }

        $pesananTerbaru = Pesanan::with(['user', 'items.menu'])->orderBy('created_at', 'desc')->take(3)->get();
        foreach ($pesananTerbaru as $pesanan) {
            $pesanan->formatted_date = Carbon::parse($pesanan->created_at)->translatedFormat('d M');
        }

        $ulasanTerbaru = Ulasan::orderBy('created_at', 'desc')->take(3)->get();
        foreach ($ulasanTerbaru as $items) {
            $items->formatted_date = Carbon::parse($items->created_at)->translatedFormat('d M');
        }        

        return view('admin.dashboard-admin', compact('jmlMenu', 'jmlPelanggan', 'jmlUlasan', 'jmlPesanan', 'pelangganTerbaru', 'menuTerbaru', 'ulasanTerbaru', 'pesananTerbaru'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
