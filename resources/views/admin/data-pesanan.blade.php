@extends('layouts.admin')

@section('title', 'Data Pesanan - Admin') 

@section('vite') 
    @vite('resources/js/admin/data-menu.js')
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    <div class="head-btn-wrapper flex justify-between items-end px-3 mt-8">
        <h1 class="font-medium text-base text-primary">Total data pesanan saat ini : {{ $jmlPesanan }}</h1>
        {{-- <a href="{{ route('admin.create-menu') }}" class="w-max text-sm rounded-lg py-3 px-6 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white hover:text-white">
            <button>Tambah Menu</button>
        </a> --}}
    </div>
    <div class="relative overflow-x-auto shadow-lg shadow-slate-200  border rounded-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Tanggal Memesan</th>
                    <th scope="col" class="px-6 py-3">Nama Pelanggan</th>
                    <th scope="col" class="px-6 py-3">Menu yang Dipesan</th>
                    <th scope="col" class="px-6 py-3">Porsi</th>
                    <th scope="col" class="px-6 py-3">Total Harga</th>
                    <th scope="col" class="px-6 py-3">Metode Pengambilan</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Metode Pembayaran</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $pesanan)
                    <tr class="bg-white border-b hover:bg-gray-50 text-xs">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $pesanan['created_date'] }}
                        </th>
                        <td class="px-6 py-4 text-center ">
                            <div class="img-wrapper flex items-center justify-center">
                                <img src="{{ $pesanan['foto_profile'] ? asset('storage/' . $pesanan['foto_profile']) : asset('images/default-pfp-cust-single.png') }}" alt="profile img" class="w-10 h-10 object-cover rounded-full mr-3">
                                <span>{{ $pesanan['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-left  text-xs">
                            <div class="line-clamp-2">
                                {{ implode(', ', $pesanan['menus']) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ implode(', ', $pesanan['portions']) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ number_format($pesanan['total_price'], 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($pesanan['pickup_method'] == 'pickup')
                                Ambil Langsung
                            @elseif ($pesanan['pickup_method'] == 'delivery')
                                Kirim ke Lokasi saya
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-left min-w-80">
                            {{ $pesanan['pickup_method'] == 'delivery' ? $pesanan['address'] : '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pesanan['payment_method'] }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pesanan['status'] }}
                        </td>
                        <td class="px-6 py-4 text-center flex flex-col items-center gap-2">
                            <a href="{{ route('pesanan.edit', $pesanan['id']) }}" class="font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-amber-400 hover:bg-amber-300 active:bg-amber-400">Edit</a>
                            <a href="#" class="font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-red-500 hover:bg-red-400 active:bg-red-500">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
