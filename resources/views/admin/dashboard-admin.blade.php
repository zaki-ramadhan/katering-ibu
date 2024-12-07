@extends('layouts.admin')

@section('title', 'Dashboard Admin') 

@section('vite') 
    {{-- @vite('resources/js/customer/dashboard.js') --}}
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
    <section id="hero-section" class="container px-10 py-6 flex items-center justify-center gap-20 rounded-2xl bg-white shadow-md shadow-slate-200">
        <img src="{{ asset('images/admin.svg') }}" alt="admin svg" class="w-72">
        <div class="text-wrapper flex flex-col gap-3 items-start justify-start">
            <p class="font-semibold text-xl">Halo, Admin !</p>
            <h1 class="font-bold sm:text-3xl md:text-4xl grow text-primary">Pantau dan kelola semua data dan pengaturan.</h1>
            <p class="text-sm lg:text-base leading-6 mt-2">Kelola status pesanan, pelanggan, dan operasional bisnis Anda dalam satu dashboard.</p>
        </div>
    </section>

    <section id="dashboard-stats-section" class="container">
        <div class="card-wrapper grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-5 " uk-sortable>
            <div class="card userData-card flex flex-col gap-3 p-5 rounded-xl bg-white shadow-md shadow-slate-200 relative before:content-[''] before:absolute before:top-1/2 before:-left-2 before:-translate-y-1/2 before:w-2 before:h-[80%] before:rounded-ss-full before:rounded-es-full before:bg-red-500">
                <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-red-500">Data Pelanggan</p>
                <h3 class="data-count text-2xl font-bold">{{ $jmlPelanggan }}</h3>
                <a href="{{route('admin.data-pelanggan')}}" class="w-max hover:text-primary hover:no-underline">
                    <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                        Lihat selengkapnya
                        <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                    </button>
                </a>
            </div>
            <div class="card menuData-card flex flex-col gap-3 p-5 rounded-xl bg-white shadow-md shadow-slate-200 relative before:content-[''] before:absolute before:top-1/2 before:-left-2 before:-translate-y-1/2 before:w-2 before:h-[80%] before:rounded-ss-full before:rounded-es-full before:bg-emerald-500">
                <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-emerald-500">Data Menu</p>
                <h3 class="data-count text-2xl font-bold">{{ $jmlMenu }}</h3>
                <a href="{{route('admin.data-menu')}}" class="w-max hover:text-primary hover:no-underline">
                    <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                        Lihat selengkapnya
                        <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                    </button>
                </a>
            </div>
            <div class="card orderData-card flex flex-col gap-3 p-5 rounded-xl bg-white shadow-md shadow-slate-200 relative before:content-[''] before:absolute before:top-1/2 before:-left-2 before:-translate-y-1/2 before:w-2 before:h-[80%] before:rounded-ss-full before:rounded-es-full before:bg-blue-500">
                <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-blue-500">Data Pesanan</p>
                <h3 class="data-count text-2xl font-bold">0</h3>
                <a href="{{ route('admin.data-pesanan') }}  " class="w-max hover:text-primary hover:no-underline">
                    <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                        Lihat selengkapnya
                        <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                    </button>
                </a>
            </div>
            <div class="card feedbackData-card flex flex-col gap-3 p-5 rounded-xl bg-white shadow-md shadow-slate-200 relative before:content-[''] before:absolute before:top-1/2 before:-left-2 before:-translate-y-1/2 before:w-2 before:h-[80%] before:rounded-ss-full before:rounded-es-full before:bg-amber-500">
                <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-yellow-500">Data Ulasan</p>
                <h3 class="data-count text-2xl font-bold">{{ $jmlUlasan }}</h3>
                <a href="{{ route('admin.data-ulasan') }}" class="w-max hover:text-primary hover:no-underline">
                    <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                        Lihat selengkapnya
                        <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                    </button>
                </a>
            </div>
        </div>
    </section>
@endsection
