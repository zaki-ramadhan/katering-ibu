<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index()
    {
        $pelanggan = User::where('role', 'customer')->paginate(10);
        $jumlahPelanggan = User::where('role', 'customer')->get()->count();

        foreach ($pelanggan as $item) {
            $item->formatted_date = Carbon::parse($item->created_at)->translatedFormat('d F Y');
        }

        return view('admin.data-pelanggan', compact('pelanggan', 'jumlahPelanggan'));
    }

    public function edit($id)
    {
        $pelanggan = User::findOrFail($id);
        return view('admin.edit-pelanggan', compact('pelanggan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'notelp' => 'nullable|string|max:15',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pelanggan = User::findOrFail($id);
        $pelanggan->name = $request->name;
        $pelanggan->email = $request->email;
        $pelanggan->notelp = $request->notelp;

        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $path = $file->store('profile_photos', 'public');
            $pelanggan->foto_profile = $path;
        }

        $pelanggan->save();

        return redirect()->route('admin.data-pelanggan')->with('success', 'Data pelanggan berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $pelanggan = User::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('admin.data-pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }

}
