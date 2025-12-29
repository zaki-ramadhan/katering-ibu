@extends('layouts.cust')

@section('title', 'Dashboard Akun Pelanggan')

@section('vite')
    @vite('resources/js/customer/dashboard.js')
@endsection

@if (session('success'))
    <div id="alert"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white shadow-xl text-sm px-6 py-3 rounded-full z-50 flex items-center justify-center gap-2 animate-bounce">
        <iconify-icon icon="lucide:check-circle" class="text-xl"></iconify-icon>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col gap-8">
        {{-- Hero Section --}}
        <section id="hero-section"
            class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-emerald-50 via-white to-primary-50 border border-emerald-100/50 shadow-xl shadow-emerald-500/5">
            {{-- Decorative Background Elements --}}
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-[100px]"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-emerald-500/10 rounded-full blur-[80px]"></div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]">
            </div>

            <div class="relative z-10 px-8 py-12 lg:px-16 lg:py-16 flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 text-center lg:text-left space-y-8">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/10 border border-emerald-500/20 rounded-full">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Selamat Datang
                            Kembali</span>
                    </div>

                    <div class="space-y-4">
                        <h1 class="font-black text-4xl md:text-6xl text-slate-800 leading-[1.1]">
                            Halo, <span class="text-primary">{{ explode(' ', auth()->user()->name)[0] }}!</span> 👋
                        </h1>
                        <p class="text-slate-500 text-base md:text-xl max-w-xl leading-relaxed font-medium">
                            Siap untuk hidangan lezat hari ini? Pantau pesanan Anda atau jelajahi menu spesial kami.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start pt-4">
                        <a href="{{ route('menu') }}"
                            class="group px-8 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-primary-700 transition-all shadow-xl shadow-primary/20 active:scale-95 flex items-center gap-2">
                            Pesan Sekarang
                            <iconify-icon icon="lucide:arrow-right"
                                class="text-xl group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </a>
                        <a href="{{ route('customer.profile') }}"
                            class="px-8 py-4 bg-white text-slate-600 font-bold rounded-2xl border border-slate-200 hover:border-primary hover:text-primary transition-all shadow-sm flex items-center gap-2">
                            <iconify-icon icon="lucide:user" class="text-xl"></iconify-icon>
                            Profil Saya
                        </a>
                    </div>
                </div>

                <div class="relative flex-shrink-0">
                    <div class="absolute inset-0 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
                    <img src="{{ asset('images/hello-cust.svg') }}" alt="Welcome"
                        class="w-72 md:w-96 relative z-10 drop-shadow-[0_20px_50px_rgba(0,0,0,0.1)] animate-float">
                </div>
            </div>
        </section>

        {{-- Main Dashboard Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column: Progress & Profile --}}
            <div class="lg:col-span-2 flex flex-col gap-8">
                {{-- Step Progress Card --}}
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xl font-bold text-slate-800">Progress Akun</h2>
                        <span
                            class="px-4 py-1 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-full uppercase tracking-wider">
                            On Track
                        </span>
                    </div>

                    @php
                        $user = auth()->user();
                        $stepsCompleted = $user && $user->name && $user->email && $user->notelp && $orderHistory->isNotEmpty();
                    @endphp

                    <div class="relative">
                        <div
                            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 relative z-10">
                            {{-- Step 1 --}}
                            <div class="flex flex-row md:flex-col items-center gap-4 flex-1">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-200">
                                    <iconify-icon icon="lucide:user-plus" class="text-xl"></iconify-icon>
                                </div>
                                <div class="text-left md:text-center">
                                    <p class="font-bold text-slate-800 text-sm">Daftar Aku</p>
                                    <p class="text-xs text-emerald-500 font-medium">Selesai</p>
                                </div>
                            </div>

                            {{-- Step 2 --}}
                            <div class="flex flex-row md:flex-col items-center gap-4 flex-1">
                                <div
                                    class="w-12 h-12 rounded-2xl {{ ($user->foto_profile && $user->name && $user->email && $user->notelp) ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-200' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center transition-all">
                                    <iconify-icon icon="lucide:user-check" class="text-xl"></iconify-icon>
                                </div>
                                <div class="text-left md:text-center">
                                    <p class="font-bold text-slate-800 text-sm">Lengkapi Data</p>
                                    <p
                                        class="text-xs {{ ($user->foto_profile && $user->name && $user->email && $user->notelp) ? 'text-emerald-500' : 'text-slate-400' }} font-medium">
                                        {{ ($user->foto_profile && $user->name && $user->email && $user->notelp) ? 'Selesai' : 'Belum Lengkap' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Step 3 --}}
                            <div class="flex flex-row md:flex-col items-center gap-4 flex-1">
                                <div
                                    class="w-12 h-12 rounded-2xl {{ $orderHistory->isNotEmpty() ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-200' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center transition-all">
                                    <iconify-icon icon="lucide:shopping-bag" class="text-xl"></iconify-icon>
                                </div>
                                <div class="text-left md:text-center">
                                    <p class="font-bold text-slate-800 text-sm">Buat Pesanan</p>
                                    <p
                                        class="text-xs {{ $orderHistory->isNotEmpty() ? 'text-emerald-500' : 'text-slate-400' }} font-medium">
                                        {{ $orderHistory->isNotEmpty() ? 'Selesai' : 'Belum Ada' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- Connector Line (Desktop) --}}
                        <div class="hidden md:block absolute top-6 left-0 w-full h-0.5 bg-slate-100 -z-0"></div>
                    </div>
                </div>

                {{-- Profile Info Card --}}
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xl font-bold text-slate-800">Informasi Pribadi</h2>
                        <a href="{{ route('customer.profile') }}"
                            class="text-primary hover:text-primary-700 font-bold text-sm flex items-center gap-1 transition-colors">
                            Edit Profil <iconify-icon icon="lucide:arrow-right" class="text-base"></iconify-icon>
                        </a>
                    </div>
                    <div class="flex flex-col md:flex-row items-center gap-10">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full ring-4 ring-emerald-50 overflow-hidden shadow-xl">
                                @if($user->foto_profile)
                                    <img src="{{ asset('storage/' . $user->foto_profile) }}" alt="Profile"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('images/default-pfp-cust-single.png') }}" alt="Profile"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div
                                class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 text-white rounded-full border-4 border-white flex items-center justify-center shadow-lg">
                                <iconify-icon icon="lucide:camera" class="text-base"></iconify-icon>
                            </div>
                        </div>
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                            <div class="space-y-1">
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Username</p>
                                <p class="text-slate-800 font-semibold">{{ $user->name }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Email</p>
                                <p class="text-slate-800 font-semibold">{{ $user->email }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Nomor Telepon</p>
                                <p class="text-slate-800 font-semibold">{{ $user->notelp ?? '-' }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Status Akun</p>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <p class="text-emerald-600 font-bold">Aktif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Recent Transactions --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 flex flex-col">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl font-bold text-slate-800">Transaksi Terakhir</h2>
                    <a href="{{ route('customer.order-history') }}"
                        class="w-8 h-8 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-all shadow-sm">
                        <iconify-icon icon="lucide:list" class="text-lg"></iconify-icon>
                    </a>
                </div>

                @if($orderHistory->isEmpty())
                    <div class="flex-1 flex flex-col items-center justify-center text-center p-8 space-y-4">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center">
                            <iconify-icon icon="lucide:shopping-cart" class="text-4xl text-slate-200"></iconify-icon>
                        </div>
                        <div class="space-y-2">
                            <p class="font-bold text-slate-800">Belum ada transaksi</p>
                            <p class="text-sm text-slate-400">Ayo mulai pemesanan pertama Anda hari ini!</p>
                        </div>
                        <a href="{{ route('menu') }}" class="text-primary font-bold text-sm hover:underline">
                            Lihat Menu
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($orderHistory->take(5) as $pesanan)
                            <a href="{{ route('pesanan.payOrder', $pesanan['id']) }}" class="block group">
                                <div
                                    class="p-4 rounded-2xl border border-slate-50 bg-slate-50/30 group-hover:bg-white group-hover:border-emerald-100 group-hover:shadow-lg group-hover:shadow-emerald-500/5 transition-all duration-300">
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $pesanan['created_date'] }}</span>
                                        @php
                                            $statusClasses = [
                                                'Pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'Processed' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                'Completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'Cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                            ];
                                            $statusLabels = [
                                                'Pending' => 'Menunggu',
                                                'Processed' => 'Diproses',
                                                'Completed' => 'Selesai',
                                                'Cancelled' => 'Batal',
                                            ];
                                            $currentStatus = $pesanan['status'] ?? 'Pending';
                                        @endphp
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClasses[$currentStatus] ?? $statusClasses['Pending'] }}">
                                            {{ $statusLabels[$currentStatus] ?? $statusLabels['Pending'] }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="space-y-1">
                                            <p class="text-sm font-bold text-slate-800 line-clamp-1">Pesanan
                                                #{{ substr($pesanan['id'], 0, 8) }}</p>
                                            <p class="text-xs text-slate-400">{{ $pesanan['payment_method'] }}</p>
                                        </div>
                                        <p class="text-base font-black text-primary">
                                            Rp{{ number_format($pesanan['total_price'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('customer.order-history') }}"
                            class="w-full py-3 bg-slate-50 text-slate-600 font-bold text-sm rounded-xl flex items-center justify-center gap-2 hover:bg-slate-100 transition-all">
                            Lihat Semua Transaksi
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
@endsection