@extends('layouts.cust')

@section('title', 'Pesanan Saya')

@section('vite')
    @vite(['resources/js/customer/pesanan-detail.js'])
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md shadow-slate-200/50 text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
<div class="container mx-auto mt-8 px-4 py-6 lg:px-8">
    <h2 class="text-3xl font-bold mb-16 text-center text-primary">Detail pesanan saya</h2>

    <div class="flex flex-wrap lg:flex-nowrap gap-8">
        <!-- Bagian Kiri: Detail Pesanan -->
        <div class="card w-full lg:w-2/3 bg-white p-8 shadow-lg border border-slate-200 shadow-slate-200/50 rounded-3xl">
            <h3 class="text-lg font-medium text-primary mb-5">Keterangan Menu yang Dipesan</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg text-sm">
                    <thead class="bg-tertiary-100/60 text-primary">
                        <tr>
                            <th class="py-5 px-4 text-left font-semibold">No.</th>
                            <th class="py-5 px-4 text-left font-semibold">Foto</th>
                            <th class="py-5 px-4 text-left font-semibold">Menu</th>
                            <th class="py-5 px-4 text-center font-semibold">Jumlah porsi</th>
                            <th class="py-5 px-4 text-right font-semibold">Harga</th>
                            <th class="py-5 px-4 text-right font-semibold">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($cartItems as $index => $item)
                            @if($item->menu)
                                <tr class="border-b">
                                    <td class="p-4">{{ $index + 1 }}</td>
                                    <td class="p-4">
                                        <img src="{{ Storage::url($item->menu->foto_menu) }}" alt="{{ $item->menu->nama_menu }}" class="w-16 h-16 object-cover rounded-md">
                                    </td>
                                    <td class="p-4 max-w-40 truncate">{{ $item->menu->nama_menu }}</td>
                                    <td class="p-4 text-center">{{ $item->jumlah }}</td>
                                    <td class="p-4 text-right">Rp. {{ number_format($item->menu->harga, 0, ',', '.') }}</td>
                                    <td class="p-4 text-right">Rp. {{ number_format($item->jumlah * $item->menu->harga, 0, ',', '.') }}</td>
                                </tr>
                            @else
                                <tr class="border-b">
                                    <td class="p-4" colspan="6">Item tidak ditemukan.</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-base font-semibold mb-2">Ongkos Kirim</h3>
                <p id="shipping_cost">Rp. 0</p>
            </div>
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-base font-semibold mb-2">Total Pesanan</h3>
                <p id="total_cost">Rp. {{ number_format($cartItems->sum(function($item) { return $item->jumlah * $item->menu->harga; }), 0, ',', '.') }}</p>
                <input type="hidden" id="initial_total" value="{{ $cartItems->sum(function($item) { return $item->jumlah * $item->menu->harga; }) }}">
            </div>
        </div>

        <!-- Bagian Kanan: Form -->
        <div class="card-form w-full lg:w-1/3 bg-white border border-slate-200 p-6 shadow-lg shadow-slate-200/50 rounded-3xl">
            <form action="{{ route('order.process') }}" method="POST">
                @csrf

                <!-- Informasi Pemesan -->
                <div class="flex flex-col gap-3">
                    <h3 class="block text-xl font-medium text-primary">Informasi Pesanan</h3>
                    <hr class="mb-4">
                    <div class="flex flex-col gap-2">
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full py-2 rounded-md border border-gray-300 text-sm indent-1 focus:text-primary">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full py-2 rounded-md border border-gray-300 text-sm indent-1" disabled readonly>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ Auth::user()->notelp ?? '-' }}" class="w-full py-2 rounded-md border border-gray-300 text-sm indent-1 focus:text-primary">
                        @if (is_null(Auth::user()->notelp))
                            <p class="hidden text-red-500 text-xs mt-1">Lengkapi data nomor telepon Anda terlebih dahulu.</p>
                        @endif
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-6 mt-8 flex flex-col gap-2">
                    <h3 class="block text-sm font-medium text-gray-700">Metode Pembayaran</h3>
                    <select name="payment_method" class="w-full text-sm p-2 border border-gray-300 rounded-md">
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="cash_on_delivery">Bayar di Tempat</option>
                    </select>
                </div>

                <!-- Metode Pengambilan -->
                <div class="mb-6 flex flex-col gap-2">
                    <h3 class="block text-sm font-medium text-gray-700">Metode Pengambilan</h3>
                    <select name="pickup_method" id="pickup_method" class="w-full text-sm p-2 border border-gray-300 rounded-md">
                        <option value="pickup">Ambil di Tempat</option>
                        <option value="delivery">Dikirim ke Lokasi</option>
                    </select>
                </div>

                <!-- Alamat Pengiriman -->
                <div class="mb-6 flex flex-col gap-2" id="delivery_address_section" style="display: none;">
                    <h3 class="block text-sm font-medium text-gray-700">Alamat Pengiriman</h3>
                    <input type="text" name="delivery_address" class="w-full p-2 border border-gray-300 rounded-md text-sm" autocomplete="off" placeholder="Masukkan Alamat Pengiriman" cols="10">
                </div>

                <!-- Tombol Proses Pesanan dan Batal -->
                <div class="flex justify-center gap-4">
                    <a href="{{ route('customer.keranjang') }}" class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">Proses Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
