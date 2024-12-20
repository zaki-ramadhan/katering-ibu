<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\User;
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
        // Mengirim data untuk ditampilkan ke halaman dashboard admin
        $jmlMenu = Menu::count();
        $jmlPelanggan = User::where('role', 'customer')->count();
        $jmlPesanan = Pesanan::count();
        $jmlUlasan = Ulasan::count();

        // Pelanggan terbaru
        $pelangganTerbaru = User::where('role', 'customer')->orderBy('created_at', 'desc')->take(3)->get();
        foreach ($pelangganTerbaru as $items) {
            $items->formatted_date = Carbon::parse($items->created_at)->translatedFormat('d M');
        }

        // Menu terbaru
        $menuTerbaru = Menu::orderBy('created_at', 'desc')->take(3)->get();
        foreach ($menuTerbaru as $items) {
            $items->formatted_date = Carbon::parse($items->created_at)->translatedFormat('d M');
        }

        // Pesanan terbaru
        $pesananTerbaru = Pesanan::with(['user', 'items.menu'])->orderBy('created_at', 'desc')->take(3)->get();
        foreach ($pesananTerbaru as $pesanan) {
            $pesanan->formatted_date = Carbon::parse($pesanan->created_at)->translatedFormat('d M');
        }

        // Ulasan terbaru
        $ulasanTerbaru = Ulasan::orderBy('created_at', 'desc')->take(3)->get();
        foreach ($ulasanTerbaru as $items) {
            $items->formatted_date = Carbon::parse($items->created_at)->translatedFormat('d M');
        }

        // Penjualan Harian
        $penjualanHarian = Pesanan::where('status', 'Completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');

        $penjualanHarianSebelumnya = Pesanan::where('status', 'Completed')
            ->whereDate('created_at', today()->subDay())
            ->sum('total_amount');

        $perubahanPenjualanHarian = $penjualanHarianSebelumnya == 0 ? 
            ($penjualanHarian > 0 ? 100 : 0) : 
            round((($penjualanHarian - $penjualanHarianSebelumnya) / $penjualanHarianSebelumnya) * 100, 2);

        // Penjualan Mingguan
        $penjualanMingguan = Pesanan::where('status', 'Completed')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_amount');

        $penjualanMingguanSebelumnya = Pesanan::where('status', 'Completed')
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->sum('total_amount');

        $perubahanPenjualanMingguan = $penjualanMingguanSebelumnya == 0 ? 
            ($penjualanMingguan > 0 ? 100 : 0) : 
            round((($penjualanMingguan - $penjualanMingguanSebelumnya) / $penjualanMingguanSebelumnya) * 100, 2);

        // Penjualan Bulanan
        $penjualanBulanan = Pesanan::where('status', 'Completed')
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');

        $penjualanBulananSebelumnya = Pesanan::where('status', 'Completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('total_amount');

        $perubahanPenjualanBulanan = $penjualanBulananSebelumnya == 0 ? 
            ($penjualanBulanan > 0 ? 100 : 0) : 
            round((($penjualanBulanan - $penjualanBulananSebelumnya) / $penjualanBulananSebelumnya) * 100, 2);

        return view('admin.dashboard-admin', compact(
            'jmlMenu', 'jmlPelanggan', 'jmlUlasan', 'jmlPesanan',
            'pelangganTerbaru', 'menuTerbaru', 'ulasanTerbaru', 'pesananTerbaru',
            'penjualanHarian', 'perubahanPenjualanHarian',
            'penjualanMingguan', 'perubahanPenjualanMingguan',
            'penjualanBulanan', 'perubahanPenjualanBulanan'
        ));
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
