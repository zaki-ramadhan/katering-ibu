@extends('layouts.app')

@section('title', 'Menu Katering Ibu')

@section('vite')
    @vite('resources/js/menu.js')
@endsection

{{-- Modal tombol keranjang --}}
<div id="cartModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm overflow-y-auto h-full w-full z-50">
    <div id="modalContent"
        class="absolute top-1/2 left-1/2  -translate-x-1/2 -translate-y-1/2 mx-auto p-3 border w-full max-w-md shadow-lg rounded-xl bg-white">
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
                            <input type="number" id="jumlah" name="jumlah"
                                class="mt-1 p-2 border border-gray-300 rounded-md focus:text-primary" min="1" max="100"
                                maxlength="3" value="1" autocomplete="off" required>
                        </div>
                        <div class="total-harga-wrapper mb-4 -translate-y-1">
                            <p id="total_harga" class="text-right font-medium text-sm text-gray-900 w-max"></p>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4 gap-2 text-sm">
                        <button type="button"
                            class="modal-close px-5 py-3 bg-slate-100 hover:bg-slate-200/70 active:bg-slate-100 text-primary border rounded-lg">Batal</button>
                        <button type="submit"
                            class="px-5 py-3 min-w-44 bg-emerald-400 text-white rounded-lg hover:bg-emerald-500 active:bg-emerald-400">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('content')
    {{-- hero-section --}}
    <section id="hero-section" class="container px-4 relative text-white">
        <div
            class="img-overlay-group container w-full h-[20rem] lg:h-[25rem] overflow-hidden relative rounded-xl lg:rounded-3xl">
            <img src="https://images.unsplash.com/photo-1498579809087-ef1e558fd1da?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzR8fGNhdGVyaW5nJTIwZm9vZHxlbnwwfHwwfHx8MA%3D%3D"
                alt="hero image" class="w-full h-full object-cover">
            <div class="overlay absolute inset-0 bg-black/30"></div>

            <div class="text-input-group absolute inset-0 flex flex-col items-center justify-center gap-6 lg:gap-8 z-10">
                <h1 class="w-[90vw] lg:w-[50vw] text-4xl lg:text-5xl text-center leading-tight font-semibold">Siap menemukan
                    hidangan <span class="italic">favoritmu?</span> temukan disini!</h1>
                <div class="input-wrapper w-full flex items-center justify-center">
                    <form action="{{ route('menu.search') }}" method="GET"
                        class="flex items-center gap-2 w-full max-w-md md:max-w-lg lg:max-w-2xl px-4">
                        <div class="relative flex-1">
                            <label for="search-menu"
                                class="absolute inset-y-0 left-4 hidden md:flex items-center text-secondary hover:text-primary">
                                <iconify-icon icon="akar-icons:search" class="text-lg"></iconify-icon>
                            </label>
                            <input type="search" name="find" id="search-menu" placeholder="Cari menu favoritmu disini..."
                                autocomplete="off" value="{{ request()->input('query') }}" required
                                class="w-full rounded-lg text-sm py-3.5 ps-4 md:ps-12 pe-10 text-primary focus:outline-none focus:ring-0 border-0 focus:border-transparent shadow-sm">
                            <div id="clear-btn"
                                class="absolute inset-y-0 right-3 hidden items-center text-secondary hover:text-primary cursor-pointer">
                                <iconify-icon icon="ic:outline-clear" class="text-lg"></iconify-icon>
                            </div>
                        </div>
                        <button type="submit"
                            class="flex-none bg-primary hover:bg-primaryHovered active:bg-primary duration-150 px-4 md:px-6 py-3.5 text-sm font-medium rounded-lg shadow-sm text-white">
                            <span class="flex md:hidden items-center"><iconify-icon icon="akar-icons:search"
                                    class="text-xl"></iconify-icon></span>
                            <span class="hidden md:inline">Cari Menu</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian untuk menampilkan menu terlaris -->
    <section id="top-menu-section" class="container px-4">
        <div class="top-menu-wrapper w-full p-6 bg-white mt-6 rounded-xl">
            <h2
                class="text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full">
                Menu <span class="font-bold">terlaris</span> saat ini</h2>
            <div
                class="card-wrapper flex overflow-x-auto snap-x pb-6 gap-4 pt-6 group md:grid md:grid-cols-3 lg:grid-cols-4 md:gap-x-1 md:gap-y-8 text-primary scrollbar-hide">
                @foreach ($bestSellingMenus as $item)
                    <figure
                        class="card min-w-[17rem] snap-center relative hover:text-primary duration-150 border border-transparent p-3 pb-4 rounded-2xl hover:border-slate-200 hover:shadow-md hover:shadow-slate-200/60 md:min-w-0">
                        <div class="img-container aspect-4/3 rounded-2xl overflow-hidden">
                            <img src="{{ Storage::url($item->foto_menu) }}" alt="{{ $item->nama_menu }}"
                                class="w-full h-full object-cover brightness-100 duration-200">
                        </div>
                        <figcaption class="card-content mt-4 flex flex-col gap-1 text-primary">
                            <div class="label-wrapper flex items-center gap-2 relative">
                                <p
                                    class="label time-created font-medium text-[11px] text-slate-500 flex items-center justify-start gap-1 bg-slate-100 w-max px-2.5 py-1 rounded-full">
                                    <iconify-icon icon="lucide:calendar" class="text-xs"></iconify-icon> {{ $item->formatted_date }}
                                </p>
                                @if (in_array($item->id, $bestSellingMenuIds))
                                    <span
                                        class="bg-amber-100/80 text-amber-600 text-[11px] font-bold px-2.5 py-1 rounded-full border border-amber-200/50">
                                        Terlaris
                                    </span>
                                @endif
                            </div>
                             <h3 class="menu-name font-bold text-base md:text-lg mt-2 line-clamp-1">{{ $item->nama_menu }}</h3>
                            <h4 class="title-desc-menu text-xs font-bold mt-1 text-slate-400 uppercase tracking-wider">
                                Deskripsi Menu :</h4>
                            <p
                                class="description-menu text-xs font-medium text-justify text-slate-500 leading-relaxed line-clamp-2">
                                {{ $item->deskripsi }}
                            </p>
                            <hr class="border-slate-100 my-3">
                            <footer class="card-footer flex justify-between items-center">
                                <p class="font-black text-primary text-lg">
                                    <span
                                        class="text-xs font-bold mr-0.5">Rp</span>{{ number_format($item->harga, 0, ',', '.') }}<span
                                        class="text-xs text-slate-400 font-medium ml-1">/porsi</span>
                                </p>
                            </footer>
                            <div class="button-wrapper w-full flex gap-2 mt-4">
                                @auth
                                    <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}"
                                        class="grow bg-emerald-500 hover:bg-emerald-600 text-white py-3 text-xs font-bold flex items-center justify-center gap-2 rounded-xl duration-150 shadow-lg shadow-emerald-500/20 active:scale-[0.98]">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
                                        Pesan
                                    </a>
                                    <button data-menu-id="{{ $item->id }}" data-menu-name="{{ $item->nama_menu }}"
                                        data-menu-photo="{{ Storage::url($item->foto_menu) }}" data-menu-price="{{ $item->harga }}"
                                        class="btn-add-to-cart flex-none w-12 text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 py-3 flex items-center justify-center rounded-xl duration-150 active:scale-[0.95]">
                                        <iconify-icon icon="lucide:shopping-cart" class="text-lg"></iconify-icon>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="grow bg-slate-100 text-slate-400 py-3 text-xs font-bold flex items-center justify-center gap-2 rounded-xl duration-150 cursor-not-allowed">
                                        <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
                                        Pesan Sekarang
                                    </a>
                                @endauth
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
            @if (isset($query) && $query != '' && $menu->isEmpty())
                <div
                    class="not-found-content-wrapper flex flex-col lg:flex-row items-center justify-center gap-4 lg:translate-y-12">
                    <img src="{{ asset('images/empty.svg') }}" alt="img-empty" class="max-w-[30rem]">
                    <div class="text-wrapper text-center lg:text-left flex flex-col gap-3 max-w-[32rem] ">
                        <h2 class="font-bold text-2xl lg:text-4xl text-primary">Ups! menu "{{ $query }}" tidak
                            tersedia.</h2>
                        <p class="w-80 md:w-[90%] md:ms-6 lg:ms-0 lg:w-full leading-7 lg:leading-8 text-sm lg:text-base">
                            Maaf, kami tidak dapat menemukan menu yang cocok dengan pencarian Anda. Silakan coba kata kunci
                            yang berbeda.</p>
                    </div>
                </div>
            @else
                <h2
                    class="text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full">
                    Semua <span class="font-bold">Menu ({{ $jumlahMenu }})</span> </h2>
            @endif


            <div
                class="card-wrapper grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-x-1 md:gap-y-8 pt-6 text-primary">
                @foreach ($menu as $item)
                    <figure
                        class="card relative w-full flex flex-row md:flex-col gap-4 md:gap-0 hover:text-primary duration-150 border border-transparent p-3 rounded-xl md:rounded-2xl hover:border-slate-200 hover:shadow-md hover:shadow-slate-200/60 bg-white md:bg-transparent shadow-sm md:shadow-none">

                        {{-- Image Section --}}
                        <div
                            class="img-container w-28 h-28 md:w-full md:h-auto md:aspect-4/3 shrink-0 rounded-xl md:rounded-2xl overflow-hidden bg-slate-100">
                            <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto {{ $item->nama_menu }}"
                                class="w-full h-full object-cover brightness-100 duration-200">
                        </div>

                        {{-- Content Section --}}
                        <figcaption class="card-content md:mt-4 flex flex-col gap-1 text-primary flex-1 justify-between">
                            <div>
                                <div class="label-wrapper flex flex-wrap items-center gap-2 mb-1">
                                    <p
                                        class="time-created font-medium text-[11px] text-slate-500 flex items-center justify-start gap-1 bg-slate-100 w-max px-2.5 py-1 rounded-full">
                                        <iconify-icon icon="lucide:calendar" class="text-xs"></iconify-icon>
                                        {{ $item->formatted_date }}
                                    </p>
                                    @if (in_array($item->id, $bestSellingMenuIds))
                                        <span
                                            class="bg-amber-100/80 text-amber-600 text-[11px] font-bold px-2.5 py-1 rounded-full border border-amber-200/50">Terlaris</span>
                                    @endif
                                </div>
                                <h3 class="menu-name font-bold text-base md:text-lg line-clamp-2 md:line-clamp-1 leading-snug">
                                    {{ $item->nama_menu }}</h3>
                                <p
                                    class="description-menu text-xs font-medium text-slate-500 leading-relaxed line-clamp-2 hidden md:block mt-1">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>

                            <div>
                                <hr class="border-slate-100 my-3 hidden md:block">
                                <footer class="card-footer flex justify-between items-center mt-1 md:mt-0">
                                    <p class="font-black text-primary text-base md:text-lg">
                                        <span
                                            class="text-xs font-bold mr-0.5">Rp</span>{{ number_format($item->harga, 0, ',', '.') }}<span
                                            class="text-xs text-slate-400 font-medium ml-1 hidden md:inline">/porsi</span>
                                    </p>
                                </footer>
                                <div class="button-wrapper w-full flex gap-2 mt-2 md:mt-4">
                                    @auth
                                        <a href="{{ route('order-now.show', ['order_now' => $item->id]) }}"
                                            class="grow bg-emerald-500 hover:bg-emerald-600 text-white py-2.5 md:py-3 text-xs font-bold flex items-center justify-center gap-2 rounded-xl duration-150 shadow-lg shadow-emerald-500/20 active:scale-[0.98]">
                                            <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
                                            <span class="md:hidden">Pesan</span>
                                            <span class="hidden md:inline">Pesan Sekarang</span>
                                        </a>
                                        <button data-menu-id="{{ $item->id }}" data-menu-name="{{ $item->nama_menu }}"
                                            data-menu-photo="{{ Storage::url($item->foto_menu) }}"
                                            data-menu-price="{{ $item->harga }}"
                                            class="btn-add-to-cart flex-none w-10 md:w-12 text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 flex items-center justify-center rounded-xl duration-150 active:scale-[0.95]">
                                            <iconify-icon icon="lucide:shopping-cart" class="text-lg"></iconify-icon>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="grow bg-slate-100 text-slate-400 py-2.5 md:py-3 text-xs font-bold flex items-center justify-center gap-2 rounded-xl duration-150 cursor-not-allowed">
                                            <iconify-icon icon="tdesign:shop-filled" class="text-lg"></iconify-icon>
                                            <span class="md:hidden">Pesan</span>
                                            <span class="hidden md:inline">Pesan Sekarang</span>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
@endsection