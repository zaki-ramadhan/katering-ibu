@extends('layouts.app')

@section('title', 'Pesan ' . $menu->nama_menu . ' di Katering Ibu') 

@section('vite') 
    @vite(['resources/js/order-now.js'])
@endsection

@section('style')
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
@endsection

@section('content')
    <main class="main-content-wrapper container px-4 lg:px-8 lg:-mb-12">
        <header class="sub-header container flex justify-between items-center">
            <div class="breadcrumbs text-sm ps-4">
                <ul>
                    <li class="active:text-primary-600"><a href="{{ route('home') }}">Home</a></li>
                    <li class="active:text-primary-600"><a href="{{ route('menu') }}">Menu</a></li>
                    <li class="text-primary font-semibold">Pesan Sekarang</li>
                </ul>
            </div>
        </header>
        <div class="helper lg:grid lg:grid-cols-3 gap-3">
            <section id="detail-menu-section" class="mt-4 p-4 lg:col-span-2 rounded-xl bg-white text-primary">
                <figure class="w-full flex lg:flex-row gap-6">
                    <div class="img-wrapper w-max">
                        <img src="{{ Storage::url($menu->foto_menu) }}" alt="Foto {{ $menu->nama_menu }}" class="min-w-56 max-h-56 lg:h-64 object-cover rounded-xl mb-3">
                        <span class="description-foto-menu text-xs leading-[.1rem]">Foto {{ $menu->nama_menu }}. Sumber: Katering Ibu.</span>
                    </div>
                    <figcaption class="flex-auto flex flex-col gap-1">
                        <p class="head-figure-menu text-center bg-slate-50 text-primary rounded-md py-3 text-xs md:text-sm mb-3">Detail menu</p>
                        <div class="relative">
                            <h2 class="menu-name text-lg lg:font-medium">{{ $menu->nama_menu }}</h2>
                            <p class="menu-price text-xl font-semibold before:content-['Rp.'] after:content-['/porsi'] after:text-sm after:font-medium after:ms-2 after:tracking-wide">
                                {{ number_format($menu->harga, 0, ',', '.') }}
                            </p>
                            @if(in_array($menu->id, $topMenus))
                                <span class="absolute -top-1 right-2 bg-yellow-100/80 text-yellow-500 text-xs font-medium mt-2 px-4 py-2 rounded-full">Menu Terlaris</span>
                            @endif
                            <div class="description-menu-wrapper flex flex-col gap-1 text-justify text-sm mt-3">
                                <h4 class="title-desc-menu font-medium text-primary/80">Deskripsi Menu :</h4>
                                <p class="menu-description text-secondary font-light leading-6 line-clamp-4 text-sm">{{ $menu->deskripsi }}</p>
                            </div>
                            <hr class="border-[1px] mt-3 mb-2 lg:hidden">
                            <button class="read-more-btn flex lg:hidden items-center justify-center gap-2 text-xs text-primary hover:text-primaryHovered cursor-pointer mt-1">
                                <span class="text-rm-btn">
                                    Lihat Selengkapnya
                                </span>
                                <iconify-icon icon="fe:arrow-down" class="down-arrow-icon text-base duration-500"></iconify-icon>
                            </button>
                        </div>
                        @foreach ($variantMenu as $item)
                        <div class="variantSuggested-wrapper hidden md:flex flex-col gap-2 mt-6">
                            <h2 class="font-medium text-sm text-capitalize">Variant lainnya dari {{ $menu->nama_menu }} :</h2>
                            <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}">
                                <figure class="card-suggestMenu relative flex gap-4 p-2 rounded-xl bg-tertiary-50 border border-slate-200 hover:border-slate-300 md:hover:border-slate-400 hover:shadow-slate-200/40 duration-150">
                                    <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}" class="item max-w-20 aspect-square bg-tertiary rounded-lg">
                                    <figcaption class="py-3 flex flex-col gap-1">
                                        <h3 class="name-suggestMenu text-capitalize text-sm line-clamp-1">{{ $item->nama_menu }}</h3>
                                        <p class="price-suggestMenu font-semibold before:content-['Rp.']"> {{ number_format($item->harga, 0, ',', '.') }}</p>
                                        @if(in_array($item->id, $topMenus))
                                            <span class="absolute top-1/2 right-3 -translate-y-[25%] bg-yellow-100/80 text-yellow-500 text-xs font-medium px-4 py-2 rounded-full">Menu Terlaris</span>
                                        @endif
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        @endforeach
                    
                        <div class="form-priceDetail-wrapper bg-tertiary-50 text-primary mt-8 px-4 py-6 rounded-lg flex flex-col gap-6">
                            <h2 class="text-sm font-medium border-b border-b-slate-400 pb-4 pt-1 text-center">Detail total harga menu:</h2>
                            <div class="helper flex flex-col gap-7 md:flex-row md:justify-between md:items-center">
                                <div class="input-total-wrapper flex flex-col gap-4">
                                    <h2 class="text-sm">Jumlah porsi menu:</h2>
                                    <div class="input-btn-wrapper flex gap-1">
                                        <button type="button" class="decrease-btn w-9 h-auto border aspect-square bg-secondary-300 hover:bg-secondary active:bg-secondary-300 text-white rounded-md duration-150" onclick="updateTotalPrice(-1)">
                                            <iconify-icon icon="raphael:minus" class="translate-y-[1.5px]"></iconify-icon>
                                        </button>
                                        <input type="number" id="jumlah-menu" maxlength="3" min="1" max="999" value="1" autocomplete="off" data-price="{{ $menu->harga }}" class="w-24 text-sm text-primary text-center focus:outline-none focus:ring-0 border border-secondary/60 focus:border-primary rounded-md" oninput="updateTotalPrice(0)">
                                        <button type="button" class="increase-btn w-9 h-auto aspect-square bg-primary-600 hover:bg-primary active:bg-primary-600 hover:border text-white text-xs rounded-md duration-150" onclick="updateTotalPrice(1)">
                                            <iconify-icon icon="subway:add-1"></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                                <div class="price-of-total-wrapper flex flex-col gap-2">
                                    <h2 class="text-sm">Harga total menu:</h2>
                                    <p class="font-semibold text-lg before:content-['Rp.']"><span id="total-price">{{ number_format($menu->harga, 0, ',', '.') }}</span></p>
                                </div>
                            </div>
                            
                            <div class="button-wrapper w-full flex gap-4 -mt-3">
                                <form id="order-now-form" action="{{ route('order.store') }}" method="POST" class="flex-grow">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <input type="hidden" name="jumlah" id="jumlah-order-now" value="1">
                                    <button type="submit" class="btn-order grow bg-orderHovered w-full hover:bg-orderClicked active:bg-orderClicked-700 text-white mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150" onclick="setJumlahOrderNow()">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-base translate-y-[1px]"></iconify-icon>
                                        Pesan Sekarang
                                    </button>
                                </form>
                            
                                <form id="add-to-cart-form" action="{{ route('keranjang.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <input type="hidden" name="jumlah" id="jumlah-add-to-cart" value="1">
                                    <button type="submit" class="btn-add-to-cart flex-none w-12 md:w-24 lg:w-36 text-orderHovered bg-tertiary-50 hover:bg-emerald-100/50 border border-emerald-300 mt-4 py-3 text-xs flex items-center justify-center gap-1 rounded-lg duration-150" onclick="setJumlahAddToCart()">
                                        <iconify-icon icon="f7:cart-fill" class="text-base"></iconify-icon>
                                        <iconify-icon icon="ooui:add" class="text-base -ms-1"></iconify-icon>
                                    </button>
                                </form>
                            </div>                                
                        </div>                        
                    </figcaption>                    
                </figure>
            </section>
            

            <section id="suggestion-menu-section" class="sticky top-2 self-start mt-6 p-4 h-max rounded-xl bg-white lg:border text-primary flex flex-col gap-6">
                <h1 class="md:hidden font-medium ps-4 mt-2 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full">Rekomendasi menu lainnya :</h1>
                <div class="text-wrapper hidden lg:flex flex-col gap-1 -mb-4 py-2">
                    <h1 class="text-xl font-semibold">Mungkin Anda juga menyukainya :</h1>
                    <p class="text-xs text-secondary leading-5">Berikut adalah beberapa saran menu yang bisa Anda pilih</p>
                </div>
                <div class="suggestion-menu-wrapper group w-full grid grid-cols-2 gap-y-4 lg:gap-y-2 gap-x-2 lg:gap-x-1">
                    @foreach ($recommendedMenu as $item)
                        <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}">
                            <figure class="card-suggestMenu p-3 bg-white rounded-lg border border-transparent hover:border-slate-300 md:hover:border-transparent hover:shadow-slate-200/40 duration-150">
                                <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}" class="item aspect-square bg-tertiary rounded-lg">
                                <figcaption class="py-3 flex flex-col gap-1">
                                    <h3 class="name-suggestMenu text-sm line-clamp-1">{{ $item->nama_menu }}</h3>
                                    <p class="price-suggestMenu font-semibold before:content-['Rp.']"> {{ number_format($item->harga, 0, ',', '.') }}</p>
                                </figcaption>
                            </figure>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
@endsection