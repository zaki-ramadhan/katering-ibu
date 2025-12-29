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

        #jumlah-menu {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-appearance: none;
            appearance: none;
        }
    </style>
@endsection

@section('content')
    <main class="main-content-wrapper container px-4 lg:px-8 lg:-mb-12">
        <header class="sub-header container py-4">
            <div class="breadcrumbs text-sm ps-4">
                <ul class="flex items-center gap-2 text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a></li>
                    <li><iconify-icon icon="lucide:chevron-right" class="text-xs"></iconify-icon></li>
                    <li><a href="{{ route('menu') }}" class="hover:text-primary transition-colors">Menu</a></li>
                    <li><iconify-icon icon="lucide:chevron-right" class="text-xs"></iconify-icon></li>
                    <li class="text-primary font-semibold">Pesan Sekarang</li>
                </ul>
            </div>
        </header>
        <div class="helper lg:grid lg:grid-cols-3 gap-3">
            <section id="detail-menu-section" class="mt-4 p-5 lg:p-6 lg:col-span-2 rounded-2xl bg-white shadow-sm border border-slate-100 text-primary">
                <figure class="w-full flex flex-col lg:flex-row gap-8">
                    <div class="img-wrapper shrink-0">
                        <img src="{{ Storage::url($menu->foto_menu) }}" alt="Foto {{ $menu->nama_menu }}"
                            class="min-w-56 max-h-56 lg:h-64 object-cover rounded-xl shadow-md shadow-slate-200">
                        <p class="text-xs text-slate-400 mt-3 text-center font-medium uppercase tracking-wider">Sumber: Katering Ibu</p>
                    </div>
                    <figcaption class="flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <p class="px-3 py-1 bg-slate-50 text-slate-500 rounded-full text-xs font-semibold uppercase tracking-wider border border-slate-100">Detail Menu</p>
                            @if(in_array($menu->id, $topMenus))
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[11px] font-bold rounded-full border border-amber-100">Menu Terlaris</span>
                            @endif
                        </div>
                        <div class="relative">
                            <h2 class="text-2xl font-bold text-slate-800 mb-1">{{ $menu->nama_menu }}</h2>
                            <p class="text-2xl font-bold text-primary">
                                <span class="text-sm font-semibold mr-0.5">Rp</span>{{ number_format($menu->harga, 0, ',', '.') }}<span class="text-xs text-slate-400 font-medium ml-1">/porsi</span>
                            </p>
                            
                            <div class="mt-6">
                                <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">Deskripsi Menu</h4>
                                <p class="text-slate-600 leading-relaxed text-sm font-normal">
                                    {{ $menu->deskripsi }}
                                </p>
                            </div>
                        </div>
                        @foreach ($variantMenu as $item)
                            <div class="variantSuggested-wrapper hidden md:flex flex-col gap-2 mt-6">
                                <h2 class="font-medium text-sm text-capitalize">Variant lainnya dari {{ $menu->nama_menu }} :
                                </h2>
                                <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}">
                                    <figure
                                        class="card-suggestMenu relative flex gap-4 p-2 rounded-xl bg-tertiary-50 border border-slate-200 hover:border-slate-300 md:hover:border-slate-400 hover:shadow-slate-200/40 duration-150">
                                        <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}"
                                            class="item max-w-20 aspect-square bg-tertiary rounded-lg">
                                        <figcaption class="py-3 flex flex-col gap-1">
                                            <h3 class="name-suggestMenu text-capitalize text-sm line-clamp-1">
                                                {{ $item->nama_menu }}</h3>
                                            <p class="price-suggestMenu font-semibold before:content-['Rp.']">
                                                {{ number_format($item->harga, 0, ',', '.') }}</p>
                                            @if(in_array($item->id, $topMenus))
                                                <span
                                                    class="absolute top-1/2 right-3 -translate-y-[25%] bg-yellow-100/80 text-yellow-500 text-xs font-medium px-4 py-2 rounded-full">Menu
                                                    Terlaris</span>
                                            @endif
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                        @endforeach

                        <div class="form-priceDetail-wrapper bg-slate-50 border border-slate-100 mt-10 px-6 py-8 rounded-2xl flex flex-col gap-8">
                            <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                                <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Konfigurasi Pesanan</h2>
                                <span class="text-xs font-semibold text-emerald-600">Tersedia</span>
                            </div>

                            <div class="flex flex-col md:flex-row gap-8 md:items-center justify-between">
                                <div class="space-y-3">
                                    <h2 class="text-xs font-semibold text-slate-800">Jumlah Porsi</h2>
                                    <div class="inline-flex items-center p-1 bg-white rounded-xl shadow-sm">
                                        <button type="button" class="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-lg transition-all active:scale-95" onclick="updateTotalPrice(-1)">
                                            <iconify-icon icon="lucide:minus" class="text-base"></iconify-icon>
                                        </button>
                                        <input type="number" id="jumlah-menu" maxlength="3" min="1" max="999" value="1" autocomplete="off" data-price="{{ $menu->harga }}" class="w-16 text-base font-semibold text-primary text-center !border-0 !ring-0 focus:!ring-0 focus:!outline-none focus:!border-0 bg-transparent" oninput="updateTotalPrice(0)">
                                        <button type="button" class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-lg transition-all hover:bg-primary-700 active:scale-95 shadow-sm" onclick="updateTotalPrice(1)">
                                            <iconify-icon icon="lucide:plus" class="text-base"></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                                <div class="space-y-1 text-right">
                                    <h2 class="text-xs font-semibold text-slate-800">Total Pembayaran</h2>
                                    <p class="text-3xl font-bold text-primary">
                                        <span class="text-lg mr-0.5">Rp</span><span id="total-price">{{ number_format($menu->harga, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-row gap-3">
                                <form id="order-now-form" action="{{ route('order.store') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <input type="hidden" name="jumlah" id="jumlah-order-now" value="1">
                                    <button type="submit" class="w-full py-3.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl transition-all shadow-lg shadow-emerald-500/20 active:scale-[0.98] flex items-center justify-center gap-2 uppercase tracking-wider" onclick="setJumlahOrderNow()">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
                                        Pesan Sekarang
                                    </button>
                                </form>

                                <form id="add-to-cart-form" action="{{ route('keranjang.store') }}" method="POST" class="flex-none">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <input type="hidden" name="jumlah" id="jumlah-add-to-cart" value="1">
                                    <button type="submit" class="h-full px-5 py-3.5 bg-white text-emerald-600 border border-emerald-500 font-bold text-xs rounded-xl hover:bg-emerald-50 transition-all active:scale-[0.98] flex items-center justify-center gap-2 uppercase tracking-wider" onclick="setJumlahAddToCart()">
                                        <iconify-icon icon="lucide:shopping-cart" class="text-lg"></iconify-icon>
                                        <span class="hidden md:inline">Keranjang</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </section>


            <section id="suggestion-menu-section"
                class="sticky top-24 self-start mt-6 p-5 h-max rounded-2xl bg-white shadow-sm border border-slate-100 text-primary flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <h2 class="text-lg font-bold text-slate-800">Rekomendasi</h2>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest">Mungkin Anda Suka</p>
                </div>
                <div class="suggestion-menu-wrapper grid grid-cols-2 gap-3">
                    @foreach ($recommendedMenu as $item)
                        <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}" class="group">
                            <div class="flex flex-col gap-3 p-2 rounded-xl bg-white border border-transparent group-hover:border-slate-100 group-hover:shadow-md transition-all duration-300">
                                <img src="{{ Storage::url($item->foto_menu) }}" alt="{{ $item->nama_menu }}"
                                    class="w-full aspect-square object-cover rounded-lg shadow-sm">
                                <div class="flex flex-col gap-1">
                                    <h3 class="text-xs font-semibold text-slate-800 line-clamp-1 group-hover:text-primary transition-colors">
                                        {{ $item->nama_menu }}</h3>
                                    <p class="text-xs font-bold text-primary">
                                        Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
@endsection