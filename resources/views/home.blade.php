@extends('layouts.app')

@section('title', 'Katering Ibu - Layanan Katering Rumahan') 

@section('vite') 
    @vite('resources/js/home.js')
@endsection

{{-- alert berhasil --}}
@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    {{-- hero-section --}}
    <section id="hero-section" class="container px-4 relative text-white">
        <div class="img-overlay-group container w-full h-[24rem] lg:h-[36rem] overflow-hidden relative rounded-xl lg:rounded-3xl">
            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGV2ZW50JTIwZm9vZHxlbnwwfHwwfHx8MA%3D%3D" alt="hero image" class="w-full">
            <div class="overlay w-full h-full bg-gradient-to-t from-black/50 to-black/40 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            </div>
        </div>
        <div class="text-button-group absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center content-center gap-4 text-center">
            <h1 class="text-5xl lg:text-6xl font-semibold w-max">Buat hidangan acaramu<br>jadi lebih berkualitas.</h1>
            <p class="text-sm lg:text-lg -mt-2 lg:mt-2">dengan Katering Ibu - Solusi Kebutuhan Katering Anda.</p>
            @auth
                <a href="{{ route('menu') }}">
                    <button id="btn-order-now" class="group ps-2 pe-4 py-2 lg:pe-5 rounded-full bg-primary hover:bg-gradient-to-r hover:from-primaryHovered hover:to-primary hover:scale-[1.01] duration-200 text-xs lg:text-sm text-white/60 hover:text-white active:bg-primary flex items-center content-center gap-2 lg:gap-3 mt-3">
                        <iconify-icon icon="akar-icons:shopping-bag" class="text-lg lg:text-2xl p-2 bg-primary-600 rounded-full group-hover:bg-primary duration-200"></iconify-icon>
                        {{ auth()->check() ? 'Pesan sekarang' : 'Buat Pesanan Pertama Anda' }}
                        <iconify-icon icon="fluent:arrow-right-20-filled" class="text-lg lg:text-xl group-hover:ms-6 duration-200"></iconify-icon>
                    </button>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <button id="btn-order-now" class="group ps-2 pe-4 py-2 rounded-full bg-primary hover:bg-gradient-to-r hover:from-primaryHovered hover:to-primary duration-200 text-xs lg:text-sm text-secondary hover:text-white active:bg-primary flex items-center content-center gap-2 mt-3">
                        <iconify-icon icon="akar-icons:shopping-bag" class="text-lg p-2 bg-primary-600 rounded-full group-hover:bg-primary duration-200"></iconify-icon>
                        Ayo mulai memesan
                        <iconify-icon icon="fluent:arrow-right-20-filled" class="text-lg group-hover:ms-6 duration-200"></iconify-icon>
                    </button>
                </a>
            @endauth
        </div>
    </section>

    {{-- features section --}}
    <section id="features-section" class="container flex items-center justify-center lg:h-[26rem] px-4 mt-6">
        <div class="features-wrapper container bg-white lg:bg-transparent px-6 pt-6 lg:pt-20 rounded-xl cursor-default">
            <h1 class="text-base text-primary ps-4 lg:hidden relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Kenapa harus <span class="font-bold">Katering Ibu?</span></h1>
            <h1 class="text-primary hidden lg:block text-4xl font-semibold text-center mb-4">Kenapa harus Katering Ibu?</h1>
            <div class="content-wrapper text-center lg:text-left text-sm text-primary hover:text-secondary flex gap-2 lg:gap-5 py-10">
                <div class="feature-item lg:bg-slate-100 lg:p-2 lg:rounded-xl flex flex-col lg:flex-row items-center content-center gap-2 lg:gap-4 flex-1 lg:text-base hover:text-primary hover:-translate-y-1 duration-150 active:translate-y-[1px]">
                    <iconify-icon icon="mdi:food-drumstick" class="text-5xl lg:p-5 lg:rounded-xl lg:bg-white"></iconify-icon>
                    <h2 class="line-clamp-2 lg:line-clamp-none overflow-hidden">Menu dengan kualitas pelayanan terbaik</h2>
                </div>
                <div class="feature-item lg:bg-slate-100 lg:p-2 lg:rounded-xl flex flex-col lg:flex-row items-center content-center gap-2 lg:gap-4 flex-1 lg:text-base hover:text-primary hover:-translate-y-1 duration-150 active:translate-y-[1px]">
                    <iconify-icon icon="medical-icon:i-social-services" class="text-5xl lg:p-5 lg:rounded-xl lg:bg-white"></iconify-icon>
                    <h2 class="line-clamp-2 lg:line-clamp-none overflow-hidden">Layanan profesional dengan penuh kepercayaan</h2>
                </div>
                <div class="feature-item lg:bg-slate-100 lg:p-2 lg:rounded-xl flex flex-col lg:flex-row items-center content-center gap-2 lg:gap-4 flex-1 lg:text-base hover:text-primary hover:-translate-y-1 duration-150 active:translate-y-[1px]">
                    <iconify-icon icon="ri:service-fill" class="text-5xl lg:p-5 lg:rounded-xl lg:bg-white"></iconify-icon>
                    <h2 class="line-clamp-2 lg:line-clamp-none overflow-hidden">Dipercaya oleh lebih dari 100+ pelanggan setia</h2>
                </div>
                <div class="feature-item lg:bg-slate-100 lg:p-2 lg:rounded-xl flex flex-col lg:flex-row items-center content-center gap-2 lg:gap-4 flex-1 lg:text-base hover:text-primary hover:-translate-y-1 duration-150 active:translate-y-[1px]">
                    <iconify-icon icon="healthicons:money-bag" class="text-5xl lg:p-5 lg:rounded-xl lg:bg-white"></iconify-icon>
                    <h2 class="line-clamp-2 lg:line-clamp-none overflow-hidden">Harga kompetitif dengan cita rasa istimewa</h2>
                </div>
            </div>
        </div>
    </section>

    {{-- top-menu-section --}}
    <section id="top-menu-section" class="container px-4">
        <div class="top-menu-wrapper w-full p-6 bg-white md:bg-transparent mt-6 rounded-xl">
            <h2 class="lg:hidden text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Menu <span class="font-bold">terlaris</span> saat ini</h2>
            <div class="head-content hidden lg:flex text-center flex-col gap-4 mb-5">
                <h2 class="text-4xl text-primary font-semibold">Menu favorit pilihan pelanggan</h2>
                <p>Berdasarkan banyaknya pemesanan yang dilakukan oleh pelanggan kami.</p>
            </div>
            <div class="card-wrapper group grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pt-6 text-primary hover:text-secondary ">
                @foreach ( $bestSellingMenus as $item)
                <figure class="card relative flex-1 hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-lg hover:border-slate-300">
                    <div class="img-container aspect-square rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}" class="w-full h-full object-cover brightness-100 duration-200">
                        {{-- <div class="rating-menu absolute top-6 left-5 bg-white px-3 py-1 rounded-full flex items-center content-center gap-1 font-medium text-sm">
                            <iconify-icon icon="ri:star-fill" class="text-sm -translate-y-[1px] text-yellow-400"></iconify-icon>
                            {{ $item['rating'] }}
                        </div> --}}
                    </div>
                    <figcaption class="card-content mt-4 flex flex-col gap-1">
                        <div class="text-wrapper relative w-full flex gap-3 justify-between">
                            <div class="flex flex-col gap-2 text-primary">
                                <h3 class="menu-name font-normal line-clamp-1">{{ $item->nama_menu }}</h3>
                                <p class="menu-price font-bold text-lg before:content-['Rp']"> {{ number_format($item->harga, 0, ',', '.') }}</p>
                            </div>
                            <span class="label_terjual min-w-max h-max text-[.7rem] p-2 rounded-full bg-blue-50 text-blue-400">Terjual {{$item->terjual}} porsi</span>
                        </div>
                        @auth    
                        <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}" class="w-full">
                            <button class="btn-order w-full bg-orderDeactive hover:bg-orderHovered active:bg-orderClicked text-white mt-4 py-3 text-xs lg:text-sm flex items-center justify-center gap-1 rounded-lg duration-150">
                                <iconify-icon icon="tdesign:shop-filled" class="text-base -translate-y-[1px]"></iconify-icon>
                                Pesan Sekarang
                            </button>
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="w-full">
                            <button class="btn-order w-full bg-secondary-300 hover:bg-secondary active:bg-tertairy text-white mt-4 py-3 text-xs lg:text-sm flex items-center justify-center gap-1 rounded-lg duration-150 cursor-default">
                                <iconify-icon icon="tdesign:shop-filled" class="text-base -translate-y-[1px]"></iconify-icon>
                                Pesan Sekarang
                            </button>
                        </a>
                        @endauth
                    </figcaption>
                </figure>
                @endforeach
            </div>
        </div>
    </section>
    
    {{-- menu-section --}}
    <section id="menu-section" class="container px-4">
        <div class="menu-wrapper w-full px-6 bg-white mt-6 lg:mt-16 py-6 rounded-xl">
            <h2 class="lg:hidden text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Semua <span class="font-bold">Menu (7)</span></h2>
            <div class="head-content hidden lg:flex text-center flex-col gap-4 mb-5">
                <h2 class="text-4xl text-primary font-semibold">Coba juga menu ini</h2>
                <p>Jelajahi berbagai menu lainnya, termasuk yang paling sering dipesan.</p>
            </div>
            <div class="card-wrapper group grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pt-6 text-primary hover:text-secondary ">
                @foreach ( $menu as $item)
                <figure class="card relative flex-1 hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-lg hover:border-slate-300">
                    <div class="img-container aspect-square rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}" class="w-full h-full object-cover brightness-100 duration-200">
                        {{-- <div class="rating-menu absolute top-6 left-5 bg-white px-3 py-1 rounded-full flex items-center content-center gap-1 font-medium text-sm">
                            <iconify-icon icon="ri:star-fill" class="text-sm -translate-y-[1px] text-yellow-400"></iconify-icon>
                            {{ $item['rating'] }}
                        </div> --}}
                    </div>
                    <figcaption class="card-content mt-4 flex flex-col gap-1">
                        <h3 class="menu-name font-normal text-md">{{ $item->nama_menu }}</h3>
                        <p class="menu-price font-bold text-lg before:content-['Rp']"> {{ number_format($item->harga, 0, ',', '.') }}</p>
                        @auth    
                        <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}" class="w-full">
                            <button class="btn-order w-full bg-orderDeactive hover:bg-orderHovered active:bg-orderClicked text-white mt-4 py-3 text-xs lg:text-sm flex items-center justify-center gap-1 rounded-lg duration-150">
                                <iconify-icon icon="tdesign:shop-filled" class="text-base -translate-y-[1px]"></iconify-icon>
                                Pesan Sekarang
                            </button>
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="w-full">
                            <button class="btn-order w-full bg-secondary-300 hover:bg-secondary active:bg-tertairy text-white mt-4 py-3 text-xs lg:text-sm flex items-center justify-center gap-1 rounded-lg duration-150 cursor-default">
                                <iconify-icon icon="tdesign:shop-filled" class="text-base -translate-y-[1px]"></iconify-icon>
                                Pesan Sekarang
                            </button>
                        </a>
                        @endauth
                    </figcaption>
                </figure>
                @endforeach
            </div>
            <a href="{{ route('menu') }}" class="block place-self-end">
                <button id="btn-lihat-semua" class="w-full bg-tertiary text-primary hover:bg-slate-200/70 active:bg-slate-300/70 duration-150 p-4 mt-5 rounded-md text-xs lg:text-sm lg:font-medium lg:w-max lg:px-10 lg:place-self-start lg:mt-10">Lihat Semua Menu</button>
            </a>
        </div>
    </section>

    <section id="order-guide-section" class="container px-4">
        <div class="order-guide-wrapper p-6 mt-6 lg:mt-32 bg-white rounded-xl flex flex-col gap-4">
            <header class="header-order-guide relative flex items-center justify-start bg-tertiary rounded-xl lg:rounded-3xl overflow-hidden">
                {{-- pattern svg --}}
                <img src="../../images/pattern-for-header-order-guide.svg" alt="pattern svg"  class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full object-cover opacity-5">
                <img src="../../images/people-confused.svg" alt="people confused img" class="w-64 lg:w-80 aspect-square translate-y-5 lg:ms-16 -translate-x-5">
                <div class="text-group flex flex-col justify-center items-start gap-3 -ms-6 text-primary">
                    <h2 class="text-3xl lg:text-4xl">Bagaimana cara saya <span class="font-semibold lg:font-bold">memesan</span> menu?</h2>
                    <p class="text-sm italic lg:text-lg lg:mt-2">- Sini biar mimin kasi tau caranya</p>
                </div>
            </header>
            <div class="order-guide-content group flex gap-2 text-secondary/40 font-semibold hover:text-secondary duration-200 cursor-default">
                <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end text-primary bg-tertiary-100 text-5xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="1">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        01
                    </span>
                </div>
                <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="2">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        02
                    </span>
                </div>
                <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="3">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        03
                    </span>
                </div>
                <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="4">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        04
                    </span>
                </div>
                <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="5">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        05
                    </span>
                </div>
                <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="6">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        06
                    </span>
                </div>
                <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="7">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        07
                    </span>
                </div>
            </div>
            <div class="main-content-order-guide w-full bg-tertiary text-primary rounded-xl lg:rounded-3xl p-6">
                <div class="content p-2 rounded-xl lg:flex lg:items-center lg:justify-between">
                    {{-- isi konten sesuai langkah yang diklik --}}
                    <div>
                        <h3 class="head-order-guide text-6xl lg:text-8xl font-semibold lg:mb-2">01</h3>
                        <p class="detail-order-guide mt-2 lg:text-xl">Registrasi / Login ke Akun Anda terlebih dahulu.</p>
                    </div>
                    <img src="../../images/sign-up.svg" alt="two people discuss svg" class="order-guide-img max-w-[25rem]">
                    {{-- <p class="brand-name text-xs text-right text-tertiary">@kateringibu2024</p> --}}
                </div>
            </div>
        </div>
    </section>

    {{-- rating user section --}}
    <section id="rating-users-section" class="container px-4 lg:mt-60">
        <div class="rating-wrapper w-full overflow-hidden p-6 mt-6 rounded-xl bg-white">
            <h2 class="lg:hidden text-md text-primary ps-4 mt-2 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Beberapa ulasan dari <span class="font-bold">pelanggan setia</span> kami</h2>
            <div class="head-content hidden lg:flex text-center flex-col gap-4 mb-16">
                <h2 class="text-4xl text-primary font-semibold">Apa kata mereka?</h2>
                <p>Kepuasan pelanggan adalah prioritas kami. Berikut beberapa testimoni dari mereka.</p>
            </div>
            @if($ulasan->isEmpty())
                <div class="py-5 px-6 flex items-center justify-start gap-2 bg-yellow-200 text-primary rounded-sm text-sm">
                    <iconify-icon icon="mingcute:warning-line" class="text-2xl"></iconify-icon>
                    <span>Tidak ada ulasan pelanggan yang tersedia.</span>
                </div>
            @else
                <div class="card-wrapper flex flex-col lg:grid lg:grid-cols-2 gap-4 mt-8 cursor-default">
                    @foreach ($ulasan as $item)
                        <div class="card rating-card text-primary flex flex-row p-4 gap-4 bg-tertiary rounded-xl hover:bg-primary duration-300 hover:text-white hover:shadow-lg hover:shadow-slate-400">
                            <img src="{{ $item->user->foto_profile ? asset('storage/' . $item->user->foto_profile) : asset('images/default-pfp-cust-single.png') }}" alt="profile user image" class="profile-user rounded-full border-2 border-secondary/50 w-16 lg:w-[5rem] h-max aspect-square object-cover">
                            <div class="text-wrapper flex flex-col gap-2">
                                <h4 class="username font-semibold">{{ $item->user->name }}</h4>
                                {{-- <p class="email-user text-xs lg:text-sm text-secondary/50">{{ str_replace(substr($item->user->email, 1, 8), '******', $item->user->email) }}</p> --}}
                                <p class="message-rating text-xs lg:text-sm leading-5 lg:leading-6 text-secondary line-clamp-3">{{ $item->pesan }}</p>
                                <p class="rating-created-at text-xs text-secondary/50 mt-3 text-right">{{ $item->formatted_date }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@endsection
