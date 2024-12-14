<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    { 
        $admin = Auth::user();
        return view('admin.setting-admin', compact('admin'));
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
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        // Update username jika diisi
        if ($request->filled('username')) {
            $admin->name = $request->input('username');
        }

        // Update email jika diisi
        if ($request->filled('email')) {
            $admin->email = $request->input('email');
        }

        // Update password jika diisi
        if ($request->filled('password') && $request->input('password') === $request->input('confirm-password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $admin->save();

        return redirect()->route('admin.edit-pelanggan', $admin->id)->with('success', 'Data admin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
