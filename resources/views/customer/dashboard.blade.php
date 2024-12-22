@extends('layouts.cust')

@section('title', 'Dashboard Akun Pelanggan') 

@section('vite') 
    @vite('resources/js/customer/dashboard.js')
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    {{-- Hero Section --}}
    <section id="hero-section" class="container mx-auto px-6 py-6 flex justify-center items-center gap-8 rounded-xl bg-white">
        <img src="{{ asset('images/hello-cust.svg') }}" alt="" class="w-80">
        <div class="text-wrapper flex flex-col gap-4 items-start justify-start">
            <h1 class="font-bold text-4xl text-primary">Lihat dan pantau perkembangan akun Anda</h1>
            <p class="leading-6">Periksa informasi akun, notifikasi pesanan, dan pemberitahuan lainnya terkait akun Anda disini.</p>
        </div>
    </section>

    {{-- Main Dashboard --}}
    <section id="dashboard-section" class="container mx-auto px-10 box-border grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        {{-- Progress dan Profile Card --}}
        <div class="flex flex-col gap-6">
            {{-- Step Progress --}}
            <div class="card step-progress bg-white p-6 rounded-xl ">
                <h2 class="text-center text-primary font-semibold text-2xl">Anda semakin dekat!</h2>
                @php
                    $user = auth()->user();
                    $stepsCompleted = $user && $user->username && $user->email && $user->password && $user->notelp && $orderHistory->isNotEmpty() && $user->hasReviewed;
                @endphp
                @if ($stepsCompleted)
                    <p class="text-center text-sm self-center mt-2">Selamat! Anda telah menyelesaikan semua langkah.</p>
                @else
                    <p class="text-center text-sm self-center mt-2">Tahap ini adalah langkah Anda berikutnya untuk menyelesaikan data akun Anda.</p>
                    <ul class="steps mt-5 text-base text-white font-medium">
                        <li class="step {{ $user ? 'step-primary' : '' }}">
                            <span class="text-sm mt-2 {{ $user ? 'text-primary' : 'text-gray-300 font-normal' }}">
                                Buat/Daftar Akun
                            </span>
                        </li>
                        <li class="step {{ ($user->username && $user->email && $user->password && $user->notelp) ? 'step-primary' : '' }}">
                            <span class="text-sm mt-2 {{ ($user->username && $user->email && $user->password && $user->notelp) ? 'text-primary' : 'text-gray-300 font-normal' }}">
                                Lengkapi Data Pribadi
                            </span>
                        </li>
                        <li class="step {{ $orderHistory->isNotEmpty() ? 'step-primary' : '' }}">
                            <span class="text-sm mt-2 {{ $orderHistory->isNotEmpty() ? 'text-primary' : 'text-gray-300 font-normal' }}">
                                Buat Pesanan
                            </span>
                        </li>
                        <li class="step {{ $user->hasReviewed ? 'step-primary' : '' }}">
                            <span class="text-sm mt-2 {{ $user->hasReviewed ? 'text-primary' : 'text-gray-300 font-normal' }}">
                                Buat Ulasan
                            </span>
                        </li>
                    </ul>
                @endif
            </div>

            {{-- Profile Card --}}
            <div class="card profile-card flex-col items-center bg-white p-6 rounded-xl">
                <h2 class="font-semibold text-primary text-xl mb-4">Informasi data pribadi saya</h2>
                <div class="flex items-center py-6 px-2 justify-center gap-6  w-full">
                    @if($user->foto_profile)
                    <img src="{{ asset('storage/' . $user->foto_profile) }}" alt="customer profile" class="w-36 h-auto aspect-square object-cover object-center rounded-full border-4 self-center my-4">
                    @else
                    <img src="{{ asset('images/default-pfp-cust-single.png') }}" alt="customer profile" class="w-36 h-auto aspect-square object-cover object-center rounded-full border-4 self-center my-4">
                    @endif
                    <div class="customer-data-wrapper flex flex-col gap-1 items-start text-left">
                        <div class="name flex items-center justify-center gap-2">
                            <span>Username :</span>
                            <h3 class="customer-name font-medium text-primary">{{ $user->name }}</h3>
                        </div>
                        <div class="email flex items-center justify-center gap-2">
                            <span>Email :</span>
                            <p class="customer-email font-medium text-primary">{{ $user->email }}</p>
                        </div>
                        <a href="{{ route('customer.profile') }}">
                            <button class="mt-4 py-[.7rem] px-4 rounded-full bg-primary hover:bg-primary-600 active:bg-primary text-white text-sm">Lihat selengkapnya</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order History Card --}}
        <div class="bg-white p-6">
            <div class="header-order-history flex justify-between items-center mb-4">
                <h2 class="font-semibold text-primary text-xl">Riwayat transaksi terbaru</h2>
                <a href="{{ route('customer.order-history') }}" class="text-end flex items-center justify-center pe-2 gap-1 text-secondary hover:text-primary hover:underline text-sm">
                    Lihat semua riwayat
                    <iconify-icon icon="ooui:next-ltr" width="14" height="14"></iconify-icon>
                </a>
            </div>
            @if($orderHistory->isEmpty())
                <p class="text-center text-sm text-gray-500">Anda belum memiliki riwayat transaksi.</p>
            @else
                <div class="items-wrapper flex flex-col gap-4">
                    @foreach($orderHistory as $order)
                        <div class="item p-4 rounded-xl border
                            {{ $order['status'] == 'Pending' ? 'bg-yellow-50 border-yellow-200 text-yellow-500' : ''}}
                            {{ $order['status'] == 'Progress' ? 'bg-green-50 border-green-200 text-green-500' : '' }}
                            {{ $order['status'] == 'Completed' ? 'bg-gray-50 border-gray-200 text-gray-500' : '' }}
                            {{ $order['status'] == 'Canceled' ? 'bg-red-50 border-red-200 text-red-500' : '' }}
                            flex flex-col gap-1">
                            <p class="order-date text-xs">{{ $order['created_date'] }}</p>
                            <p class="total-bill font-bold text-xl">Rp. {{ number_format($order['total_price'], 0, ',', '.') }}</p>
                            <p class="order-status text-xs">{{ $order['status'] }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
