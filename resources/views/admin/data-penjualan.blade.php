@extends('layouts.admin')

@section('title', 'Data Penjualan - Admin')

@section('vite') 
    @vite('resources/js/admin/data-penjualan.js')
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    {{-- <h1 class="text-2xl font-semibold">Dashboard Penjualan</h1> --}}
    <!-- Kartu Laporan Penjualan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6">
        <div class="bg-white shadow-md shadow-slate-200/60 rounded-lg p-6 flex flex-col gap-3">
            <h3 class="text-lg">Penjualan Harian</h3>
            <p class="text-gray-600 text-xl font-bold"><span class="text-base font-medium">Rp.</span> {{ number_format($penjualanHarian, 0, ',', '.') }}</p>
            <p class=" text-primary text-sm">Kemarin: Rp <span class="font-semibold">{{ number_format($penjualanHarianSebelumnya, 0, ',', '.') }}</span></p>
            <span class="{{ $perubahanPenjualanHarian > 0 ? 'text-green-500' : 'text-red-500' }} font-medium flex justify-start items-center gap-1">
                <iconify-icon icon="{{ $perubahanPenjualanHarian > 0 ? 'entypo:arrow-up' : 'entypo:arrow-down' }}" width="20" height="20" class="{{ $perubahanPenjualanHarian > 0 ? 'animate-little-bounce-up-down' : 'animate-little-bounce-up-down-delay' }}"></iconify-icon>
                {{ abs($perubahanPenjualanHarian) }}%
            </span>
        </div>
        <div class="bg-white shadow-md shadow-slate-200/60 rounded-lg p-6 flex flex-col gap-3">
            <h3 class="text-lg">Penjualan Mingguan</h3>
            <p class="text-gray-600 text-xl font-bold"><span class="text-base font-medium">Rp.</span> {{ number_format($penjualanMingguan, 0, ',', '.') }}</p>
            <p class=" text-primary text-sm">Minggu Lalu: Rp <span class="font-semibold">{{ number_format($penjualanMingguanSebelumnya, 0, ',', '.') }}</span></p>
            <span class="{{ $perubahanPenjualanMingguan > 0 ? 'text-green-500' : 'text-red-500' }} font-medium flex justify-start items-center gap-1">
                <iconify-icon icon="{{ $perubahanPenjualanMingguan > 0 ? 'entypo:arrow-up' : 'entypo:arrow-down' }}" width="20" height="20" class="{{ $perubahanPenjualanMingguan > 0 ? 'animate-little-bounce-up-down' : 'animate-little-bounce-up-down-delay' }}"></iconify-icon>
                {{ abs($perubahanPenjualanMingguan) }}%
            </span>
        </div>
        <div class="bg-white shadow-md shadow-slate-200/60 rounded-lg p-6 flex flex-col gap-3">
            <h3 class="text-lg">Penjualan Bulanan</h3>
            <p class="text-gray-600 text-xl font-bold"><span class="text-base font-medium">Rp.</span> {{ number_format($penjualanBulanan, 0, ',', '.') }}</p>
            <p class=" text-primary text-sm">Bulan Lalu: Rp <span class="font-semibold">{{ number_format($penjualanBulananSebelumnya, 0, ',', '.') }}</span></p>
            <span class="{{ $perubahanPenjualanBulanan > 0 ? 'text-green-500' : 'text-red-500' }} font-medium flex justify-start items-center gap-1">
                <iconify-icon icon="{{ $perubahanPenjualanBulanan > 0 ? 'entypo:arrow-up' : 'entypo:arrow-down' }}" width="20" height="20" class="{{ $perubahanPenjualanBulanan > 0 ? 'animate-little-bounce-up-down' : 'animate-little-bounce-up-down-delay' }}"></iconify-icon>
                {{ abs($perubahanPenjualanBulanan) }}%
            </span>
        </div>
    </div>

    <!-- Tabel Pesanan -->
    <div class="relative overflow-x-auto shadow-lg shadow-slate-200/60 border rounded-xl">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4">No.</th>
                    <th scope="col" class="px-6 py-4">Tanggal Memesan</th>
                    <th scope="col" class="px-6 py-4">Menu yang Dipesan</th>
                    <th scope="col" class="px-6 py-4">Porsi</th>
                    <th scope="col" class="px-6 py-4">Total Harga</th>
                    <th scope="col" class="px-6 py-4">Metode Pengambilan</th>
                    <th scope="col" class="px-6 py-4">Alamat</th>
                    <th scope="col" class="px-6 py-4">Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesananSelesai as $pesanan)
                    <tr class="bg-white border-b text-sm hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900">{{$loop->iteration}}</th>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $pesanan->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4  min-w-60">
                            <div class="line-clamp-2">
                                {{ implode(', ', $pesanan->items->pluck('menu.nama_menu')->toArray()) }}
                            </div> 
                        </td>
                        <td class="px-6 py-4 min-w-28 text-center">
                            {{ implode(', ', $pesanan->items->pluck('quantity')->toArray()) }}
                        </td>
                        <td class="px-6 py-4 min-w-40 text-center">
                            Rp. {{ number_format($pesanan->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{$pesanan['pickup_method']}}
                        </td>
                        <td class="px-6 py-4 min-w-60 {{ $pesanan->pickup_method == 'Kirim' ? '' : 'text-center' }}">
                            <div class="line-clamp-2 ">
                                {{ $pesanan->pickup_method == 'Delivery' ? $pesanan->delivery_address : '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($pesanan['payment_method'] == 'Transfer')
                                Transfer
                            @elseif ($pesanan['payment_method'] == 'Cash')
                                Bayar langsung
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
