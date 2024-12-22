<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Carbon\Carbon; // untuk memformat timestamp 

class UlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::with('user')->get();
        $jumlahUlasan = $ulasan->count();
        
        foreach ($ulasan as $item) {
            $item->formatted_date = Carbon::parse($item->created_at)->translatedFormat('d M Y');
        }

        return view('admin.data-ulasan', compact('ulasan', 'jumlahUlasan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required|exists:users,id',
            'pesan' => 'required|string',
        ]);

        Ulasan::create([
            'id_customer' => $request->input('id_customer'),
            'pesan' => $request->input('pesan'),
        ]);

        return redirect()->back()->with('success', 'Ulasan Anda berhasil dikirim!');
    }


    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return back()->with('success', 'Data ulasan berhasil dihapus!');
    }
}
