@extends('layouts.admin')

@section('title', 'Dashboard Admin') 

@section('vite') 
    @vite('resources/js/admin/dashboard-admin.js')
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    {{-- <div class="sub-header-content container text-center  bg-primary rounded-lg py-4 ">
        <h1 class="text-base text-white">Selamat datang kembali Admin</h1>
    </div> --}}
    {{-- hero section --}}
    <section id="hero-section" class="container px-10 py-6 flex items-center justify-center gap-20 rounded-2xl bg-white shadow-md shadow-slate-200/60">
        <img src="{{ asset('images/admin.svg') }}" alt="admin svg" class="w-72">
        <div class="text-wrapper flex flex-col gap-3 items-start justify-start">
            <p class="text-base lg:text-xl lg:before:content-['👋🏼'] lg:before:animate-waving-hello lg:before:text-2xl lg:before:me-1 lg:-translate-x-4">Selamat datang kembali Admin</p>
            <h1 class="font-bold sm:text-3xl md:text-4xl grow text-primary">Pantau dan kelola semua data dan pengaturan.</h1>
            <p class="text-sm lg:text-base leading-6 mt-2">Kelola status pesanan, pelanggan, dan operasional bisnis Anda dalam satu dashboard.</p>
        </div>
    </section>

    <section id="dashboard-stats-section" class="container">
        <div class="card-wrapper grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-5 ">
            <div class="card userData-card flex flex-col gap-3 p-5 rounded-xl bg-white shadow-md shadow-slate-200/60 relative before:content-[''] before:absolute before:top-1/2 before:-left-2 before:-translate-y-1/2 before:w-2 before:h-[80%] before:rounded-ss-full before:rounded-es-full before:bg-red-500">
                <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-red-500">Data Pelanggan</p>
                <h3 class="data-count text-2xl font-bold text-primary">{{ $jmlPelanggan }}</h3>
                <a href="{{route('admin.data-pelanggan')}}" class="w-max hover:text-primary hover:no-underline">
                    <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                        Lihat selengkapnya
                        <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                    </button>
                </a>
            </div>
            <div class="card menuData-card flex flex-col gap-3 p-5 rounded-xl bg-white shadow-md shadow-slate-200/60 relative before:content-[''] before:absolute before:top-1/2 before:-left-2 before:-translate-y-1/2 before:w-2 before:h-[80%] before:rounded-ss-full before:rounded-es-full before:bg-emerald-500">
                <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-emerald-500">Data Menu</p>
                <h3 class="data-count text-2xl font-bold text-primary">{{ $jmlMenu }}</h3>
                <a href="{{route('admin.data-menu')}}" class="w-max hover:text-primary hover:no-underline">
                    <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                        Lihat selengkapnya
                        <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                    </button>
                </a>
            </div>
            <div class="card orderData-card flex flex-col gap-3 p-5 rounded-xl bg-white shadow-md shadow-slate-200/60 relative before:content-[''] before:absolute before:top-1/2 before:-left-2 before:-translate-y-1/2 before:w-2 before:h-[80%] before:rounded-ss-full before:rounded-es-full before:bg-blue-500">
                <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-blue-500">Data Pesanan</p>
                <h3 class="data-count text-2xl font-bold text-primary">0</h3>
                <a href="{{ route('admin.data-pesanan') }}  " class="w-max hover:text-primary hover:no-underline">
                    <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                        Lihat selengkapnya
                        <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                    </button>
                </a>
            </div>
            <div class="card feedbackData-card flex flex-col gap-3 p-5 rounded-xl bg-white shadow-md shadow-slate-200/60 relative before:content-[''] before:absolute before:top-1/2 before:-left-2 before:-translate-y-1/2 before:w-2 before:h-[80%] before:rounded-ss-full before:rounded-es-full before:bg-amber-400">
                <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-yellow-500">Data Ulasan</p>
                <h3 class="data-count text-2xl font-bold text-primary">{{ $jmlUlasan }}</h3>
                <a href="{{ route('admin.data-ulasan') }}" class="w-max hover:text-primary hover:no-underline">
                    <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                        Lihat selengkapnya
                        <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                    </button>
                </a>
            </div>
        </div>
    </section>
    <section id="latest-data-wrapper" class="container grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
        <div class="pelanggan-terbaru-wrapper bg-white px-6 pt-6 pb-8 flex flex-col gap-4 shadow-md shadow-slate-200/60 rounded-xl">
            <h1 class="mb-3 ms-[.1rem] font-medium text-primary relative after:absolute after:top-1/2 after:right-0 after:-translate-y-1/2 after:content-[''] after:w-2
             after:aspect-square after:rounded-full after:bg-red-500">Pelanggan terbaru</h1>
            @foreach ($pelangganTerbaru as $pelanggan)
            <a href="{{ route('admin.edit-pelanggan', $pelanggan->id) }}" class="hover:no-underline hover:text-current">
                <div class="card flex flex-row justify-start items-center gap-4 mt-2 pe-12 relative">
                    <img src="{{ $pelanggan->foto_profile ? asset('storage/' . $pelanggan->foto_profile) : asset('images/default-pfp-cust-single.png') }}" alt="profile img" class="max-w-14 aspect-square object-cover rounded-full">
                    <div class="text-wrapper text-sm flex flex-col gap-2 overflow-hidden">
                        <h2 class="truncate text-primary">{{$pelanggan->name}}</h2>
                        <p class="truncate text-xs">{{$pelanggan->email}}</p>
                    </div>
                    <span class="timestamp-label w-max text-nowrap overflow-hidden absolute top-1/2 -right-3 -translate-y-1/2 text-[.65rem] p-[.3rem] px-2 rounded-full bg-red-50">
                        {{ $pelanggan->formatted_date }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        <div class="menu-terbaru-wrapper bg-white px-6 pt-6 pb-8 flex flex-col gap-4 shadow-md shadow-slate-200/60 rounded-xl">
            <h1 class="mb-3 ms-[.1rem] font-medium text-primary relative after:absolute after:top-1/2 after:right-0 after:-translate-y-1/2 after:content-[''] after:w-2
             after:aspect-square after:rounded-full after:bg-emerald-500">Menu terbaru</h1>
            @foreach ($menuTerbaru as $menu)
            <a href="{{ route('menu.edit', $menu->id) }}" class="hover:no-underline hover:text-current">
                <div class="card flex flex-row justify-start items-center gap-4 mt-2 pe-12 relative">
                    <img src="{{ Storage::url($menu->foto_menu) }}" alt="profile img" class="max-w-14 aspect-square object-cover rounded-full">
                    <div class="text-wrapper text-sm flex flex-col gap-2 overflow-hidden">
                        <h2 class="truncate  text-primary">{{$menu->nama_menu}}</h2>
                        <p class="truncate text-xs">{{$menu->deskripsi}}</p>
                    </div>
                    <span class="timestamp-label w-max text-nowrap overflow-hidden absolute top-1/2 -right-3 -translate-y-1/2 text-[.65rem] p-[.3rem] px-2 rounded-full bg-emerald-50">
                        {{ $menu->formatted_date }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        <div class="pesanan-terbaru-wrapper bg-white px-6 pt-6 pb-8 flex flex-col gap-4 shadow-md shadow-slate-200/60 rounded-xl">
            <h1 class="mb-3 ms-[.1rem] font-medium text-primary relative after:absolute after:top-1/2 after:right-0 after:-translate-y-1/2 after:content-[''] after:w-2
             after:aspect-square after:rounded-full after:bg-blue-500">Pelanggan terbaru</h1>
            @foreach ($pelangganTerbaru as $pelanggan)
            <div class="card flex flex-row justify-start items-center gap-4 mt-2 pe-12 relative">
                <img src="{{ $pelanggan->foto_profile ? asset('storage/' . $pelanggan->foto_profile) : asset('images/default-pfp-cust-single.png') }}" alt="profile img" class="max-w-14 aspect-square object-cover rounded-full">
                <div class="text-wrapper text-sm flex flex-col gap-2 overflow-hidden">
                    <h2 class="truncate  text-primary">{{$pelanggan->name}}</h2>
                    <p class="truncate text-xs">{{$pelanggan->email}}</p>
                </div>
                <span class="timestamp-label w-max text-nowrap overflow-hidden absolute top-1/2 -right-3 -translate-y-1/2 text-[.65rem] p-[.3rem] px-2 rounded-full bg-blue-50">
                    {{ $pelanggan->formatted_date }}
                </span>
            </div>
            @endforeach
        </div>
        <div class="ulasan-terbaru-wrapper bg-white px-6 pt-6 pb-8 flex flex-col gap-4 shadow-md shadow-slate-200/60 rounded-xl">
            <h1 class="mb-3 ms-[.1rem] font-medium text-primary relative after:absolute after:top-1/2 after:right-0 after:-translate-y-1/2 after:content-[''] after:w-2
             after:aspect-square after:rounded-full after:bg-amber-400">Ulasan terbaru</h1>
            @foreach ($ulasanTerbaru as $ulasan)
            <div class="card flex flex-row justify-start items-center gap-4 mt-2 pe-12 relative">
                <img src="{{ $ulasan->user->foto_profile ? asset('storage/' . $ulasan->user->foto_profile) : asset('images/default-pfp-cust-single.png') }}" alt="profile img" class="max-w-14 aspect-square object-cover rounded-full">
                <div class="text-wrapper text-sm flex flex-col gap-2 overflow-hidden">
                    <h2 class="truncate  text-primary">{{$ulasan->user->name}}</h2>
                    <p class="truncate text-xs">{{$ulasan->pesan}}</p>
                </div>
                <span class="timestamp-label w-max text-nowrap overflow-hidden absolute top-1/2 -right-3 -translate-y-1/2 text-[.65rem] p-[.3rem] px-2 rounded-full bg-amber-50">
                    {{ $ulasan->formatted_date }}
                </span>
            </div>
            @endforeach
        </div>
    </section>
@endsection
