@extends('layouts.cust')

@section('title', 'Pesanan Saya')

@section('vite')
    @vite(['resources/js/customer/pesanan-detail.js'])
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
<div class="container mx-auto mt-8 px-4 py-6 lg:px-8">  
    <div class="flex flex-wrap lg:flex-nowrap gap-8">
        <!-- Bagian Kiri: Detail Pesanan -->
        @if($cartItems->isEmpty())
        <div class="alert-empty w-full h-max py-20 text-center text-red-500 bg-red-100 border border-red-300 rounded-2xl shadow-md shadow-slate-200/30">
            <h3 class="font-semibold text-lg">Pesanan Kosong</h3>
            <p class="text-sm mt-2">Anda tidak memiliki menu dalam pesanan ini. Silakan tambahkan menu terlebih dahulu.</p>
            <a href="{{ route('menu') }}" class="mt-5 text-sm inline-block bg-blue-500 hover:bg-blue-600 active:bg-blue-500 text-white font-medium py-[.7rem] px-4 rounded-md">Kembali ke Menu</a>
        </div>
        @else
        <div class="text-wrapper flex flex-col justify-center items-center gap-2 mb-16">
            <h2 class="text-3xl font-bold text-center text-primary">Detail pesanan saya</h2>
            <p>Periksa dan lengkapi data di bawah ini untuk melanjutkan ke proses pemesanan.</p>
        </div>
            <div class="card w-full lg:w-2/3 max-h-max bg-white p-8 shadow-lg border border-slate-200 shadow-slate-200/50 rounded-3xl">
                <h3 class="text-lg font-medium text-primary mb-5">Keterangan Menu yang Dipesan</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg text-sm">
                        <thead class="bg-tertiary-100 text-primary">
                            <tr>
                                <th class="py-5 px-4 text-left font-semibold">No.</th>
                                <th class="py-5 px-4 text-left font-semibold">Foto</th>
                                <th class="py-5 px-4 text-left font-semibold">Menu</th>
                                <th class="py-5 px-4 text-center font-semibold">Jumlah porsi</th>
                                <th class="py-5 px-4 text-right font-semibold">Harga/porsi</th>
                                <th class="py-5 px-4 text-right font-semibold">Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-primary">
                            @foreach($cartItems as $index => $item)
                                @if($item->menu)
                                    <tr class="border-b hover:bg-tertiary-50">
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
                <div class="btn-alert-wrapper flex justify-end items-center gap-10 mt-6 group">
                    <p class="hidden group-hover:block text-red-500 text-xs w-full ps-4 relative before:content-['**'] before:absolute before:top-0 before:left-0">Untuk menambahkan menu lainnya ke dalam pesanan, Anda akan menambahkan menu ke dalam keranjang terlebih dahulu. Lalu masuk kembali ke halaman ini.</p>
                    <a href="{{ route('menu') }}" class="button min-w-max place-self-end p-4 bg-slate-600 hover:bg-slate-500 active:bg-slate-600 text-white rounded-lg text-xs font-medium">Tambahkan menu lainnya</a>
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
                        <label class="block text-sm font-medium text-primary">Nama</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full py-2 rounded-md border border-gray-300 text-sm indent-1 focus:text-primary" disabled readonly>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="block text-sm font-medium text-primary">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full py-2 rounded-md border border-gray-300 text-sm indent-1" disabled readonly>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="block text-sm font-medium text-primary">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ Auth::user()->notelp ?? '-' }}" class="w-full py-2 rounded-md border border-gray-300 text-sm indent-1 focus:text-primary">
                        @if (is_null(Auth::user()->notelp))
                            <p class="hidden text-red-500 text-xs mt-1">Lengkapi data nomor telepon Anda terlebih dahulu.</p>
                        @endif
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <form action="{{ route('order.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Metode Pembayaran -->
                    <div class="mb-6 mt-8 flex flex-col gap-2">
                        <h3 class="block text-sm font-medium text-primary">Metode Pembayaran</h3>
                        <select id="payment_method" name="payment_method" class="w-full text-sm p-2 border border-gray-300 rounded-md text-primary">
                            <option value="bank_transfer" class="text-secondary">Transfer </option>
                            <option value="cash_on_delivery" class="text-secondary">Bayar Langsung</option>
                        </select>
                        <div id="payment_instruction" class="hidden mt-2 text-sm text-primary">
                            <p>Silakan transfer ke salah satu rekening berikut:</p>
                            <div id="bank_bri_instruction" class="hidden mt-3 p-3 rounded-xl border bg-tertiary-50">
                                <p class="font-medium">BANK BRI</p>
                                <p class="mt-1 text-secondary">No. Rekening: 4194 01 039789 53 7</p>
                                <p class="mt-1 text-secondary">Atas Nama: Fiqry Omar Atala</p>
                            </div>
                            <div id="dana_instruction" class="hidden my-3 p-3 rounded-xl border bg-tertiary-50">
                                <p class="font-medium">DANA</p>
                                <p class="mt-1 text-secondary">No. Rekening: 0987654321</p>
                                <p class="mt-1 text-secondary">Atas Nama: PT Dana</p>
                            </div>
                            {{-- <p>Unggah bukti pembayaran di bawah ini:</p> --}}
                            {{-- <input type="file" name="payment_proof" id="paymentProofInput" class="block w-max text-sm mt-2 text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"> --}}
                            <div id="alert-wrapper" class="hidden my-3 px-4 py-3 rounded-xl border border-blue-300 bg-blue-50 text-blue-400 items-center gap-3">
                                <iconify-icon icon="fluent:alert-32-filled" width="20" height="20" class="h-max aspect-square p-1 rounded-full border border-blue-300"></iconify-icon>
                                <p class="text-xs leading-5">Bukti pembayaran dapat Anda unggah di halaman selanjutnya / halaman riwayat pesanan, setelah Anda mengkonfirmasi pesanan ini.</p>
                            </div>
                        </div>                        
                        {{-- <input type="file" id="payment_proof" name="payment_proof" class="hidden mt-2 text-sm border border-gray-300 rounded-md p-2"> --}}
                    </div>                

                <!-- Metode Pengambilan -->
                <div class="mb-6 flex flex-col gap-2">
                    <h3 class="block text-sm font-medium text-primary">Metode Pengambilan</h3>
                    <select name="pickup_method" id="pickup_method" class="w-full text-sm p-2 border border-gray-300 rounded-md text-primary">
                        <option value="pickup" class="text-secondary">Ambil di Tempat</option>
                        <option value="delivery" class="text-secondary">Dikirim ke Lokasi</option>
                    </select>
                </div>

                <!-- Alamat Pengiriman -->
                <div class="mb-6 flex flex-col gap-2" id="delivery_address_section" style="display: none;">
                    <h3 class="block text-sm font-medium text-primary">Alamat Pengiriman</h3>
                    <textarea name="delivery_address" class="w-full p-2 border border-gray-300 rounded-md text-sm text-primary resize-none" autocomplete="off" cols="30" rows="6"></textarea>
                </div>

                <!-- Informasi Ongkos Kirim dan Total Harga -->
                <div class="rincian-pesanan-wrapper flex flex-col gap-3 mt-10">
                    <h2 class="block text-sm font-medium text-primary">Rincian Pesanan</h2>
                    <div class="detail-wrapper flex flex-col gap-7 p-6 bg-tertiary-50 border border-slate-200 rounded-xl">
                        <div class="flex justify-between">
                            <h3 class="text-sm text-primary">Subtotal : </h3>
                            <p class="text-sm">Rp. {{ number_format($cartItems->sum(function($item) { return $item->jumlah * $item->menu->harga; }), 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between">
                            <h3 class="text-sm text-primary">Ongkos Kirim : </h3>
                            <p id="shipping_cost" class="text-sm">-</p>
                        </div>
                        <div class="flex justify-between">
                            <h3 class="text-sm text-primary">Total Pesanan : </h3>
                            <p id="total_cost" class="text-base font-bold text-primary">Rp. {{ number_format($cartItems->sum(function($item) { return $item->jumlah * $item->menu->harga; }) + 0, 0, ',', '.') }}</p>
                            <input type="hidden" id="initial_total" value="{{ $cartItems->sum(function($item) { return $item->jumlah * $item->menu->harga; }) }}">
                        </div>                        
                    </div>
                    <div class="warning-wrapper">
                        <p class="text-xs text-slate-400 ps-2 relative before:content-['*'] before:absolute before:top-0 before:left-0">Jika Anda memesan dan melunasi pembayaran pada hari ini, maka pesanan akan selesai paling cepat <span class="text-primary font-semibold">7 hari</span>  setelah anda melunasi pembayaran.</p>
                    </div>
                </div>

                <!-- Tombol Proses Pesanan dan Batal -->
                <div class="flex text-sm gap-2 mt-8">
                    <a href="{{ route('customer.keranjang') }}" class="px-6 py-3 text-center bg-slate-100 text-primary font-medium rounded-lg hover:bg-slate-200/70 border active:bg-slate-100 flex-1">Batal</a>
                    <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 active:bg-blue-500 grow">Konfirmasi Pesanan</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
