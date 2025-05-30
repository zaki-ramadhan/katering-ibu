@extends('layouts.app')

@section('title', 'Hubungi Kami - Katering Ibu') 

@section('vite') 
    @vite('resources/js/contact-us.js')
@endsection

{{-- alert berhasil --}}
@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-[25%] bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif


@section('content')
    {{-- hero-section --}}
    <section id font-light="hero-section" class="container px-4 py-12 relative text-primary flex flex-col-reverse justify-between items-center">
        <img src="{{ asset('images/contact-us.svg') }}" alt="hero img" class="w-96 lg:w-[36rem] -ms-5 mt-6">
        <div class="text-btn-wrapper flex flex-col gap-4 pe-8 items-center text-center">
            <h2 class="font-medium lg:text-lg text-primary-600">Punya pertanyaan terkait Katering Ibu?</h2>
            <h1 class="w-[34rem] lg:w-[45rem] font-bold text-4xl lg:text-5xl leading-[1.2]">Kami selalu siap mendengar & menjawab keluhan Anda.</h1>
            <p class="font-light text-sm lg:taxt-base lg:text-base text-secondary leading-6">Anda bisa tanyakan apapun terkait Katering Ibu,<br>
                Kami akan dengan senang hati menjawab pertanyaan Anda.</p>
            @auth
            <a href="#contact-form" class="scroll-to">
                <button class="w-max py-4 px-5 mt-3 rounded-lg bg-primary hover:bg-primary-600 active:bg-primary duration-150 text-white text-xs lg:text-sm">Kirimkan pertanyaan Anda</button>
            </a>
                
            @else
            <a href="login" class="scroll-to">
                <button class="w-max py-4 px-5 mt-3 rounded-lg bg-primary hover:bg-primary-600 active:bg-primary duration-150 text-white text-xs">Kirimkan pertanyaan Anda</button>
            </a>
            @endauth
        </div>
    </section>

    <section id="form-section" class="container px-4 lg:px-10 py-32 flex flex-col lg:grid lg:grid-cols-2 gap-20 lg:gap-6 text-primary bg-tertiary scroll-pt-5">
        <div class="detail-info-group flex flex-col gap-3 mx-8">
            <h1 class="font-medium text-2xl">Mari terhubung!</h1>
            <p class="text-secondary font-light">Butuh informasi lebih lanjut? Anda bisa menghubungi Kami melalui detail di bawah ini. Kami siap menjawab setiap pertanyaan Anda!</p>
            <ul class="flex flex-col gap-8 mt-8">
                <li>
                    <div class="item-wrapper flex gap-6 pe-16">
                        <iconify-icon icon="ion:location-sharp" class="w-12 h-12 aspect-square bg-primary rounded-md text-white text-2xl grid place-content-center"></iconify-icon>
                        <div class=" flex flex-col gap-1">
                            <h3 class="font-medium text-base">Alamat</h3>
                            <p class="text-secondary text-sm font-light">Perumahan Margalaksana 1, Jalan Gunung Ciremai No.25, RT.4/RW.8, Margadadi,  Indramayu</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-wrapper flex gap-6">
                        <iconify-icon icon="fontisto:email" class="w-12 aspect-square bg-primary rounded-md text-white text-2xl grid place-content-center"></iconify-icon>
                        <div class=" flex flex-col gap-1">
                            <h3 class="font-medium text-base">Email</h3>
                            <p class="text-secondary text-sm font-light">pujiarti302@gmail.com</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-wrapper flex gap-6">
                        <iconify-icon icon="fontisto:phone" class="w-12 h-max aspect-square bg-primary rounded-md text-white text-lg grid place-content-center"></iconify-icon>
                        <div class=" flex flex-col gap-1">
                            <h3 class="font-medium text-base">No. telepon</h3>
                            <p class="text-secondary text-sm font-light">0899-0899-0899</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <form id="contact-form" action="{{ route('ulasan.store') }}" method="POST" class="flex flex-col gap-3 p-8 rounded-2xl bg-white">
            @csrf
            <h1 class="font-medium text-xl mb-3">Kirim Pesan</h1>
            <input type="hidden" name="id_customer" value="{{ auth()->user() ? auth()->user()->id : '' }}"> <!-- Tambahkan ID pengguna -->
            <div class="nameInput-wrapper flex flex-col gap-2">
                <label for="name" class="text-sm ">Nama Anda<span class="text-red-400 ms-[2px]">*</span></label>
                <input type="text" name="nama_pelanggan" id="name" autocomplete="off" value="{{ auth()->user() ? auth()->user()->name : '' }}" required class="rounded-md focus:ring-0 text-sm">
            </div>
            <div class="emailInput-wrapper flex flex-col gap-2">
                <label for="email" class="text-sm ">Email Anda<span class="text-red-400 ms-[2px]">*</span></label>
                <input type="email" name="email" id="email" autocomplete="off" value="{{ auth()->user() ? auth()->user()->email : '' }}" readonly class="text-secondary rounded-md hover:ring-0 focus:ring-inset focus:ring-0 focus:border-primary text-sm cursor-default">
            </div>
            <div class="messageInput-wrapper flex flex-col gap-2">
                <label for="message" class="text-sm ">Isi Pesan<span class="text-red-400 ms-[2px]">*</span></label>
                <textarea name="pesan" id="message" autocomplete="off" required cols="30" rows="5" class="resize-none rounded-md focus:ring-0 text-sm"></textarea>
            </div>
            @auth
            <button type="submit" class="w-max bg-primary hover:bg-primary-600 active:bg-primary duration-150 text-white px-8 py-4 rounded-lg text-xs font-normal">Kirim Pesan</button>
            @else
            <div class="btn-wrapper relative group w-max">
                <button disabled class="w-max bg-secondary text-white px-8 py-4 rounded-lg text-xs font-normal">Kirim Pesan</button>
                <div class="tooltip hidden w-max group-hover:inline-block absolute -bottom-10 left-1/2 -translate-x-[25%] text-xs px-3 py-2 rounded-md bg-primary text-white">
                    Login terlebih dahulu
                </div>
            </div>
            @endauth
        </form>                
    </section>
@endsection
