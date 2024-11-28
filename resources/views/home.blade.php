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
        <title>Katering Ibu - Layanan Katering Rumahan</title>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/home.js', 'resources/js/components/modal-logout.js', 'resources/js/components/header.js'])

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

        <main class="container">

            {{-- hero-section --}}
            <section id="hero-section" class="container px-4 relative text-white">
                <div class="img-overlay-group container w-full h-[24rem] overflow-hidden relative rounded-xl">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGV2ZW50JTIwZm9vZHxlbnwwfHwwfHx8MA%3D%3D" alt="hero image">
                    <div class="overlay w-full h-full bg-gradient-to-t from-black/50 to-black/40 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    </div>
                </div>
                <div class="text-button-group absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center content-center gap-4 text-center">
                    <h1 class="text-5xl font-semibold w-max">Buat hidangan acaramu<br>jadi lebih berkualitas.</h1>
                    <p class="text-sm">dengan Katering Ibu - Solusi Kebutuhan Katering Anda.</p>
                    @auth
                        <a href="{{ route('menu') }}">
                            <button id="btn-order-now" class="group ps-2 pe-4 py-2 rounded-full bg-primary hover:bg-gradient-to-r hover:from-primaryHovered hover:to-primary hover:scale-[1.01] duration-200 text-xs text-white/60 hover:text-white active:bg-primary flex items-center content-center gap-2 mt-3">
                                <iconify-icon icon="akar-icons:shopping-bag" class="text-lg p-2 bg-primary-600 rounded-full group-hover:bg-primary duration-200"></iconify-icon>
                                Ayo mulai memesan
                                <iconify-icon icon="fluent:arrow-right-20-filled" class="text-lg group-hover:ms-6 duration-200"></iconify-icon>
                            </button>
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <button id="btn-order-now" class="group ps-2 pe-4 py-2 rounded-full bg-primary hover:bg-gradient-to-r hover:from-primaryHovered hover:to-primary duration-200 text-xs text-secondary hover:text-white active:bg-primary flex items-center content-center gap-2 mt-3">
                                <iconify-icon icon="akar-icons:shopping-bag" class="text-lg p-2 bg-primary-600 rounded-full group-hover:bg-primary duration-200"></iconify-icon>
                                Ayo mulai memesan
                                <iconify-icon icon="fluent:arrow-right-20-filled" class="text-lg group-hover:ms-6 duration-200"></iconify-icon>
                            </button>
                        </a>
                    @endauth
                </div>
            </section>
        
            {{-- features section --}}
            <section id="features-section" class="container px-4 mt-6">
                <div class="features-wrapper container bg-white px-6 pt-6 rounded-xl cursor-default">
                    <h2 class=" text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Kenapa harus <span class="font-bold">Katering Ibu?</span></h2>
                    <div class="content-wrapper text-center text-sm text-primary hover:text-secondary flex gap-4 py-10">
                        <div class="feature-item flex flex-col items-center content-center gap-2 flex-1 hover:text-primary hover:-translate-y-1 duration-150 active:translate-y-[1px]">
                            <iconify-icon icon="mdi:food-outline" class="text-5xl"></iconify-icon>
                            <h2 class="line-clamp-2 overflow-hidden">Menu dengan kualitas pelayanan terbaik</h2>
                        </div>
                        <div class="feature-item flex flex-col items-center content-center gap-2 flex-1 hover:text-primary hover:-translate-y-1 duration-150 active:translate-y-[1px]">
                            <iconify-icon icon="medical-icon:i-social-services" class="text-5xl"></iconify-icon>
                            <h2 class="line-clamp-2 overflow-hidden">Layanan profesional dengan penuh kepercayaan</h2>
                        </div>
                        <div class="feature-item flex flex-col items-center content-center gap-2 flex-1 hover:text-primary hover:-translate-y-1 duration-150 active:translate-y-[1px]">
                            <iconify-icon icon="ri:service-fill" class="text-5xl"></iconify-icon>
                            <h2 class="line-clamp-2 overflow-hidden">Dipercaya oleh lebih dari 100+ pelanggan setia</h2>
                        </div>
                        <div class="feature-item flex flex-col items-center content-center gap-2 flex-1 hover:text-primary hover:-translate-y-1 duration-150 active:translate-y-[1px]">
                            <iconify-icon icon="healthicons:money-bag" class="text-5xl"></iconify-icon>
                            <h2 class="line-clamp-2 overflow-hidden">Harga kompetitif dengan cita rasa istimewa</h2>
                        </div>
                    </div>
                </div>
            </section>

            {{-- top-menu-section --}}
            <section id="top-menu-section" class="container px-4">
                <div class="top-menu-wrapper w-full p-6 bg-white mt-6 rounded-xl">
                    <h2 class=" text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Menu <span class="font-bold">terlaris</span> saat ini</h2>
                    <div class="content-container group flex flex-wrap gap-4 pt-6 text-primary hover:text-secondary ">
                        @foreach ( $topMenus as $menu)
                        <figure class="card relative flex-1 min-w-52 max-w-[16.7rem] hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-lg hover:border-slate-300 hover:shadow-lg hover:shadow-slate-200/70">
                            <div class="img-container aspect-square rounded-lg overflow-hidden">
                                <img src="{{ $menu['img'] }}" alt="{{ $menu['img'] }}" class="w-full h-full object-cover brightness-100 duration-200">
                                <div class="rating-menu absolute top-6 left-5 bg-white px-3 py-1 rounded-full flex items-center content-center gap-1 font-medium text-sm">
                                    <iconify-icon icon="ri:star-fill" class="text-sm -translate-y-[1px] text-yellow-400"></iconify-icon>
                                    {{ $menu['rating'] }}
                                </div>
                            </div>
                            <figcaption class="card-content mt-4 flex flex-col gap-1">
                                <h3 class="menu-name font-normal text-md">{{ $menu['name'] }}</h3>
                                <p class="menu-price font-bold text-lg before:content-['Rp']"> {{ number_format($menu['price'], 0, ',', '.') }} </p>
                                
                                @auth    
                                <a href="{{ route('order-now') }}" class="w-full">
                                    <button class="btn-order w-full bg-orderDeactive hover:bg-orderHovered active:bg-orderClicked text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-base -translate-y-[1px]"></iconify-icon>
                                        Pesan Sekarang
                                    </button>
                                </a>
                                @else
                                <a href="{{ route('login') }}" class="w-full">
                                    <button class="btn-order w-full bg-tertiary hover:bg-secondary active:bg-tertairy text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150 cursor-default">
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
                <div class="menu-wrapper w-full px-6 bg-white mt-6 py-6 rounded-xl">
                    <h2 class=" text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Semua <span class="font-bold">Menu (7)</span></h2>
                    <div class="content-container group flex flex-wrap gap-4 pt-6 text-primary hover:text-secondary ">
                        @foreach ( $topMenus as $menu)
                        <figure class="card relative flex-1 min-w-52 max-w-[16.7rem] hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-lg hover:border-slate-300 hover:shadow-lg hover:shadow-slate-200/70">
                            <div class="img-container aspect-square rounded-lg overflow-hidden">
                                <img src="{{ $menu['img'] }}" alt="{{ $menu['img'] }}" class="w-full h-full object-cover brightness-100 duration-200">
                                <div class="rating-menu absolute top-6 left-5 bg-white px-3 py-1 rounded-full flex items-center content-center gap-1 font-medium text-sm">
                                    <iconify-icon icon="ri:star-fill" class="text-sm -translate-y-[1px] text-yellow-400"></iconify-icon>
                                    {{ $menu['rating'] }}
                                </div>
                            </div>
                            <figcaption class="card-content mt-4 flex flex-col gap-1">
                                <h3 class="menu-name font-normal text-md">{{ $menu['name'] }}</h3>
                                <p class="menu-price font-bold text-lg before:content-['Rp']"> {{ number_format($menu['price'], 0, ',', '.') }} </p>
                                <a href="{{ route('order-now') }}" class="w-full">
                                    <button class="btn-order w-full bg-orderDeactive hover:bg-orderHovered active:bg-orderClicked text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-base -translate-y-[1px]"></iconify-icon>
                                        Pesan Sekarang
                                    </button>
                                </a>
                            </figcaption>
                        </figure>
                        @endforeach
                    </div>
                    <a href="{{ route('menu') }}">
                        <button id="btn-lihat-semua" class="w-full bg-tertiary text-primary hover:bg-slate-200/70 active:bg-slate-300/70 duration-150 p-4 mt-5 rounded-md text-xs">Lihat Semua Menu</button>
                    </a>
                </div>
            </section>

            <section id="order-guide-section" class="container px-4">
                <div class="order-guide-wrapper p-6 mt-6 bg-white rounded-xl flex flex-col gap-4">
                    <header class="header-order-guide relative flex items-center justify-start bg-tertiary rounded-xl overflow-hidden">
                        {{-- pattern svg --}}
                        <img src="../../images/pattern-for-header-order-guide.svg" alt="pattern svg"  class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full object-cover opacity-5">
                        <img src="../../images/people-confused.svg" alt="people confused img" class="w-64 aspect-square translate-y-5 -translate-x-5">
                        <div class="text-group flex flex-col justify-center items-start gap-3 -ms-6 text-primary">
                            <h2 class="text-3xl ">Bagaimana cara saya <span class="font-semibold">memesan</span> menu?</h2>
                            <p class="text-sm italic">- Sini biar mimin kasi tau caranya</p>
                        </div>
                    </header>
                    <div class="order-guide-content group flex gap-2 text-secondary/40 font-semibold hover:text-secondary duration-200 cursor-default">
                        <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end text-primary bg-tertiary-100 text-5xl rounded-md overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="1">
                            <span class="absolute -bottom-3 -right-2">
                                01
                            </span>
                        </div>
                        <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl rounded-md overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="2">
                            <span class="absolute -bottom-3 -right-2">
                                02
                            </span>
                        </div>
                        <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl rounded-md overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="3">
                            <span class="absolute -bottom-3 -right-2">
                                03
                            </span>
                        </div>
                        <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl rounded-md overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="4">
                            <span class="absolute -bottom-3 -right-2">
                                04
                            </span>
                        </div>
                        <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl rounded-md overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="5">
                            <span class="absolute -bottom-3 -right-2">
                                05
                            </span>
                        </div>
                        <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl rounded-md overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="6">
                            <span class="absolute -bottom-3 -right-2">
                                06
                            </span>
                        </div>
                        <div class="order-number relative w-16 h-auto aspect-square flex-1 grid place-content-end bg-tertiary-100 text-5xl rounded-md overflow-hidden hover:text-primary hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-300/60 duration-150 active:translate-y-[1px] cursor-pointer" data-index="7">
                            <span class="absolute -bottom-3 -right-2">
                                07
                            </span>
                        </div>
                    </div>
                    <div class="main-content-order-guide w-full bg-tertiary text-primary rounded-xl p-6">
                        <div class="content p-2 rounded-xl">
                            {{-- isi konten sesuai langkah yang diklik --}}
                            <h3 class="head-order-guide text-6xl font-semibold">01</h3>
                            <p class="detail-order-guide mt-2">Registrasi / Login ke Akun Anda terlebih dahulu.</p>
                            <img src="../../images/sign-up.svg" alt="two people discuss svg" class="order-guide-img">
                            <p class="brand-name text-xs text-right text-tertiary">@kateringibu2024</p>
                        </div>
                    </div>
                </div>
            </section>
        
            {{-- rating user section --}}
            <section id="rating-users-section" class="container px-4">
                <div class="rating-wrapper w-full overflow-hidden p-6 mt-6 rounded-xl bg-white">
                    <h2 class="text-md text-primary ps-4 mt-2 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Beberapa ulasan dari <span class="font-bold">pelanggan setia</span> kami</h2>
                    <div class="card-wrapper flex flex-col gap-4 mt-8 cursor-default">
                        <div class="card rating-card text-primary flex flex-row p-4 gap-4 bg-tertiary rounded-xl hover:bg-primary duration-300 hover:text-white hover:shadow-lg hover:shadow-slate-400">
                            <img src="https://images.unsplash.com/photo-1515202913167-d9a698095ebf?w=1,000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fHByb2ZpbGV8ZW58MHx8MHx8fDA%3D" 
                                alt="profile user image" class="profile-user rounded-full border-2 border-secondary/50 w-16 h-16 aspect-square object-cover">
                            
                            <div class="text-wrapper flex flex-col gap-2">
                                <h4 class="username font-semibold">Sophia Hayes</h4>
                                <p class="email-user text-xs text-secondary/50">s*******s@gmail.com</p>
                                <p class="message-rating text-xs leading-5 text-secondary line-clamp-3">
                                    Pesan di Katering Ibu benar-benar pengalaman yang menyenangkan! Menu makanan bervariasi dan semuanya terasa homemade. 
                                    Saya sempat bingung soal pengiriman, tapi adminnya responsif banget, jawabannya cepat dan ramah. Layanan antar juga tepat waktu. 
                                    Overall puas banget, jadi langganan bulanan deh!
                                </p>
                                <p class="rating-created-at text-xs text-secondary/50 mt-3 text-right">11 Oktober 2024</p>
                            </div>
                        </div>
                        
                        <div class="card rating-card text-primary flex flex-row p-4 gap-4 bg-tertiary rounded-xl hover:bg-primary duration-300 hover:text-white hover:shadow-lg hover:shadow-slate-400">
                            <img src="https://plus.unsplash.com/premium_photo-1675129522693-bd62ffe5e015?w=1,000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D" alt="profile user image" class="profile-user rounded-full border-2 border-secondary/50 w-16 h-max aspect-square object-cover float-start">
                            <div class="text-wrapper flex flex-col gap-2">
                                <h4 class="username font-semibold">Ethan Collins</h4>
                                <p class="email-user text-xs text-secondary/50">e*******s@gmail.com</p>
                                <p class="message-rating text-xs leading-5 text-secondary line-clamp-3">Ini pertama kalinya pesan katering untuk acara keluarga, dan gak nyesel coba Katering Ibu. Makanan sampai dalam keadaan masih hangat, dan porsinya pas buat semua tamu. Hanya saja, ada sedikit keterlambatan di pengiriman, mungkin karena hari itu lagi ramai. Tapi adminnya kasih update terus jadi saya gak terlalu khawatir. Good job!</p>
                                <p class="rating-created-at text-xs text-secondary/50 mt-3 text-right">27 Januari 2024</p>
                            </div>
                        </div>
                        <div class="card rating-card text-primary flex flex-row p-4 gap-4 bg-tertiary rounded-xl hover:bg-primary duration-300 hover:text-white hover:shadow-lg hover:shadow-slate-400">
                            <img src="https://images.unsplash.com/photo-1533636721434-0e2d61030955?w=1,000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHByb2ZpbGV8ZW58MHx8MHx8fDA%3D" alt="profile user image" class="profile-user rounded-full border-2 border-secondary/50 w-16 h-max aspect-square object-cover float-start">
                            <div class="text-wrapper flex flex-col gap-2">
                                <h4 class="username font-semibold">Liam Foster</h4>
                                <p class="email-user text-xs text-secondary/50">l*******r@gmail.com</p>
                                <p class="message-rating text-xs leading-5 text-secondary line-clamp-3">Suka banget sama pilihan menunya, ada banyak makanan khas nusantara yang enak-enak! Favorit saya rendangnya, bumbunya mantap. Adminnya juga super helpful, saya minta custom menu buat acara kantor, dan mereka siap bantu sampai detailnya. Rasa, pelayanan, dan antaran semuanya bagus. Recommended banget buat yang butuh katering praktis!</p>
                                <p class="rating-created-at text-xs text-secondary/50 mt-3 text-right">9 Agustus 2023</p>
                            </div>
                        </div>
                        <div class="card rating-card text-primary flex flex-row p-4 gap-4 bg-tertiary rounded-xl hover:bg-primary duration-300 hover:text-white hover:shadow-lg hover:shadow-slate-400">
                            <img src="https://plus.unsplash.com/premium_photo-1689568126014-06fea9d5d341?w=1,000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D" alt="profile user image" class="profile-user rounded-full border-2 border-secondary/50 w-16 h-max aspect-square object-cover float-start">
                            <div class="text-wrapper flex flex-col gap-2">
                                <h4 class="username font-semibold">Lucas Bennett</h4>
                                <p class="email-user text-xs text-secondary/50">l*******t@gmail.com</p>
                                <p class="message-rating text-xs leading-5 text-secondary line-clamp-3">Udah beberapa kali pesan di Katering Ibu, dan setiap kali selalu puas. Kualitas makanannya konsisten enak dan terjaga. Satu hal yang aku suka adalah selalu dikasih tahu estimasi waktu pengiriman. Pernah sekali ada sedikit keterlambatan karena cuaca, tapi dikabari terus sama admin. Secara keseluruhan pelayanan mereka sangat profesional!</p>
                                <p class="rating-created-at text-xs text-secondary/50 mt-3 text-right">27 Mei 2023</p>
                            </div>
                        </div>
                        <div class="card rating-card text-primary flex flex-row p-4 gap-4 bg-tertiary rounded-xl hover:bg-primary duration-300 hover:text-white hover:shadow-lg hover:shadow-slate-400">
                            <img src="https://images.unsplash.com/photo-1499557354967-2b2d8910bcca?w=1,000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D" alt="profile user image" class="profile-user rounded-full border-2 border-secondary/50 w-16 h-max aspect-square object-cover float-start">
                            <div class="text-wrapper flex flex-col gap-2">
                                <h4 class="username font-semibold">Isabella Monroe</h4>
                                <p class="email-user text-xs text-secondary/50">i*******e@gmail.com</p>
                                <p class="message-rating text-xs leading-5 text-secondary line-clamp-3">Katering Ibu nggak pernah gagal bikin keluarga saya happy. Anak-anak suka banget sama ayam bakarnya, dan saya sendiri suka sama aneka sayurannya, fresh dan rasanya pas. Adminnya cepat tanggap dan sabar banget waktu saya ubah pesanan dadakan. Pengirimannya juga rapi, semua sampai dengan kondisi baik. Terima kasih Katering Ibu, pasti pesan lagi!</p>
                                <p class="rating-created-at text-xs text-secondary/50 mt-3 text-right">14 Maret 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-footer></x-footer>
        
        <button class="btn-scroll-top group fixed right-5 bottom-5 w-12 h-auto aspect-square rounded-full bg-primary text-white text-2xl border border-tertiary grid place-content-center hover:shadow-lg hover:-translate-y-[3px] hover:bg-primary-600 active:bg-primary duration-150">
            <iconify-icon icon="mdi:arrow-top" class="group-active:-translate-y-2 duration-200"></iconify-icon>
        </button>
        
       
        {{-- link js --}}
        {{-- <script type="module">
            $("#menu-btn").click(function(){
                alert("Thanks");
                });
        </script> --}}
    </body>
</html>