@extends('layouts.cust')

@section('title', 'Dashboard Akun Pelanggan') 

@section('vite') 
    @vite('resources/js/customer/dashboard.js')
@endsection

@section('style')
    <style>
        .cover {
            background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='80' height='80' patternTransform='scale(2) rotate(0)'><rect x='0' y='0' width='100%' height='100%' fill='%23334155ff'/><path d='M0 0v40h40V0H0zm40 40v40h40V40H40zM4 4h32v32H4V4zm4 4v24h24V8H8zm4 4h16v16H12V12zm4.043 3.988v8.004h8.004v-8.004h-8.004zM44 44h32v32H44V44zm4 4v24h24V48H48zm4 4h16v16H52V52zm4.043 3.984v8.006h8.004v-8.006h-8.004z'  stroke-width='1' stroke='none' fill='%23cbd5e1ff'/><path d='M44 4v32h32V4H44zm4 4h24v24H48V8zm4 4v16h16V12H52zm4 4h8v8h-8v-8zM4 44v32h32V44H4zm4 4h24v24H8V48zm4 4v16h16V52H12zm4 4h8v8h-8v-8z'  stroke-width='1' stroke='none' fill='%2394a3b8ff'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>")
        }
        
        /* menghilangkan scrolll bar */
        .items-wrapper {
            scrollbar-width: none; /* Menjadikan scrollbar lebih kecil */
            scrollbar-color: #888 #f1f1f1; /* Warna scrollbar dan track */
        }
    </style>
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    {{-- hero section --}}
    <section id="hero-section" class="container px-4 py-6 flex items-center gap-8 rounded-xl bg-white">
        <img src="{{ asset('images/hello-cust.svg') }}" alt="" class="w-72 -translate-x-6">
        <div class="text-wrapper flex flex-col gap-4 items-center justify-start -translate-x-12">
            <h1 class="font-bold text-4xl w-full grow text-primary ">Lihat dan pantau perkembangan akun Anda.</h1>
            <p class="text-sm leading-6">Periksa informasi akun, notifikasi pesanan, dan pemberitahuan lainnya terkait Akun Anda disini.</p>
        </div>
    </section>

    <section id="secondary-section" class="container grid grid-cols-2 gap-4">
        <div class="step-progress col-span-2 px-4 py-8 bg-white rounded-xl flex flex-col gap-2">
            <h2 class="text-center text-primary font-semibold text-xl">Anda semakin dekat!</h2>
            <p class="text-center text-sm w-80 self-center">Tahap ini adalah langkah Anda berikutnya untuk menyelesaikan data akun Anda.</p>
            <ul class="steps mt-5 text-sm">
                <li class="step step-primary">Buat akun</li>
                <li class="step step-primary">Isi data Username</li>
                <li class="step">Isi data Email</li>
                <li class="step">Isi data Password</li>
                <li class="step">Isi data No HP</li>
                </ul>
            </div>
            
        {{-- data customer --}}
        <div class="card profile-card  bg-white p-6 rounded-lg flex flex-col gap-4">
            <h2 class="font-semibold text-primary text-base">Informasi data pribadi Anda saat ini</h2>
            
            @if(auth()->user()->foto_profile)
            <img src="{{ asset('storage/' . auth()->user()->foto_profile) }}" alt="customer profile" class="aspect-square object-cover object-[50%_10%] rounded-full border-4">
            @else
            <img src="{{ asset('images/default-pfp-cust-single.png') }}" alt="customer profile" class="aspect-square object-cover object-[50%_10%] rounded-full border-4">
            @endif
            
            <div class="customer-data-wrapper flex flex-col gap-1 text-center">
                <h3 class="customer-name font-semibold text-primary">{{ auth()->user()->name }}</h3>
                <p class="customer-email text-sm font-normal">{{ auth()->user()->email }}</p>
                <a href="{{route('customer.profile')}}">
                    <button class="py-4 px-5 rounded-lg bg-primary hover:bg-primary-600 active:bg-primary active:scale-95 transition-transform duration-150 text-white text-xs font-medium mt-2">Lihat selengkapnya</button>
                </a>
            </div>
        </div>

        {{-- orderhistory card --}}
        <div class="card orderhistory-card bg-white p-6 rounded-lg flex flex-col gap-4">
            <h2 class="font-semibold text-primary text-base">Riwayat transaksi terbaru Anda</h2>
            <div class="items-wrapper flex flex-col gap-4 max-h-[17.3rem] overflow-y-scroll ">
                <div class="item p-4 rounded-xl bg-yellow-100 text-yellow-500 flex flex-col gap-1">
                    <p class="order-date-created text-xs">2024-11-28</p>
                    <p class="total-bill font-bold text-xl">Rp. 980,000</p>
                    <p class="order-status text-xs">Dalam Pengiriman</p>
                </div>
                <div class="item p-4 rounded-xl bg-emerald-100 text-emerald-500 flex flex-col gap-1">
                    <p class="order-date-created text-xs">2024-11-19</p>
                    <p class="total-bill font-bold text-xl">Rp. 720,000</p>
                    <p class="order-status text-xs">Selesai</p>
                </div>
                <div class="item p-4 rounded-xl bg-emerald-100 text-emerald-500 flex flex-col gap-1">
                    <p class="order-date-created text-xs">2024-11-03</p>
                    <p class="total-bill font-bold text-xl">Rp. 360,000</p>
                    <p class="order-status text-xs">Selesai</p>
                </div>
            </div>
            <a href="{{route('customer.order-history')}}" class="self-center">
                <button class="py-4 px-5 rounded-lg bg-primary hover:bg-primary-600 active:bg-primary active:scale-95 transition-transform duration-150 text-white text-xs font-medium mt-2">Lihat selengkapnya</button>
            </a>
        </div>
    </section>
@endsection