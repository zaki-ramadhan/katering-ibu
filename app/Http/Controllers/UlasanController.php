<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Carbon\Carbon; // untuk memformat timestamp 


class UlasanController extends Controller
{
    public function index() {
        $ulasan = Ulasan::all();
        
        foreach ($ulasan as $item) {
            $item->formatted_date = Carbon::parse($item->created_at)->translatedFormat('d F Y');
        }
        
        return view('admin.data-ulasan', compact('ulasan'));
    }
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
