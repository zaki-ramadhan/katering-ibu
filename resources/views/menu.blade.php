@extends('layouts.app')

@section('title', 'Menu Katering Ibu') 

@section('vite') 
    @vite('resources/js/menu.js')
@endsection

{{-- Modal tombol keranjang --}}
<div id="cartModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm overflow-y-auto h-full w-full z-50">
    <div id="modalContent" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 mx-auto p-3 border w-full max-w-md shadow-lg rounded-xl bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-xl leading-6 font-medium text-gray-900">Tambahkan ke Keranjang</h3>
            <div class="mt-5 px-4 py-3 pb-0">
                <div class="menu-detail flex items-start mb-6">
                    <img id="menu_foto" src="" alt="Foto Menu" class="w-20 h-20 object-cover rounded-md mr-4">
                    <div class="text-left">
                        <p id="menu_nama" class="font-medium text-lg text-gray-900"></p>
                        <p id="menu_harga" class="text-gray-700"></p>
                    </div>
                </div>
                <form id="cartForm" action="{{ route('keranjang.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="menu_id" name="menu_id" value="">
                    <div class="input-total-wrapper w-full flex items-end justify-between gap-20">
                        <div class="input-wrapper flex flex-col mb-4 w-full group min-h-fit">
                            <label for="jumlah" class="text-sm mb-2 text-left">Jumlah Porsi:</label>
                            <input type="number" id="jumlah" name="jumlah" class="mt-1 p-2 border border-gray-300 rounded-md focus:text-primary" min="1" max="100" maxlength="3" value="1" autocomplete="off" required>
                        </div>                        
                        <div class="total-harga-wrapper mb-4 -translate-y-1">
                            <p id="total_harga" class="text-right font-medium text-sm text-gray-900 w-max"></p>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4 gap-2 text-sm">
                        <button type="button" class="modal-close px-5 py-3 bg-slate-100 hover:bg-slate-200/70 active:bg-slate-100 text-primary border rounded-lg">Batal</button>
                        <button type="submit" class="px-5 py-3 min-w-44 bg-emerald-400 text-white rounded-lg hover:bg-emerald-500 active:bg-emerald-400">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('content')
    {{-- hero-section --}}
    <section id="hero-section" class="container px-4 relative text-white">
        <div class="img-overlay-group container w-full h-[20rem] lg:h-[25rem] overflow-hidden relative rounded-xl lg:rounded-3xl">
            <img src="https://images.unsplash.com/photo-1498579809087-ef1e558fd1da?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzR8fGNhdGVyaW5nJTIwZm9vZHxlbnwwfHwwfHx8MA%3D%3D" alt="hero image" class="w-full">
            <div class="overlay w-full h-full bg-gradient-to-t from-black/50 to-black/50 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            </div>
        </div>
        <div class="text-input-group absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center gap-6 lg:gap-8">
            <h1 class="w-[90vw] lg:w-[50vw] text-4xl lg:text-5xl text-center leading-tight font-semibold">Siap menemukan hidangan <span class="italic">favoritmu?</span> temukan disini!</h1>
            <div class="input-wrapper w-max relative flex items-center justify-center">
                <form action="{{ route('menu.search') }}" method="GET">
                    <label for="search-menu" class="text-lg h-max absolute top-1/2 left-4 -translate-y-[1rem] text-secondary hover:text-primary">
                        <iconify-icon icon="akar-icons:search" id="search-label" class=""></iconify-icon>
                    </label>
                    <input type="search" name="find" id="search-menu" placeholder="Cari menu favoritmu disini..." autocomplete="off" value="{{ request()->input('query') }}"    required class="w-72 lg:w-[30rem] truncate rounded-md text-sm py-3 ps-12 pe-9 text-primary focus:outline-none focus:ring-0 border-0 focus:border-transparent">
                    <iconify-icon icon="ic:outline-clear" id="clear-btn" class="hidden absolute top-1/2 right-32 -translate-y-1/2 text-secondary hover:text-primary cursor-pointer"></iconify-icon>
                    <button type="submit" class="bg-primary hover:bg-primaryHovered active:bg-primary duration-150 px-6 py-[.93rem] text-xs rounded-md">Cari Menu</button>
                </form>
            </div>
        </div>
    </section>

    {{-- top-menu-section --}}
    {{-- <section id="top-menu-section" class="container px-4">
        <div class="top-menu-wrapper w-full p-6 bg-white mt-6 rounded-xl">
            <h2 class=" text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Menu <span class="font-bold">terlaris</span> saat ini</h2>
            <div class="card-wrapper group grid grid-cols-2 gap-4 pt-6 text-primary ">
                @foreach ( $topMenus as $item)                            
                    <figure class="card relative hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-lg hover:border-slate-300 hover:shadow-lg hover:shadow-slate-200/70">
                        <div class="img-container aspect-square rounded-lg overflow-hidden">
                            <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover brightness-100 duration-200">
                        </div>
                        <figcaption class="card-content mt-4 flex flex-col gap-1 text-primary">
                            <p class="time-created font-normal text-[.6rem] text-secondary flex items-center justify-start gap-1 bg-tertiary w-max p-2 rounded-full">
                                <iconify-icon icon="zondicons:time"></iconify-icon>
                                November, 10 2024.
                            </p>
                            <h3 class="menu-name font-medium text-lg">{{ $item['name'] }}</h3>
                            <h4 class="title-desc-menu text-xs font-normal mt-1 text-primary/70">Deskripsi Menu :</h4>
                            <p class="description-menu text-xs font-light text-justify text-secondary/80 leading-4 line-clamp-4">
                                {{ $item['details'] }}
                            </p>
                            <hr class="border my-2">
                            <footer class="card-footer flex justify-between">
                                <p class="before:content-['Rp.'] after:content-['/porsi'] font-medium text-sm">{{ $item['price'] }}  </p>
                                <div class="rating-menu flex gap-1 text-md text-yellow-400">
                                    @for ($i = 0; $i < $item['rating']; $i++)
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
    </section> --}}
    
    {{-- menu-section --}}
    <section id="menu-section" class="container px-4">
        <div class="menu-wrapper w-full px-6 bg-white mt-6 py-6 rounded-xl">
            @if(isset($query) && $query != '' && $menu->isEmpty())
                <div class="not-found-content-wrapper flex flex-col lg:flex-row items-center justify-center gap-4 lg:translate-y-12">
                    <img src="{{ asset('images/empty.svg') }}" alt="img-empty" class="max-w-[30rem]">
                    <div class="text-wrapper text-center lg:text-left flex flex-col gap-3 max-w-[32rem] ">
                        <h2 class="font-bold text-2xl lg:text-4xl text-primary">Ups! menu "{{ $query }}" tidak tersedia.</h2>
                        <p class="w-80 md:w-[90%] md:ms-6 lg:ms-0 lg:w-full leading-7 lg:leading-8 text-sm lg:text-base">Maaf, kami tidak dapat menemukan menu yang cocok dengan pencarian Anda. Silakan coba kata kunci yang berbeda.</p>
                    </div>
                </div>
            @else
                <h2 class="text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full"> Semua <span class="font-bold">Menu ({{ $jumlahMenu }})</span> </h2>
            @endif

        
            <div class="card-wrapper grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-1 gap-y-8 pt-6 text-primary">
                @foreach ($menu as $item)                            
                    <figure class="card relative max-w-72 hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-lg hover:border-slate-300 hover:shadow-lg hover:shadow-slate-200/70">
                        <div class="img-container aspect-square rounded-lg overflow-hidden">
                            <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}" class="w-full h-full object-cover brightness-100 duration-200">
                        </div>
                        <figcaption class="card-content mt-4 flex flex-col gap-1 text-primary">
                            <p class="time-created font-normal text-[.6rem] text-secondary flex items-center justify-start gap-1 bg-tertiary w-max p-2 rounded-full">
                                <iconify-icon icon="zondicons:time"></iconify-icon>
                                {{ $item->formatted_date }}
                            </p>
                            <h3 class="menu-name font-medium text-lg line-clamp-1">{{ $item->nama_menu }}</h3>
                            <h4 class="title-desc-menu text-xs font-medium mt-2 mb-1 text-primary/70">Deskripsi Menu :</h4>
                            <p class="description-menu text-xs text-justify text-secondary/80 leading-5 line-clamp-4">
                                {{ $item->deskripsi }}
                            </p>
                            <hr class="border my-2">
                            <footer class="card-footer flex justify-between">
                                <p class="before:content-['Rp.'] after:content-['/porsi'] font-medium text-sm"> {{ number_format($item->harga, 0, ',', '.') }} </p>
                            </footer>
                            <div class="button-wrapper w-full flex gap-1">
                                @auth
                                    <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}" class="grow bg-orderHovered hover:bg-orderClicked active:bg-orderClicked-700 text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
                                        <button class="btn-order">
                                            <iconify-icon icon="tdesign:shop-filled" class="text-base translate-y-[1px]"></iconify-icon>
                                            Pesan Sekarang
                                        </button>
                                    </a>                                                                                
                                    <button data-menu-id="{{ $item->id }}" data-menu-name="{{ $item->nama_menu }}" data-menu-photo="{{ Storage::url($item->foto_menu) }}" data-menu-price="{{ $item->harga }}" class="btn-add-to-cart flex-none w-12 text-orderHovered bg-tertiary-50 hover:bg-emerald-100/50 border border-emerald-300 mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150">
                                        <iconify-icon icon="f7:cart-fill" class="text-base"></iconify-icon>
                                        <iconify-icon icon="ooui:add" class="text-base -ms-1"></iconify-icon>
                                    </button>
                                @else
                                    <a href="{{ route('login')}}" class="grow bg-secondary-300 text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150 cursor-default">
                                        <button class="btn-order cursor-default">
                                            <iconify-icon icon="tdesign:shop-filled" class="text-base translate-y-[1px]"></iconify-icon>
                                            Pesan Sekarang
                                        </button>
                                    </a>                                                                                
                                @endauth
                            </div>
                        </figcaption>
                    </figure>
                @endforeach


            </div>
        </div>
</section>
@endsection
