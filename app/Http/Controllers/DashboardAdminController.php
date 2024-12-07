<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
Use App\Models\User;
use App\Models\Ulasan;

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
        $jmlUlasan = Ulasan::count();

        return view('admin.dashboard-admin', compact('jmlMenu', 'jmlPelanggan', 'jmlUlasan'));

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
