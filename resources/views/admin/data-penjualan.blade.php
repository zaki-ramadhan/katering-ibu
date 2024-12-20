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
    <h1 class="text-2xl font-semibold">Dashboard Penjualan</h1>
    <!-- Kartu Laporan Penjualan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold">Penjualan Harian</h3>
            <p class="text-gray-600">Rp {{ number_format($penjualanHarian, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500">Kemarin: Rp {{ number_format($penjualanHarianSebelumnya, 0, ',', '.') }}</p>
            <p class="{{ $perubahanPenjualanHarian > 0 ? 'text-green-500' : 'text-red-500' }}">
                {{ $perubahanPenjualanHarian > 0 ? '⬆️' : '⬇️' }} {{ abs($perubahanPenjualanHarian) }}%
            </p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold">Penjualan Mingguan</h3>
            <p class="text-gray-600">Rp {{ number_format($penjualanMingguan, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500">Minggu Lalu: Rp {{ number_format($penjualanMingguanSebelumnya, 0, ',', '.') }}</p>
            <p class="{{ $perubahanPenjualanMingguan > 0 ? 'text-green-500' : 'text-red-500' }}">
                {{ $perubahanPenjualanMingguan > 0 ? '⬆️' : '⬇️' }} {{ abs($perubahanPenjualanMingguan) }}%
            </p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold">Penjualan Bulanan</h3>
            <p class="text-gray-600">Rp {{ number_format($penjualanBulanan, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500">Bulan Lalu: Rp {{ number_format($penjualanBulananSebelumnya, 0, ',', '.') }}</p>
            <p class="{{ $perubahanPenjualanBulanan > 0 ? 'text-green-500' : 'text-red-500' }}">
                {{ $perubahanPenjualanBulanan > 0 ? '⬆️' : '⬇️' }} {{ abs($perubahanPenjualanBulanan) }}%
            </p>
        </div>
    </div>

    <!-- Tabel Pesanan -->
    <div class="relative overflow-x-auto shadow-lg shadow-slate-200 border rounded-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Tanggal Memesan</th>
                    <th scope="col" class="px-6 py-3">Menu yang Dipesan</th>
                    <th scope="col" class="px-6 py-3">Porsi</th>
                    <th scope="col" class="px-6 py-3">Total Harga</th>
                    <th scope="col" class="px-6 py-3">Metode Pengambilan</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesananSelesai as $pesanan)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $pesanan->created_at->format('d F Y') }}
                        </th>
                        <td class="px-6 py-4">
                            {{ implode(', ', $pesanan->items->pluck('menu.nama_menu')->toArray()) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ implode(', ', $pesanan->items->pluck('quantity')->toArray()) }}
                        </td>
                        <td class="px-6 py-4">
                            Rp {{ number_format($pesanan->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pesanan->pickup_method }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pesanan->pickup_method == 'Kirim' ? $pesanan->delivery_address : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pesanan->payment_method }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
