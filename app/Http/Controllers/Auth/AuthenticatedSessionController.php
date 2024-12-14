<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Cek role pengguna setelah login
    if ($request->user()->role === 'admin') {
        return redirect()->route('admin.dashboard-admin')->with('success', 'Anda berhasil login sebagai Admin'); // Pastikan route ini ada
    } elseif ($request->user()->role === 'customer') {
        return redirect()->route('customer.dashboard')->with('success', 'Anda berhasil login!'); // Pastikan route ini ada
    }

    return redirect()->route('home')->with('success', 'Anda berhasil login!');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda berhasil logout!');
    }
}
