@extends('layouts.app')

@section('title', 'Katering Ibu - Layanan Katering Rumahan')

@section('vite')
    @vite('resources/js/home.js')
@endsection

{{-- alert berhasil --}}
@if (session('success'))
    <div id="alert"
        class="fixed top-0 left-1/2 transform -translate-x-[25%] bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    {{-- hero-section --}}
    <section id="hero-section" class="relative px-4 text-white">
        <div class="relative w-full h-[24rem] lg:h-[36rem] overflow-hidden rounded-xl lg:rounded-3xl">
            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGV2ZW50JTIwZm9vZHxlbnwwfHwwfHx8MA%3D%3D"
                alt="hero image" class="w-full h-full object-cover">

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/40"></div>

            {{-- Content --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center gap-4 text-center p-4">
                <h1 class="text-3xl md:text-5xl font-bold lg:text-7xl">
                    Buat hidangan acaramu<br>jadi lebih berkualitas.
                </h1>
                <p class="text-sm lg:text-lg">Katering Ibu - Solusi Kebutuhan Katering Anda.</p>
                @auth
                    <a href="{{ route('menu') }}">
                        <button id="btn-order-now"
                            class="group ps-2 pe-4 py-2 lg:pe-5 rounded-full bg-primary hover:bg-gradient-to-r hover:from-primaryHovered hover:to-primary hover:scale-[1.01] duration-200 text-xs lg:text-sm text-white/80 hover:text-white active:bg-primary flex items-center gap-2 lg:gap-3 mt-3">
                            <div
                                class="flex items-center justify-center p-2 rounded-full bg-primary-600 group-hover:bg-primary duration-200">
                                <iconify-icon icon="akar-icons:shopping-bag" class="text-lg lg:text-xl"></iconify-icon>
                            </div>
                            <span
                                class="font-semibold">{{ auth()->check() ? 'Pesan sekarang' : 'Buat Pesanan Pertama Anda' }}</span>
                            <iconify-icon icon="fluent:arrow-right-20-filled"
                                class="text-lg duration-200 lg:text-xl group-hover:translate-x-2"></iconify-icon>
                        </button>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <button id="btn-order-now"
                            class="group ps-2 pe-4 py-2 lg:pe-5 rounded-full bg-primary hover:bg-gradient-to-r hover:from-primaryHovered hover:to-primary hover:scale-[1.01] duration-200 text-xs lg:text-sm text-white/80 hover:text-white active:bg-primary flex items-center gap-2 lg:gap-3 mt-3">
                            <div
                                class="flex items-center justify-center p-2 rounded-full bg-primary-600 group-hover:bg-primary duration-200">
                                <iconify-icon icon="akar-icons:shopping-bag" class="text-lg lg:text-xl"></iconify-icon>
                            </div>
                            <span class="font-semibold">Ayo mulai memesan</span>
                            <iconify-icon icon="fluent:arrow-right-20-filled"
                                class="text-lg duration-200 lg:text-xl group-hover:translate-x-2"></iconify-icon>
                        </button>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- features section --}}
    <section id="features-section" class="container flex items-center justify-center lg:h-[26rem] px-4 mt-6">
        <div
            class="container px-4 lg:px-6 pt-6 bg-white cursor-default features-wrapper lg:bg-transparent lg:pt-20 rounded-xl">
            <h1
                class="text-base text-primary ps-4 lg:hidden relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full">
                Kenapa harus <span class="font-bold">Katering Ibu?</span></h1>
            <h1 class="hidden mb-4 text-4xl font-semibold text-center text-primary lg:block">Kenapa harus Katering Ibu?</h1>
            <div
                class="grid grid-cols-2 lg:flex gap-2 py-10 text-sm text-center content-wrapper lg:text-left text-primary hover:text-secondary lg:gap-5">
                <div
                    class="flex flex-col items-center content-center flex-1 gap-2 duration-150 feature-item lg:bg-slate-100 lg:p-2 lg:rounded-xl lg:flex-row lg:gap-4 lg:text-base hover:text-primary">
                    <iconify-icon icon="mdi:food-drumstick"
                        class="text-5xl lg:p-5 lg:rounded-xl lg:bg-white"></iconify-icon>
                    <h2 class="overflow-hidden line-clamp-2 lg:line-clamp-none">Menu dengan kualitas pelayanan terbaik</h2>
                </div>
                <div
                    class="flex flex-col items-center content-center flex-1 gap-2 duration-150 feature-item lg:bg-slate-100 lg:p-2 lg:rounded-xl lg:flex-row lg:gap-4 lg:text-base hover:text-primary">
                    <iconify-icon icon="medical-icon:i-social-services"
                        class="text-5xl lg:p-5 lg:rounded-xl lg:bg-white"></iconify-icon>
                    <h2 class="overflow-hidden line-clamp-2 lg:line-clamp-none">Layanan profesional dengan penuh kepercayaan
                    </h2>
                </div>
                <div
                    class="flex flex-col items-center content-center flex-1 gap-2 duration-150 feature-item lg:bg-slate-100 lg:p-2 lg:rounded-xl lg:flex-row lg:gap-4 lg:text-base hover:text-primary">
                    <iconify-icon icon="ri:service-fill" class="text-5xl lg:p-5 lg:rounded-xl lg:bg-white"></iconify-icon>
                    <h2 class="overflow-hidden line-clamp-2 lg:line-clamp-none">Dipercaya oleh lebih dari 100+ pelanggan
                        setia</h2>
                </div>
                <div
                    class="flex flex-col items-center content-center flex-1 gap-2 duration-150 feature-item lg:bg-slate-100 lg:p-2 lg:rounded-xl lg:flex-row lg:gap-4 lg:text-base hover:text-primary">
                    <iconify-icon icon="healthicons:money-bag"
                        class="text-5xl lg:p-5 lg:rounded-xl lg:bg-white"></iconify-icon>
                    <h2 class="overflow-hidden line-clamp-2 lg:line-clamp-none">Harga kompetitif dengan cita rasa istimewa
                    </h2>
                </div>
            </div>
        </div>
    </section>

    {{-- top-menu-section --}}
    <section id="top-menu-section" class="container px-4">
        <div class="w-full p-4 lg:p-6 mt-6 bg-white top-menu-wrapper md:bg-transparent rounded-xl">
            <h2
                class="lg:hidden text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full">
                Menu <span class="font-bold">terlaris</span> saat ini</h2>
            <div class="flex-col hidden gap-4 mb-3 text-center head-content lg:flex">
                <h2 class="text-4xl font-semibold text-primary">Menu favorit pilihan pelanggan</h2>
                <p class="text-sm lg:text-base">Berdasarkan banyaknya pemesanan yang dilakukan oleh pelanggan kami.</p>
            </div>
            <div
                class="flex overflow-x-auto snap-x pb-6 gap-4 pt-6 card-wrapper group md:grid md:grid-cols-3 lg:grid-cols-4 text-primary hover:text-secondary scrollbar-hide">
                @foreach ($bestSellingMenus as $item)
                    <figure
                        class="min-w-[17rem] snap-center relative flex-1 p-3 duration-150 border border-transparent card hover:text-primary rounded-2xl hover:border-slate-300 md:min-w-0">
                        <div class="overflow-hidden img-container aspect-4/3 rounded-2xl">
                            <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}"
                                class="object-cover w-full h-full duration-200 brightness-100">
                            {{-- <div
                                class="absolute flex items-center content-center gap-1 px-3 py-1 text-sm font-medium bg-white rounded-full rating-menu top-6 left-5">
                                <iconify-icon icon="ri:star-fill"
                                    class="text-sm -translate-y-[1px] text-yellow-400"></iconify-icon>
                                {{ $item['rating'] }}
                            </div> --}}
                        </div>
                        <figcaption class="flex flex-col gap-1 mt-4 card-content">
                            <div class="label-wrapper flex items-center gap-2 mb-1">
                                <p
                                    class="time-created font-medium text-[11px] text-slate-500 flex items-center justify-start gap-1 bg-slate-100 w-max px-2.5 py-1 rounded-full">
                                    <iconify-icon icon="lucide:calendar" class="text-xs"></iconify-icon>
                                    {{ $item->formatted_date }}
                                </p>
                                <span
                                    class="bg-amber-100/80 text-amber-600 text-[11px] font-bold px-2.5 py-1 rounded-full border border-amber-200/50">Terlaris</span>
                            </div>
                            <div class="relative flex items-start justify-between w-full gap-3 text-wrapper">
                                <div class="flex flex-col gap-1 text-primary">
                                    <h3 class="font-bold text-base menu-name line-clamp-1">{{ $item->nama_menu }}</h3>
                                    <p class="menu-price font-black text-xl text-primary-700">
                                        <span
                                            class="text-sm font-bold mr-0.5">Rp</span>{{ number_format($item->harga, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            @auth
                                <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}" class="w-full">
                                    <button
                                        class="flex items-center justify-center w-full gap-2 py-3.5 mt-4 text-xs font-bold text-white duration-150 rounded-xl btn-order bg-emerald-500 hover:bg-emerald-600 shadow-lg shadow-emerald-500/20 active:scale-[0.98] lg:text-sm">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
                                        Pesan Sekarang
                                    </button>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="w-full">
                                    <button
                                        class="flex items-center justify-center w-full gap-2 py-3.5 mt-4 text-xs font-bold text-white duration-150 rounded-xl btn-order bg-slate-300 cursor-not-allowed lg:text-sm">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
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
        <div class="w-full px-4 lg:px-6 py-6 mt-6 bg-white menu-wrapper lg:mt-16 rounded-xl">
            <h2
                class="lg:hidden text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full">
                Semua <span class="font-bold">Menu (7)</span></h2>
            <div class="flex-col hidden gap-4 mb-3 text-center head-content lg:flex">
                <h2 class="text-4xl font-semibold text-primary">Coba juga menu ini!</h2>
                <p class="text-sm lg:text-base">Jelajahi berbagai menu lainnya, termasuk yang paling sering dipesan.</p>
            </div>
            <div
                class="flex overflow-x-auto snap-x pb-6 gap-4 pt-6 card-wrapper group md:grid md:grid-cols-3 lg:grid-cols-4 text-primary hover:text-secondary scrollbar-hide">
                @foreach ($menu as $item)
                    <figure
                        class="min-w-[17rem] snap-center relative flex-1 p-3 pb-4 duration-150 border border-transparent card hover:text-primary rounded-2xl hover:border-slate-300 md:min-w-0">
                        <div class="overflow-hidden img-container aspect-4/3 rounded-2xl">
                            <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}"
                                class="object-cover w-full h-full duration-200 brightness-100">
                            {{-- <div
                                class="absolute flex items-center content-center gap-1 px-3 py-1 text-sm font-medium bg-white rounded-full rating-menu top-6 left-5">
                                <iconify-icon icon="ri:star-fill"
                                    class="text-sm -translate-y-[1px] text-yellow-400"></iconify-icon>
                                {{ $item['rating'] }}
                            </div> --}}
                        </div>
                        <figcaption class="flex flex-col gap-1 mt-4 card-content">
                            <div class="label-wrapper flex items-center gap-2 mb-1">
                                <p
                                    class="time-created font-medium text-[11px] text-slate-500 flex items-center justify-start gap-1 bg-slate-100 w-max px-2.5 py-1 rounded-full">
                                    <iconify-icon icon="lucide:calendar" class="text-xs"></iconify-icon>
                                    {{ $item->formatted_date }}
                                </p>
                            </div>
                            <h3 class="font-bold text-base menu-name line-clamp-1">{{ $item->nama_menu }}</h3>
                            <p class="menu-price font-black text-xl text-primary-700">
                                <span class="text-sm font-bold mr-0.5">Rp</span>{{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                            @auth
                                <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}" class="w-full">
                                    <button
                                        class="flex items-center justify-center w-full gap-2 py-3.5 mt-4 text-xs font-bold text-white duration-150 rounded-xl btn-order bg-emerald-500 hover:bg-emerald-600 shadow-lg shadow-emerald-500/20 active:scale-[0.98] lg:text-sm">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
                                        Pesan Sekarang
                                    </button>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="w-full">
                                    <button
                                        class="flex items-center justify-center w-full gap-2 py-3.5 mt-4 text-xs font-bold text-white duration-150 rounded-xl btn-order bg-slate-300 cursor-not-allowed lg:text-sm">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
                                        Pesan Sekarang
                                    </button>
                                </a>
                            @endauth
                        </figcaption>
                    </figure>
                @endforeach
            </div>
            <a href="{{ route('menu') }}" class="block place-self-end">
                <button id="btn-lihat-semua"
                    class="w-full p-4 mt-5 text-xs duration-150 rounded-md bg-tertiary text-primary hover:bg-slate-200/70 active:bg-slate-300/70 lg:text-sm lg:font-medium lg:w-max lg:px-10 lg:place-self-start lg:mt-10">Lihat
                    Semua Menu</button>
            </a>
        </div>
    </section>

    <section id="order-guide-section" class="container px-4">
        <div class="flex flex-col gap-4 p-4 lg:p-6 mt-6 bg-white order-guide-wrapper lg:mt-32 rounded-xl">
            <header
                class="relative flex flex-col-reverse items-center justify-center pt-6 lg:pt-0 lg:justify-start lg:flex-row lg:h-56 overflow-hidden header-order-guide bg-tertiary rounded-xl lg:rounded-3xl">
                {{-- pattern svg --}}
                <img src="../../images/pattern-for-header-order-guide.svg" alt="pattern svg"
                    class="absolute object-cover w-full h-full top-1/2 left-1/2 -translate-x-1/4 -translate-y-1/4 opacity-5">

                {{-- Image --}}
                <img src="../../images/people-confused.svg" alt="people confused img"
                    class="w-48 translate-y-4 lg:-translate-x-5 lg:translate-y-5 lg:w-80 aspect-square lg:ms-16 z-10">

                {{-- Text --}}
                <div
                    class="flex flex-col items-center lg:items-start justify-center gap-2 text-group z-10 lg:-ms-6 text-primary text-center lg:text-left px-4">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl">Gimana cara saya <span
                            class="font-semibold lg:font-bold">order</span> menu?</h2>
                    <p class="text-sm italic lg:text-lg lg:mt-2">- Sini biar mimin kasi tau caranya</p>
                </div>
            </header>
            <div
                class="flex gap-2 overflow-x-auto pb-4 font-semibold duration-200 cursor-default order-guide-content group text-secondary/40 hover:text-secondary snap-x scrollbar-hide">
                <div class="order-number relative shrink-0 snap-center size-20 lg:size-28 lg:flex-1 grid place-content-end text-primary bg-tertiary-100 text-4xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-[2px] hover:shadow-lg hover:shadow-slate-700/10 duration-150 active:translate-y-[1px] cursor-pointer"
                    data-index="1">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        01
                    </span>
                </div>
                <div class="order-number relative shrink-0 snap-center size-20 lg:size-28 lg:flex-1 grid place-content-end bg-tertiary-100 text-4xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-[2px] hover:shadow-lg hover:shadow-slate-700/10 duration-150 active:translate-y-[1px] cursor-pointer"
                    data-index="2">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        02
                    </span>
                </div>
                <div class="order-number relative shrink-0 snap-center size-20 lg:size-28 lg:flex-1 grid place-content-end bg-tertiary-100 text-4xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-[2px] hover:shadow-lg hover:shadow-slate-700/10 duration-150 active:translate-y-[1px] cursor-pointer"
                    data-index="3">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        03
                    </span>
                </div>
                <div class="order-number relative shrink-0 snap-center size-20 lg:size-28 lg:flex-1 grid place-content-end bg-tertiary-100 text-4xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-[2px] hover:shadow-lg hover:shadow-slate-700/10 duration-150 active:translate-y-[1px] cursor-pointer"
                    data-index="4">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        04
                    </span>
                </div>
                <div class="order-number relative shrink-0 snap-center size-20 lg:size-28 lg:flex-1 grid place-content-end bg-tertiary-100 text-4xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-[2px] hover:shadow-lg hover:shadow-slate-700/10 duration-150 active:translate-y-[1px] cursor-pointer"
                    data-index="5">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        05
                    </span>
                </div>
                <div class="order-number relative shrink-0 snap-center size-20 lg:size-28 lg:flex-1 grid place-content-end bg-tertiary-100 text-4xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-[2px] hover:shadow-lg hover:shadow-slate-700/10 duration-150 active:translate-y-[1px] cursor-pointer"
                    data-index="6">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        06
                    </span>
                </div>
                <div class="order-number relative shrink-0 snap-center size-20 lg:size-28 lg:flex-1 grid place-content-end bg-tertiary-100 text-4xl lg:text-8xl rounded-md lg:rounded-2xl overflow-hidden hover:text-primary hover:-translate-y-[2px] hover:shadow-lg hover:shadow-slate-700/10 duration-150 active:translate-y-[1px] cursor-pointer"
                    data-index="7">
                    <span class="absolute -bottom-3 -right-2 lg:-bottom-6 lg:-right-4">
                        07
                    </span>
                </div>
            </div>

            <div class="w-full p-6 main-content-order-guide bg-tertiary text-primary rounded-xl lg:rounded-3xl">
                <div class="p-2 content rounded-xl lg:flex lg:items-center lg:justify-between">
                    {{-- isi konten sesuai langkah yang diklik --}}
                    <div>
                        <h3 class="text-6xl font-semibold head-order-guide lg:text-8xl lg:mb-2">01</h3>
                        <p class="mt-2 detail-order-guide lg:text-xl">Registrasi / Login ke Akun Anda terlebih dahulu.</p>
                    </div>
                    <img src="../../images/sign-up.svg" alt="two people discuss svg" class="order-guide-img max-w-[25rem]">
                    {{-- <p class="text-xs text-right brand-name text-tertiary">@kateringibu2024</p> --}}
                </div>
            </div>
        </div>
    </section>

    {{-- rating user section --}}
    <section id="rating-users-section" class="container px-4 lg:mt-52">
        <div class="w-full p-4 lg:p-6 mt-6 overflow-hidden bg-white rating-wrapper rounded-xl">
            <h2
                class="lg:hidden text-md text-primary ps-4 mt-2 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full">
                Beberapa ulasan dari <span class="font-bold">pelanggan setia</span> kami</h2>
            <div class="flex-col hidden gap-4 mb-16 text-center head-content lg:flex">
                <h2 class="text-4xl font-semibold text-primary">Apa kata mereka?</h2>
                <p class="text-secondary">Kepuasan pelanggan adalah prioritas kami. Berikut beberapa testimoni dari mereka.
                </p>
            </div>
            @if ($ulasan->isEmpty())
                <div class="flex items-center justify-start gap-2 px-6 py-5 text-sm bg-yellow-200 rounded-sm text-primary">
                    <iconify-icon icon="mingcute:warning-line" class="text-2xl"></iconify-icon>
                    <span>Tidak ada ulasan pelanggan yang tersedia.</span>
                </div>
            @else
                <div class="flex flex-col gap-4 mt-8 cursor-default card-wrapper lg:grid lg:grid-cols-2">
                    @foreach ($ulasan as $item)
                        <div
                            class="flex flex-row gap-4 p-4 duration-300 card rating-card group text-primary bg-tertiary rounded-xl hover:bg-primary hover:text-white hover:shadow-lg hover:shadow-slate-400">
                            <img src="{{ $item->user->foto_profile ? asset('storage/' . $item->user->foto_profile) : asset('images/default-pfp-cust-single.png') }}"
                                alt="profile user image"
                                class="profile-user rounded-full border-2 border-secondary/50 w-16 lg:w-[5rem] h-max aspect-square object-cover">
                            <div class="flex flex-col gap-2 text-wrapper">
                                <h4 class="font-semibold username">{{ $item->user->name }}</h4>
                                {{-- <p class="text-xs email-user lg:text-sm text-secondary/50">{{
                                    str_replace(substr($item->user->email, 1, 8), '******', $item->user->email) }}</p> --}}
                                <p
                                    class="text-xs leading-5 message-rating lg:text-sm lg:leading-6 text-primary/80 line-clamp-3 group-hover:text-white/80">
                                    {{ $item->pesan }}
                                </p>
                                <p class="mt-3 text-xs text-right rating-created-at text-secondary/50 group-hover:text-white/70">
                                    {{ $item->formatted_date }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@endsection