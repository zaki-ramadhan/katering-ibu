{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

{{-- ? ini conthoh kode dr gpt, belum make database ini --}}
@php
$menus = collect([
    [
        'name' => 'Baso Ikan',
        'price' => 20000,
        'img' => asset('images/baso ikan.jpg'),
        'details' => 'Baso ikan segar dengan kuah kaldu istimewa.',
        'rating' => 4,
    ],
    [
        'name' => 'Nasi Ayam',
        'price' => 12000,
        'img' => asset('images/nasi ayam.jpg'),
        'details' => 'Nasi ayam dengan toping ayam kecap yang gurih.',
        'rating' => 5,
    ],
    [
        'name' => 'Nasi Bakar',
        'price' => 15000,
        'img' => asset('images/nasi bakar.jpg'),
        'details' => 'Nasi bakar dengan toping ayam kecap yang gurih.',
        'rating' => 4,
    ],
    [
        'name' => 'Nasi Kuning',
        'price' => 8000,
        'img' => asset('images/nasi kuning.jpg'),
        'details' => 'Nasi kuning dengan toping ayam kecap yang gurih.',
        'rating' => 5,
    ],
    [
        'name' => 'Nasi Liwet',
        'price' => 17000,
        'img' => asset('images/nasi liwet.jpg'),
        'details' => 'Nasi liwet dengan toping ayam kecap yang gurih.',
        'rating' => 3,
    ],
    [
        'name' => 'Paket Nasi Kuning Tampahan',
        'price' => 45000,
        'img' => asset('images/paket nasi kuning tampahan.jpeg'),
        'details' => 'Paket Nasi kuning tampahan dengan toping ayam kecap yang gurih.',
        'rating' => 4,
    ],
    [
        'name' => 'Paket Nasi Liwet Tampahan',
        'price' => 55000,
        'img' => asset('images/paket nasi liwet tampahan.jpeg'),
        'details' => 'Paket Nasi Liwet Tampahan dengan toping ayam kecap yang gurih.',
        'rating' => 4,
    ],
]);


// menggunakan collect dan take untuk mengambil jumlah data yang diinginkan, tidak semua
$topMenus = $menus->take(4);

@endphp

{{-- ! alternatif soalnya tailwindnya ga jalan --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Menu Katering Ibu</title>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/menu.js', 'resources/js/components/modal-logout.js', 'resources/js/components/header.js'])

        <!-- Load JavaScript libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
        

        <style>
            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
                appearance: none;
            }
        </style>

    </head>
    <body class="font-inter bg-red-500 sm:bg-tertiary md:bg-primary-600">

        <x-header></x-header>
        <x-modal-logout></x-modal-logout>

        <main class="main-content-wrapper container">

            {{-- hero-section --}}
            <section id="hero-section" class="container px-4 relative text-white">
                <div class="img-overlay-group container w-full h-[20rem] overflow-hidden relative rounded-xl">
                    <img src="https://images.unsplash.com/photo-1498579809087-ef1e558fd1da?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzR8fGNhdGVyaW5nJTIwZm9vZHxlbnwwfHwwfHx8MA%3D%3D" alt="hero image">
                    <div class="overlay w-full h-full bg-gradient-to-t from-black/50 to-black/50 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    </div>
                </div>
                <div class="text-input-group absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center gap-6">
                    <h1 class="w-[90vw] text-4xl text-center leading-tight font-semibold">Siap menemukan hidangan <span class="italic">favoritmu?</span> temukan disini!</h1>
                    <div class="input-wrapper w-max relative flex items-center justify-center">
                        <form action="">
                            <label for="search-menu" class="text-lg absolute top-1/2 left-4 -translate-y-1/2 text-secondary hover:text-primary">
                                <iconify-icon icon="akar-icons:search" id="search-label" class="translate-y-[3px]"></iconify-icon>
                            </label>
                            <input type="search" name="search-menu" id="search-menu" placeholder="Cari menu favoritmu disini..." autocomplete="off" required class="w-72 truncate rounded-md text-sm py-3 ps-12 pe-9 text-primary focus:outline-none focus:ring-0 border-0 focus:border-transparent">
                            <iconify-icon icon="ic:outline-clear" id="clear-btn" class="hidden absolute top-1/2 right-32 -translate-y-1/2 text-secondary hover:text-primary cursor-pointer"></iconify-icon>
                            <button type="submit" class="bg-primary hover:bg-primaryHovered active:bg-primary duration-150 px-6 py-[.9rem] text-xs rounded-md">Cari Menu</button>
                        </form>
                    </div>
                </div>
            </section>

            {{-- top-menu-section --}}
            <section id="top-menu-section" class="container px-4">
                <div class="top-menu-wrapper w-full p-6 bg-white mt-6 rounded-xl">
                    <h2 class=" text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Menu <span class="font-bold">terlaris</span> saat ini</h2>
                    <div class="content-container group flex flex-wrap gap-4 pt-6 text-primary ">
                        @foreach ( $topMenus as $menu)                            
                            <figure class="card relative flex-1 min-w-52 max-w-[16.7rem] hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-lg hover:border-slate-300 hover:shadow-lg hover:shadow-slate-200/70">
                                <div class="img-container aspect-square rounded-lg overflow-hidden">
                                    <img src="{{ $menu['img'] }}" alt="{{ $menu['name'] }}" class="w-full h-full object-cover brightness-100 duration-200">
                                </div>
                                <figcaption class="card-content mt-4 flex flex-col gap-1 text-primary">
                                    <p class="time-created font-normal text-[.6rem] text-secondary flex items-center justify-start gap-1 bg-tertiary w-max p-2 rounded-full">
                                        <iconify-icon icon="zondicons:time"></iconify-icon>
                                        November, 10 2024.
                                    </p>
                                    <h3 class="menu-name font-medium text-lg">{{ $menu['name'] }}</h3>
                                    <h4 class="title-desc-menu text-xs font-normal mt-1 text-primary/70">Deskripsi Menu :</h4>
                                    <p class="description-menu text-xs font-light text-justify text-secondary/80 leading-4 line-clamp-4">
                                        {{ $menu['details'] }}
                                    </p>
                                    <hr class="border my-2">
                                    <footer class="card-footer flex justify-between">
                                        <p class="before:content-['Rp.'] after:content-['/porsi'] font-medium text-sm">{{ $menu['price'] }}  </p>
                                        <div class="rating-menu flex gap-1 text-md text-yellow-400">
                                            @for ($i = 0; $i < $menu['rating']; $i++)
                                                <iconify-icon icon="ri:star-fill"></iconify-icon>
                                            @endfor
                                        </div>
                                    </footer>
                                    <div class="button-wrapper w-full flex gap-1">
                                        <a href="{{ route('order-now') }}" class="grow bg-orderHovered hover:bg-orderClicked active:bg-orderClicked-700 text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
                                            <button class="btn-order ">
                                                <iconify-icon icon="tdesign:shop-filled" class="text-base translate-y-[1px]"></iconify-icon>
                                                Pesan Sekarang
                                            </button>
                                        </a>
                                        <button class="btn-add-to-cart flex-none  w-12 text-orderHovered bg-tertiary-50 hover:bg-emerald-100/50 border border-emerald-300 mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
                                            <iconify-icon icon="f7:cart-fill" class="text-base "></iconify-icon>
                                            <iconify-icon icon="ooui:add" class="text-base  -ms-1"></iconify-icon>
                                        </button>
                                    </div>
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
            </section>
            
            {{-- menu-section --}}
            <section id="menu-section" class="container px-4">
                <div class="menu-wrapper w-full px-6 bg-white mt-6 py-6 rounded-xl">
                    <h2 class=" text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Semua <span class="font-bold">Menu (7)</span></h2>
                    <div class="content-container flex flex-wrap gap-4 pt-6 text-primary ">
                        @foreach ( $menus as $menu)                            
                            <figure class="card relative flex-1 min-w-52 max-w-[16.7rem] hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-lg hover:border-slate-300 hover:shadow-lg hover:shadow-slate-200/70">
                                <div class="img-container aspect-square rounded-lg overflow-hidden">
                                    <img src="{{ $menu['img'] }}" alt="{{ $menu['name'] }}" class="w-full h-full object-cover brightness-100 duration-200">
                                </div>
                                <figcaption class="card-content mt-4 flex flex-col gap-1 text-primary">
                                    <p class="time-created font-normal text-[.6rem] text-secondary flex items-center justify-start gap-1 bg-tertiary w-max p-2 rounded-full">
                                        <iconify-icon icon="zondicons:time"></iconify-icon>
                                        November, 10 2024.
                                    </p>
                                    <h3 class="menu-name font-medium text-lg line-clamp-1">{{ $menu['name'] }}</h3>
                                    <h4 class="title-desc-menu text-xs font-normal mt-1 text-primary/70">Deskripsi Menu :</h4>
                                    <p class="description-menu text-xs font-light text-justify text-secondary/80 leading-4 line-clamp-4">
                                        {{ $menu['details'] }}
                                    </p>
                                    <hr class="border my-2">
                                    <footer class="card-footer flex justify-between">
                                        <p class="before:content-['Rp.'] after:content-['/porsi'] font-medium text-sm"> {{ number_format($menu['price'], 0, ',', '.') }} </p>
                                        <div class="rating-menu flex gap-1 text-md text-yellow-400">
                                            @for ($i = 0; $i < $menu['rating']; $i++)
                                                <iconify-icon icon="ri:star-fill"></iconify-icon>
                                            @endfor
                                        </div>
                                    </footer>
                                    <div class="button-wrapper w-full flex gap-1">
                                        <a href="{{ route('order-now', ['menu' => $menu['name']]) }}" class="grow bg-orderHovered hover:bg-orderClicked active:bg-orderClicked-700 text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
                                            <button class="btn-order">
                                                <iconify-icon icon="tdesign:shop-filled" class="text-base translate-y-[1px]"></iconify-icon>
                                                Pesan Sekarang
                                            </button>
                                        </a>                                        
                                        <button class="btn-add-to-cart flex-none  w-12 text-orderHovered bg-tertiary-50 hover:bg-emerald-100/50 border border-emerald-300 mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
                                            <iconify-icon icon="f7:cart-fill" class="text-base "></iconify-icon>
                                            <iconify-icon icon="ooui:add" class="text-base  -ms-1"></iconify-icon>
                                        </button>
                                    </div>
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
            </section>

        </main>
        <button class="btn-scroll-top group fixed right-5 bottom-5 w-12 h-auto aspect-square rounded-full bg-primary text-white text-2xl border border-tertiary grid place-content-center hover:shadow-lg hover:-translate-y-[3px] hover:bg-primary-600 active:bg-primary duration-150">
            <iconify-icon icon="mdi:arrow-top" class="group-active:-translate-y-2 duration-200"></iconify-icon>
        </button>
        
        <x-footer></x-footer>
    </body>
</html>