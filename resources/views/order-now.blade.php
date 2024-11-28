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

{{-- ! alternatif soalnya tailwindnya ga jalan --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pesan Baso Ikan di Katering Ibu</title>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/order-now.js'])

        <!-- Load JavaScript libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
        

        <style>
            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
                appearance: none;
            }
                        /* Hilangkan tanda panah di input number untuk browser Chrome, Safari, Edge, dan Opera */
            input[type=number]::-webkit-outer-spin-button,
            input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Hilangkan tanda panah di input number untuk Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }
        </style>

    </head>
    <body class="font-inter bg-red-500 sm:bg-tertiary md:bg-primary-600">

        {{-- header --}}
        <header class="container px-4 py-5 flex justify-between items-center font-semibold border border-primary/20">
            <a href="{{ route('home') }}" class="logo-group flex items-center gap-3 text-primary">
                <iconify-icon icon="game-icons:knife-fork" class="text-xl"></iconify-icon>
                <span id="mitra-name" class="text-md">Katering Ibu</span>
            </a>

            {{-- mobile screen --}}
            <div class="icon-form-group flex items-end justify-center gap-5">
                <button id="menu-btn">
                    <iconify-icon icon="lucide:menu" class="text-secondary hover:text-primary text-2xl"></iconify-icon>
                </button>
            </div>
            
            <nav class="mobile-nav hidden absolute -top-[100vh] left-0 w-full h-full pt-14 z-20 transition-all duration-700 ease-in-out bg-white overflow-hidden">
                <iconify-icon icon="material-symbols:close" id="hide-menu-btn" class="absolute top-3 right-3 p-3 text-secondary hover:text-primary active:scale-75 active:text-secondary duration-100 text-2xl cursor-pointer"></iconify-icon>
                <ul class="flex flex-col gap-6 text-center font-normal text-sm text-secondary">
                    <li><a class="hover:text-primary duration-100" href=" {{ route('home') }}">Home</a></li>
                    <li><a class="hover:text-primary duration-100" href=" {{ route('about-us') }} ">Tentang Kami</a></li>
                    <li><a class="hover:text-primary duration-100" href=" {{ route('service') }} ">Pelayanan</a></li>
                    <li><a class="hover:text-primary duration-100" href="{{ route('menu') }}">Menu</a></li>
                    <li><a class="hover:text-primary duration-100" href="{{ route('contact-us') }}">Hubungi Kami</a></li>
                </ul>
            </nav>

        </header>

        <main class="main-content-wrapper container px-4 py-6">
            <div class="breadcrumbs text-sm ps-4">
                <ul>
                  <li class="active:text-primary-600"><a href="{{ route('home') }}">Home</a></li>
                  <li class="active:text-primary-600"><a href="{{ route('menu') }}">Menu</a></li>
                  <li class="text-primary">Pesan Sekarang</li>
                </ul>
              </div>
            <section id="detail-menu-section" class="mt-4 p-4 rounded-xl bg-white text-primary">
                <figure class="w-full flex gap-6">
                    <img src="{{ asset('images/baso ikan.jpg') }}" alt="baso ikan img" class="w-56 h-56 object-cover rounded-xl">
                    <figcaption class="flex-auto flex flex-col gap-1">
                        <p class="head-figure-menu text-center bg-primary
                        text-white rounded-md py-3 text-xs mb-3">Detail menu</p>
                        <h2 class="menu-name text-lg">Baso Ikan</h2>
                        <p class="menu-price text-xl font-semibold before:content-['Rp.'] after:content-['/porsi'] after:text-sm after:font-medium after:ms-2 after:tracking-wide"> 16.000</p>
                        <div class="rating-menu flex gap-1 text-lg text-yellow-400 mt-2 after:content-['(4)'] after:text-secondary-300 after:font-medium after:-translate-y-[1px] after:ms-1 after:text-base">
                            <iconify-icon icon="ri:star-fill"></iconify-icon>
                            <iconify-icon icon="ri:star-fill"></iconify-icon>
                            <iconify-icon icon="ri:star-fill"></iconify-icon>
                            <iconify-icon icon="ri:star-fill"></iconify-icon>
                            <iconify-icon icon="ri:star-fill" class="text-secondary-300"></iconify-icon>
                        </div>
                        <div class="description-menu-wrapper flex flex-col gap-1 text-justify text-sm mt-3">
                            <h4 class="title-desc-menu font-medium text-primary/80">Deskripsi Menu :</h4>
                            <p class="menu-description text-secondary font-light leading-6 line-clamp-4 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eos quidem eligendi corrupti praesentium repellat esse est quo sit ab harum, incidunt exercitationem ducimus at suscipit illo. Facilis laboriosam doloremque nam esse! Nesciunt similique unde, quia aspernatur rerum expedita libero doloribus, eligendi ab voluptatem voluptatibus quibusdam est, facilis sed ipsa laudantium dolores. Officiis voluptates tenetur nesciunt totam quisquam, consequuntur aspernatur tempore fugit expedita laboriosam quos eum voluptatibus quidem cumque suscipit!</p>
                        </div>
                        <hr class="border-[1px] mt-3 mb-2">
                        <button class="read-more-btn flex items-center justify-center gap-2 text-xs text-primary hover:text-primaryHovered cursor-pointer mt-1">
                            <span class="text-rm-btn">
                                Lihat Selengkapnya
                            </span>
                            <iconify-icon icon="fe:arrow-down" class="down-arrow-icon text-base duration-500"></iconify-icon>
                        </button>
                        <div class="form-priceDetail-wrapper bg-tertiary-100 text-primary mt-8 px-4 py-4 rounded-lg flex flex-col gap-6">
                            <h2 class="text-sm font-medium border-b border-b-slate-400 pb-4 pt-1 text-center">Detail total harga menu :</h2>
                            <form action="" class="flex flex-col gap-7 mt-2">
                                <div class="input-total-wrapper flex flex-col gap-4">
                                    <h2 class="text-sm">Jumlah porsi menu :</h2>
                                    <div class="input-btn-wrapper flex gap-1">
                                        <button type="button" class="decrease-btn w-9 h-auto border aspect-square bg-secondary-300 hover:bg-secondary active:bg-secondary-300 text-white rounded-md duration-150">
                                            <iconify-icon icon="raphael:minus" class="translate-y-[1.5px]"></iconify-icon>
                                        </button>
                                        <input type="number" name="total-menu" id="total-menu" maxlength="3" min="1" max="999" value=1 class="w-24 text-sm text-primary text-center focus:outline-none focus:ring-0 border border-secondary/60 focus:border-primary rounded-md">
                                        <button type="button" class="increase-btn w-9 h-auto aspect-square bg-primary-600 hover:bg-primary active:bg-primary-600 hover:border text-white text-xs rounded-md duration-150">
                                            <iconify-icon icon="subway:add-1"></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                                <div class="price-of-total-wrapper flex flex-col gap-2">
                                    <h2 class="text-sm">Harga total menu :</h2>
                                    <p class="font-semibold text-lg before:content-['Rp.']"> 16,000</p>
                                </div>
                                <div class="button-wrapper w-full flex gap-1 -mt-3">
                                    <a href="" class="grow bg-orderHovered hover:bg-orderClicked active:bg-orderClicked-700 text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
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
                            </form>
                        </div>
                    </figcaption>
                </figure>
            </section>

            <section id="suggestion-menu-section" class="mt-6 p-4 rounded-xl bg-white text-primary flex flex-col gap-6">
                <h1 class="font-medium ps-4 mt-2 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Rekomendasi menu lainnya :</h1>
                <div class="suggestion-menu-wrapper w-full grid grid-cols-2 gap-y-4 gap-x-2">
                    <a href="">
                        <figure class="card-suggestMenu p-3 bg-white rounded-lg border border-transparent hover:border-slate-300 hover:shadow-xl hover:shadow-slate-200/40 duration-150">
                            <img src="{{ asset('images/nasi ayam.jpg') }}" class="item aspect-square bg-tertiary rounded-lg">
                            <figcaption class="py-3 flex flex-col gap-1">
                                <h3 class="name-suggestMenu text-sm line-clamp-1">Nasi Ayam</h3>
                                <p class="price-suggestMenu font-semibold before:content-['Rp.']"> 11,000</p>
                            </figcaption>
                        </figure>
                    </a>
                    <a href="">
                        <figure class="card-suggestMenu p-3 bg-white rounded-lg border border-transparent hover:border-slate-300 hover:shadow-xl hover:shadow-slate-200/40 duration-150">
                            <img src="{{ asset('images/nasi bakar.jpg') }}" class="item aspect-square bg-tertiary rounded-lg">
                            <figcaption class="py-3 flex flex-col gap-1">
                                <h3 class="name-suggestMenu text-sm line-clamp-1">Nasi Bakar</h3>
                                <p class="price-suggestMenu font-semibold before:content-['Rp.']"> 18,000</p>
                            </figcaption>
                        </figure>
                    </a>
                    <a href="">
                        <figure class="card-suggestMenu p-3 bg-white rounded-lg border border-transparent hover:border-slate-300 hover:shadow-xl hover:shadow-slate-200/40 duration-150">
                            <img src="{{ asset('images/nasi kuning.jpg') }}" class="item aspect-square bg-tertiary rounded-lg">
                            <figcaption class="py-3 flex flex-col gap-1">
                                <h3 class="name-suggestMenu text-sm line-clamp-1">Nasi Kuning</h3>
                                <p class="price-suggestMenu font-semibold before:content-['Rp.']"> 21,000</p>
                            </figcaption>
                        </figure>
                    </a>
                    <a href="">
                        <figure class="card-suggestMenu p-3 bg-white rounded-lg border border-transparent hover:border-slate-300 hover:shadow-xl hover:shadow-slate-200/40 duration-150">
                            <img src="{{ asset('images/paket nasi liwet tampahan.jpeg') }}" class="item aspect-square bg-tertiary rounded-lg">
                            <figcaption class="py-3 flex flex-col gap-1">
                                <h3 class="name-suggestMenu text-sm line-clamp-1">Paket Nasi Liwet Tampahan</h3>
                                <p class="price-suggestMenu font-semibold before:content-['Rp.']"> 16,000</p>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            </section>
        </main>

        <button class="btn-scroll-top group fixed right-5 bottom-5 w-12 h-auto aspect-square rounded-full bg-primary text-white text-2xl border border-tertiary grid place-content-center hover:shadow-lg hover:-translate-y-[3px] hover:bg-primary-600 active:bg-primary duration-150">
            <iconify-icon icon="mdi:arrow-top" class="group-active:-translate-y-2 duration-200"></iconify-icon>
        </button>
        
        <footer class="w-full text-white p-12 bg-primary mt-28 flex flex-col text-center gap-10">
            <div class="navigation-link-wrapper flex flex-col gap-3">
                <h2 class="font-medium">Navigasi</h2>
                <nav>
                    <ul class="text-sm text-secondary flex flex-col gap-3 hover:text-secondary/30">
                        <li><a href="{{ route('home') }}" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Home</a></li>
                        <li><a href=" {{ route('about-us') }} " class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Tentang kami</a></li>
                        <li><a href=" {{ route('service') }} " class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Pelayanan</a></li>
                        <li><a href=" {{ route('menu') }} " class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Menu</a></li>
                        <li><a href=" {{ route('contact-us') }} " class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Hubungi Kami</a></li>
                    </ul>
                </nav>
            </div>
            <div class="menu-link-wrapper flex flex-col gap-3">
                <h2 class="font-medium">Menu - menu</h2>
                <nav>
                    <ul class="text-sm text-secondary flex flex-col gap-3 hover:text-secondary/30">
                        <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Baso Ikan</a></li>
                        <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Nasi Ayam</a></li>
                        <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Nasi Bakar</a></li>
                        <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Nasi Kuning</a></li>
                        <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Nasi Liwet</a></li>
                        <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Paket Nasi Liwet Tampahan</a></li>
                        <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Paket Nasi Kuning Tampahan</a></li>
                    </ul>
                </nav>
                <div class="detail-profile-info-wrapper">

                </div>
            </div>
        </footer>
        
        
        
        
        
        
        {{-- link js --}}
        {{-- <script type="module">
            $("#menu-btn").click(function(){
                alert("Thanks");
                });
        </script> --}}
    </body>
</html>