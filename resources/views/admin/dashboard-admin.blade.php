@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('vite')
    @vite('resources/js/admin/dashboard-admin.js')
@endsection

@if (session('success'))
    <div id="alert"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white shadow-xl text-sm px-6 py-3 rounded-xl z-[100] flex items-center justify-center gap-2 animate-fade-in-down">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    {{-- <div class="sub-header-content container text-center  bg-primary rounded-lg py-4 ">
        <h1 class="text-base text-white">Selamat datang kembali Admin</h1>
    </div> --}}
    {{-- hero section --}}
    <section id="hero-section"
        class="container px-6 md:px-10 py-8 md:py-10 flex flex-col lg:flex-row items-center justify-center gap-8 lg:gap-20 rounded-3xl bg-white shadow-sm border border-slate-100">
        <img src="{{ asset('images/admin.svg') }}" alt="admin svg" class="w-48 md:w-64 lg:w-72">
        <div class="text-wrapper flex flex-col gap-3 items-center lg:items-start text-center lg:text-left">
            <div class="text-wrapper flex items-center gap-2">
                <span class="text-2xl animate-waving-hello">👋🏼</span>
                <p class="text-base md:text-lg font-medium text-slate-500">Selamat datang kembali, Admin</p>
            </div>
            <h1 class="font-black text-2xl md:text-3xl lg:text-4xl text-slate-800 leading-tight">Pantau dan Kelola Semua
                Data & Pengaturan.</h1>
            <p class="text-sm md:text-base text-slate-500 leading-relaxed max-w-xl">Kelola status pesanan, pelanggan, dan
                operasional bisnis Anda dalam satu dashboard yang terintegrasi.</p>
        </div>
    </section>

    <!-- Kartu Laporan Penjualan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-2">
        <!-- Penjualan Harian -->
        <div class="bg-white shadow-md shadow-slate-200/70 rounded-xl p-6 flex flex-col gap-3">
            <div class="head-card w-full flex justify-between">
                <h3 class="text-base">Penjualan Harian</h3>
                <span
                    class="{{ $perubahanPenjualanHarian > 0 ? 'text-green-500' : 'text-red-500' }} font-medium flex justify-center items-center gap-1 ">
                    <iconify-icon icon="{{ $perubahanPenjualanHarian > 0 ? 'entypo:arrow-up' : 'entypo:arrow-down' }}"
                        width="20" height="20"
                        class="{{ $perubahanPenjualanHarian > 0 ? 'animate-little-bounce-up-down' : 'animate-little-bounce-up-down-delay' }}"></iconify-icon>
                    {{ abs($perubahanPenjualanHarian) }}%
                </span>
            </div>
            <p class="text-gray-600 font-semibold text-2xl"><span class="text-base">Rp.</span>
                {{ number_format($penjualanHarian, 0, ',', '.') }}</p>
            <a href="{{ route('admin.data-penjualan') }}" class="w-max text-blue-500 hover:underline text-xs">Lihat
                Selengkapnya</a>
        </div>

        <!-- Penjualan Mingguan -->
        <div class="bg-white shadow-md shadow-slate-200/70 rounded-xl p-6 flex flex-col gap-3">
            <div class="head-card w-full flex justify-between">
                <h3 class="text-base">Penjualan Mingguan</h3>
                <span
                    class="{{ $perubahanPenjualanMingguan > 0 ? 'text-green-500' : 'text-red-500' }} font-medium flex justify-center items-center gap-1">
                    <iconify-icon icon="{{ $perubahanPenjualanMingguan > 0 ? 'entypo:arrow-up' : 'entypo:arrow-down' }}"
                        width="20" height="20"
                        class="{{ $perubahanPenjualanMingguan > 0 ? 'animate-little-bounce-up-down' : 'animate-little-bounce-up-down-delay' }}"></iconify-icon>
                    {{ abs($perubahanPenjualanMingguan) }}%
                </span>
            </div>
            <p class="text-gray-600 font-semibold text-2xl"><span class="text-base">Rp.</span>
                {{ number_format($penjualanMingguan, 0, ',', '.') }}</p>
            <a href="{{ route('admin.data-penjualan') }}" class="w-max text-blue-500 hover:underline text-xs">Lihat
                Selengkapnya</a>
        </div>

        <!-- Penjualan Bulanan -->
        <div class="bg-white shadow-md shadow-slate-200/70 rounded-xl p-6 flex flex-col gap-3">
            <div class="head-card w-full flex justify-between">
                <h3 class="text-base">Penjualan Bulanan</h3>
                <span
                    class="{{ $perubahanPenjualanBulanan > 0 ? 'text-green-500' : 'text-red-500' }} font-medium flex justify-center items-center gap-1 ">
                    <iconify-icon icon="{{ $perubahanPenjualanBulanan > 0 ? 'entypo:arrow-up' : 'entypo:arrow-down' }}"
                        width="20" height="20"
                        class="{{ $perubahanPenjualanBulanan > 0 ? 'animate-little-bounce-up-down' : 'animate-little-bounce-up-down-delay' }}"></iconify-icon>
                    {{ abs($perubahanPenjualanBulanan) }}%
                </span>
            </div>
            <p class="text-gray-600 font-semibold text-2xl"><span class="text-base">Rp.</span>
                {{ number_format($penjualanBulanan, 0, ',', '.') }}</p>
            <a href="{{ route('admin.data-penjualan') }}" class="w-max text-blue-500 hover:underline text-xs">Lihat
                Selengkapnya</a>
        </div>
    </div>


    <section id="dashboard-stats-section" class="container">
        <div class="card-wrapper grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div
                class="card userData-card flex flex-col gap-4 p-6 rounded-2xl bg-white shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-red-500"></div>
                <div class="flex justify-between items-start">
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Data Pelanggan</p>
                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                </div>
                <h3 class="text-3xl font-black text-slate-800">{{ $jmlPelanggan }}</h3>
                <a href="{{route('admin.data-pelanggan')}}"
                    class="text-sm font-bold text-primary flex items-center gap-2 group-hover:gap-3 transition-all">
                    Lihat selengkapnya
                    <iconify-icon icon="lucide:arrow-right" class="text-lg"></iconify-icon>
                </a>
            </div>
            <div
                class="card menuData-card flex flex-col gap-4 p-6 rounded-2xl bg-white shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-emerald-500"></div>
                <div class="flex justify-between items-start">
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Data Menu</p>
                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                </div>
                <h3 class="text-3xl font-black text-slate-800">{{ $jmlMenu }}</h3>
                <a href="{{route('admin.data-menu')}}"
                    class="text-sm font-bold text-primary flex items-center gap-2 group-hover:gap-3 transition-all">
                    Lihat selengkapnya
                    <iconify-icon icon="lucide:arrow-right" class="text-lg"></iconify-icon>
                </a>
            </div>
            <div
                class="card orderData-card flex flex-col gap-4 p-6 rounded-2xl bg-white shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500"></div>
                <div class="flex justify-between items-start">
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Data Pesanan</p>
                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                </div>
                <h3 class="text-3xl font-black text-slate-800">{{$jmlPesanan}}</h3>
                <a href="{{ route('admin.data-pesanan') }}"
                    class="text-sm font-bold text-primary flex items-center gap-2 group-hover:gap-3 transition-all">
                    Lihat selengkapnya
                    <iconify-icon icon="lucide:arrow-right" class="text-lg"></iconify-icon>
                </a>
            </div>
            <div
                class="card feedbackData-card flex flex-col gap-4 p-6 rounded-2xl bg-white shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-amber-400"></div>
                <div class="flex justify-between items-start">
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Data Ulasan</p>
                    <div class="w-2 h-2 rounded-full bg-amber-400"></div>
                </div>
                <h3 class="text-3xl font-black text-slate-800">{{ $jmlUlasan }}</h3>
                <a href="{{ route('admin.data-ulasan') }}"
                    class="text-sm font-bold text-primary flex items-center gap-2 group-hover:gap-3 transition-all">
                    Lihat selengkapnya
                    <iconify-icon icon="lucide:arrow-right" class="text-lg"></iconify-icon>
                </a>
            </div>
        </div>
    </section>
    <section id="latest-data-wrapper" class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-4">
        {{-- Pelanggan Terbaru --}}
        <div class="bg-white p-6 flex flex-col gap-4 shadow-sm border border-slate-100 rounded-2xl">
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-bold text-slate-800">Pelanggan Terbaru</h2>
                <div class="w-2 h-2 rounded-full bg-red-500"></div>
            </div>
            <div class="space-y-4">
                @foreach ($pelangganTerbaru as $pelanggan)
                    <a href="{{ route('admin.edit-pelanggan', $pelanggan->id) }}" class="flex items-center gap-3 group">
                        <img src="{{ $pelanggan->foto_profile ? asset('storage/' . $pelanggan->foto_profile) : asset('images/default-pfp-cust-single.png') }}"
                            alt="profile" class="w-10 h-10 rounded-full object-cover border border-slate-100">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate group-hover:text-primary transition-colors">
                                {{$pelanggan->name}}</p>
                            <p class="text-xs text-slate-500 truncate">{{$pelanggan->email}}</p>
                        </div>
                        <span class="text-[10px] font-bold bg-red-50 text-red-500 px-2 py-1 rounded-full whitespace-nowrap">
                            {{ $pelanggan->formatted_date }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Menu Terbaru --}}
        <div class="bg-white p-6 flex flex-col gap-4 shadow-sm border border-slate-100 rounded-2xl">
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-bold text-slate-800">Menu Terbaru</h2>
                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
            </div>
            <div class="space-y-4">
                @foreach ($menuTerbaru as $menu)
                    <a href="{{ route('menu.edit', $menu->id) }}" class="flex items-center gap-3 group">
                        <img src="{{ Storage::url($menu->foto_menu) }}" alt="menu"
                            class="w-10 h-10 rounded-lg object-cover border border-slate-100">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate group-hover:text-primary transition-colors">
                                {{$menu->nama_menu}}</p>
                            <p class="text-xs text-slate-500 truncate">{{$menu->deskripsi}}</p>
                        </div>
                        <span
                            class="text-[10px] font-bold bg-emerald-50 text-emerald-600 px-2 py-1 rounded-full whitespace-nowrap">
                            {{ $menu->formatted_date }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Pesanan Terbaru --}}
        <div class="bg-white p-6 flex flex-col gap-4 shadow-sm border border-slate-100 rounded-2xl">
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-bold text-slate-800">Pesanan Terbaru</h2>
                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
            </div>
            <div class="space-y-4">
                @foreach ($pesananTerbaru as $pesanan)
                    <a href="{{ route('pesanan.edit', $pesanan['id']) }}" class="flex items-center gap-3 group">
                        <img src="{{ $pesanan->user->foto_profile ? asset('storage/' . $pesanan->user->foto_profile) : asset('images/default-pfp-cust-single.png') }}"
                            alt="profile" class="w-10 h-10 rounded-full object-cover border border-slate-100">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate group-hover:text-primary transition-colors">
                                {{ $pesanan->user->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $pesanan->user->email }}</p>
                        </div>
                        <span class="text-[10px] font-bold bg-blue-50 text-blue-600 px-2 py-1 rounded-full whitespace-nowrap">
                            {{ $pesanan->formatted_date }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Ulasan Terbaru --}}
        <div class="bg-white p-6 flex flex-col gap-4 shadow-sm border border-slate-100 rounded-2xl">
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-bold text-slate-800">Ulasan Terbaru</h2>
                <div class="w-2 h-2 rounded-full bg-amber-400"></div>
            </div>
            <div class="space-y-4">
                @foreach ($ulasanTerbaru as $ulasan)
                    <div class="flex items-center gap-3">
                        <img src="{{ $ulasan->user->foto_profile ? asset('storage/' . $ulasan->user->foto_profile) : asset('images/default-pfp-cust-single.png') }}"
                            alt="profile" class="w-10 h-10 rounded-full object-cover border border-slate-100">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate">{{$ulasan->user->name}}</p>
                            <p class="text-xs text-slate-500 truncate">{{$ulasan->pesan}}</p>
                        </div>
                        <span class="text-[10px] font-bold bg-amber-50 text-amber-600 px-2 py-1 rounded-full whitespace-nowrap">
                            {{ $ulasan->formatted_date }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection