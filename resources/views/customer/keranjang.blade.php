@extends('layouts.cust')

@section('title', 'Keranjang Saya')

@section('vite')
    @vite(['resources/js/customer/keranjang.js'])
@endsection

@if (session('success'))
    <div id="alert"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white shadow-xl text-sm px-6 py-3 rounded-full z-50 flex items-center justify-center gap-2 animate-bounce">
        <iconify-icon icon="lucide:check-circle" class="text-xl"></iconify-icon>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($keranjang && $keranjang->items->count() > 0)
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div class="space-y-2">
                    <h1 class="text-3xl md:text-4xl font-black text-slate-800">Keranjang Belanja</h1>
                    <p class="text-slate-500 text-sm md:text-base">Periksa kembali pesanan Anda sebelum melakukan checkout.</p>
                </div>
                <div class="flex items-center gap-2 text-sm font-bold text-slate-400 uppercase tracking-widest">
                    <span class="text-primary">{{ $keranjang->items->count() }}</span> Item Terpilih
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                {{-- Cart Items List --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($keranjang->items as $index => $item)
                        <div
                            class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col sm:flex-row items-center gap-6 group hover:border-primary/20 transition-all duration-300">
                            {{-- Item Image --}}
                            <div class="w-24 h-24 rounded-2xl overflow-hidden flex-shrink-0 bg-slate-50">
                                <img src="{{ Storage::url($item->menu->foto_menu) }}" alt="{{ $item->menu->nama_menu }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>

                            {{-- Item Details --}}
                            <div class="flex-1 text-center sm:text-left space-y-1">
                                <h3 class="font-bold text-slate-800 text-lg">{{ $item->menu->nama_menu }}</h3>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Harga Satuan:
                                    Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                                <div class="flex items-center justify-center sm:justify-start gap-4 mt-4">
                                    <div class="flex items-center bg-slate-50 rounded-xl border border-slate-100 p-1">
                                        <span class="px-4 py-1 text-sm font-black text-slate-700">{{ $item->jumlah }} Porsi</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Item Price & Action --}}
                            <div class="flex flex-col items-center sm:items-end gap-3">
                                <p class="text-xl font-black text-primary">
                                    Rp{{ number_format($item->total_harga_item, 0, ',', '.') }}</p>
                                <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-sm"
                                        title="Hapus Item">
                                        <iconify-icon icon="lucide:trash-2" class="text-lg"></iconify-icon>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Order Summary Card --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 sticky top-24 space-y-8">
                        <h2 class="text-xl font-bold text-slate-800">Ringkasan Pesanan</h2>

                        <div class="space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400 font-medium">Subtotal</span>
                                <span
                                    class="text-slate-700 font-bold">Rp{{ number_format($keranjang->total_harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400 font-medium">Pajak (0%)</span>
                                <span class="text-slate-700 font-bold">Rp0</span>
                            </div>
                            <hr class="border-slate-50">
                            <div class="flex justify-between items-center">
                                <span class="text-base font-bold text-slate-800">Total Harga</span>
                                <span
                                    class="text-2xl font-black text-primary">Rp{{ number_format($keranjang->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <form action="{{ route('order.detail') }}" method="GET">
                                @csrf
                                <button type="submit"
                                    class="w-full py-4 bg-primary text-white font-bold rounded-2xl hover:bg-primary-700 transition-all shadow-lg shadow-primary/20 active:scale-95 flex items-center justify-center gap-2">
                                    Lanjut ke Checkout
                                    <iconify-icon icon="lucide:arrow-right" class="text-xl"></iconify-icon>
                                </button>
                            </form>
                            <a href="{{ route('menu') }}"
                                class="w-full py-4 bg-slate-50 text-slate-600 font-bold text-sm rounded-2xl flex items-center justify-center gap-2 hover:bg-slate-100 transition-all">
                                <iconify-icon icon="lucide:plus" class="text-lg"></iconify-icon>
                                Tambah Menu Lain
                            </a>
                        </div>

                        {{-- Info --}}
                        <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100 flex gap-3">
                            <iconify-icon icon="lucide:info" class="text-blue-500 text-xl flex-shrink-0"></iconify-icon>
                            <p class="text-[10px] text-blue-700 leading-relaxed">
                                Harga di atas belum termasuk biaya pengiriman (jika memilih metode pengiriman). Detail akan
                                muncul di halaman checkout.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty Cart State --}}
            <div
                class="min-h-[60vh] flex flex-col items-center justify-center text-center space-y-8 bg-white rounded-3xl shadow-sm border border-slate-100 p-12">
                <div class="relative">
                    <div class="w-40 h-40 bg-slate-50 rounded-full flex items-center justify-center">
                        <iconify-icon icon="lucide:shopping-cart" class="text-7xl text-slate-200"></iconify-icon>
                    </div>
                    <div
                        class="absolute -top-2 -right-2 w-12 h-12 bg-white rounded-2xl shadow-lg flex items-center justify-center text-primary animate-bounce">
                        <iconify-icon icon="lucide:search" class="text-2xl"></iconify-icon>
                    </div>
                </div>
                <div class="space-y-3">
                    <h3 class="text-3xl font-black text-slate-800">Keranjang Kosong</h3>
                    <p class="text-slate-500 max-w-md mx-auto leading-relaxed">
                        Sepertinya Anda belum menambahkan hidangan apa pun ke keranjang. Mari temukan menu lezat kami!
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('menu') }}"
                        class="px-10 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-primary-700 transition-all shadow-lg shadow-primary/20 active:scale-95">
                        Lihat Menu Sekarang
                    </a>
                    <a href="{{ route('home') }}"
                        class="px-10 py-4 bg-slate-50 text-slate-600 font-bold rounded-2xl hover:bg-slate-100 transition-all">
                        Kembali ke Home
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection