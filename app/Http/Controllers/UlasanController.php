<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|max:50',
            'pesan' => 'required|string',
        ]);

        Ulasan::create([
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'email' => $request->input('email'),
            'pesan' => $request->input('pesan'),
        ]);

        return redirect()->back()->with('success', 'Ulasan Anda berhasil dikirim!');
    }
}
