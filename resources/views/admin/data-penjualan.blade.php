@extends('layouts.admin')

@section('title', 'Data Penjualan - Admin')

@section('vite')
    @vite('resources/js/admin/data-penjualan.js')
@endsection

@if (session('success'))
    <div id="alert"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white shadow-xl text-sm px-6 py-3 rounded-xl z-[100] flex items-center justify-center gap-2 animate-fade-in-down">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    <div class="container mx-auto px-4 sm:px-8 flex flex-col">
        {{-- <h1 class="text-2xl font-semibold">Dashboard Penjualan</h1> --}}

        <!-- Kartu Laporan Penjualan -->
        <div class="flex justify-between items-center mt-8 mb-4">
            <h2 class="text-xl font-black text-slate-800">Laporan Penjualan</h2>
            <button id="print-button"
                class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-bold rounded-xl hover:bg-primary-600 hover:shadow-lg hover:shadow-primary/20 transition-all active:scale-95">
                <iconify-icon icon="lucide:printer" class="text-lg"></iconify-icon>
                Print Laporan
            </button>
        </div>

        <div id="highlight-stats" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div
                class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6 flex flex-col gap-4 group hover:shadow-md transition-all">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Penjualan Harian</h3>
                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="text-3xl font-black text-slate-800"><span
                            class="text-sm font-bold mr-1 text-slate-400">Rp</span>{{ number_format($penjualanHarian, 0, ',', '.') }}
                    </p>
                    <p class="text-xs font-medium text-slate-400">Kemarin: <span class="text-slate-600">Rp
                            {{ number_format($penjualanHarianSebelumnya, 0, ',', '.') }}</span></p>
                </div>
                <div class="flex items-center gap-2">
                    <span
                        class="px-2 py-1 rounded-lg text-xs font-black {{ $perubahanPenjualanHarian > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} flex items-center gap-1">
                        <iconify-icon
                            icon="{{ $perubahanPenjualanHarian > 0 ? 'lucide:trending-up' : 'lucide:trending-down' }}"></iconify-icon>
                        {{ abs($perubahanPenjualanHarian) }}%
                    </span>
                    <span id="daily-time" class="text-slate-300 text-[10px] font-bold uppercase"></span>
                </div>
            </div>
            <div
                class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6 flex flex-col gap-4 group hover:shadow-md transition-all">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Penjualan Mingguan</h3>
                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="text-3xl font-black text-slate-800"><span
                            class="text-sm font-bold mr-1 text-slate-400">Rp</span>{{ number_format($penjualanMingguan, 0, ',', '.') }}
                    </p>
                    <p class="text-xs font-medium text-slate-400">Minggu Lalu: <span class="text-slate-600">Rp
                            {{ number_format($penjualanMingguanSebelumnya, 0, ',', '.') }}</span></p>
                </div>
                <div class="flex items-center gap-2">
                    <span
                        class="px-2 py-1 rounded-lg text-xs font-black {{ $perubahanPenjualanMingguan > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} flex items-center gap-1">
                        <iconify-icon
                            icon="{{ $perubahanPenjualanMingguan > 0 ? 'lucide:trending-up' : 'lucide:trending-down' }}"></iconify-icon>
                        {{ abs($perubahanPenjualanMingguan) }}%
                    </span>
                    <span id="weekly-time" class="text-slate-300 text-[10px] font-bold uppercase"></span>
                </div>
            </div>
            <div
                class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6 flex flex-col gap-4 group hover:shadow-md transition-all">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Penjualan Bulanan</h3>
                    <div class="w-2 h-2 rounded-full bg-amber-400"></div>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="text-3xl font-black text-slate-800"><span
                            class="text-sm font-bold mr-1 text-slate-400">Rp</span>{{ number_format($penjualanBulanan, 0, ',', '.') }}
                    </p>
                    <p class="text-xs font-medium text-slate-400">Bulan Lalu: <span class="text-slate-600">Rp
                            {{ number_format($penjualanBulananSebelumnya, 0, ',', '.') }}</span></p>
                </div>
                <div class="flex items-center gap-2">
                    <span
                        class="px-2 py-1 rounded-lg text-xs font-black {{ $perubahanPenjualanBulanan > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} flex items-center gap-1">
                        <iconify-icon
                            icon="{{ $perubahanPenjualanBulanan > 0 ? 'lucide:trending-up' : 'lucide:trending-down' }}"></iconify-icon>
                        {{ abs($perubahanPenjualanBulanan) }}%
                    </span>
                    <span id="monthly-time" class="text-slate-300 text-[10px] font-bold uppercase"></span>
                </div>
            </div>
        </div>

        <!-- Tabel Pesanan -->
        <div class="relative overflow-x-auto shadow-sm border border-slate-100 rounded-2xl bg-white mb-8">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">No</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Tgl Pesan</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Menu</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Porsi</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Total Harga</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Pengambilan</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Alamat</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($pesananSelesai as $pesanan)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center font-bold text-slate-400">{{$loop->iteration}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-medium">
                                {{ $pesanan->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 min-w-[12rem]">
                                <p class="line-clamp-2 text-slate-800 font-medium">
                                    {{ implode(', ', $pesanan->items->pluck('menu.nama_menu')->toArray()) }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-slate-800">
                                {{ implode(', ', $pesanan->items->pluck('quantity')->toArray()) }}
                            </td>
                            <td class="px-6 py-4 font-black text-primary whitespace-nowrap">
                                <span
                                    class="text-[10px] font-bold mr-0.5">Rp</span>{{ number_format($pesanan->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $pesanan['pickup_method'] == 'Delivery' ? 'bg-blue-50 text-blue-600' : 'bg-slate-100 text-slate-600' }}">
                                    {{$pesanan['pickup_method']}}
                                </span>
                            </td>
                            <td class="px-6 py-4 min-w-[15rem]">
                                <p class="line-clamp-2 text-slate-500 text-xs">
                                    {{ $pesanan->pickup_method == 'Delivery' ? $pesanan->delivery_address : '-' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-600">
                                    @if ($pesanan['payment_method'] == 'Transfer')
                                        Transfer
                                    @elseif ($pesanan['payment_method'] == 'Cash')
                                        Cash
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection