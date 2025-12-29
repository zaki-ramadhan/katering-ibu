@extends('layouts.cust')

@section('title', 'Riwayat Pesanan Saya')

@section('vite')
    @vite('resources/js/customer/order-history.js')
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
        @if($data->isEmpty())
            <div
                class="min-h-[60vh] flex flex-col items-center justify-center text-center space-y-6 bg-white rounded-3xl shadow-sm border border-slate-100 p-12">
                <div class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center">
                    <iconify-icon icon="lucide:shopping-bag" class="text-6xl text-slate-200"></iconify-icon>
                </div>
                <div class="space-y-2">
                    <h3 class="text-2xl font-black text-slate-800">Belum Ada Pesanan</h3>
                    <p class="text-slate-500 max-w-md mx-auto">Sepertinya Anda belum pernah melakukan pemesanan. Ayo jelajahi
                        menu lezat kami sekarang!</p>
                </div>
                <a href="{{ route('menu') }}"
                    class="px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-primary-700 transition-all shadow-lg shadow-primary/20 active:scale-95">
                    Pesan Sekarang
                </a>
            </div>
        @else
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div class="space-y-2">
                    <h1 class="text-3xl md:text-4xl font-black text-slate-800">Riwayat Pesanan</h1>
                    <p class="text-slate-500 text-sm md:text-base">Pantau status dan kelola semua pesanan Anda di sini.</p>
                </div>
                <a href="{{ route('menu') }}"
                    class="px-6 py-3 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/20 active:scale-95 flex items-center gap-2 w-max">
                    <iconify-icon icon="lucide:plus" class="text-lg"></iconify-icon>
                    Buat Pesanan Baru
                </a>
            </div>

            {{-- Table Section --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-xs">No</th>
                                <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-xs">Tanggal
                                </th>
                                <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-xs">Menu</th>
                                <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-xs">Total</th>
                                <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-xs">Status</th>
                                <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-xs text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($data as $pesanan)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-6 py-6 font-bold text-slate-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-700">{{ $pesanan['created_date'] }}</span>
                                            <span
                                                class="text-xs text-slate-400 font-medium">#{{ substr($pesanan['id'], 0, 8) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="max-w-xs">
                                            <p class="font-bold text-slate-700 line-clamp-1">{{ implode(', ', $pesanan['menus']) }}
                                            </p>
                                            <p class="text-xs text-slate-400">{{ array_sum($pesanan['portions']) }} Porsi •
                                                {{ $pesanan['pickup_method'] }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <span
                                            class="font-black text-primary">Rp{{ number_format($pesanan['total_price'], 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        @php
                                            $statusClasses = [
                                                'Pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'Processed' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                'Completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'Cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                            ];
                                            $statusLabels = [
                                                'Pending' => 'Menunggu',
                                                'Processed' => 'Diproses',
                                                'Completed' => 'Selesai',
                                                'Cancelled' => 'Batal',
                                            ];
                                            $currentStatus = $pesanan['status'] ?? 'Pending';
                                        @endphp
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClasses[$currentStatus] ?? $statusClasses['Pending'] }}">
                                            {{ $statusLabels[$currentStatus] ?? $statusLabels['Pending'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('pesanan.payOrder', $pesanan['id']) }}"
                                                class="w-9 h-9 bg-white border border-slate-200 text-slate-400 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all shadow-sm"
                                                title="Detail / Bayar">
                                                <iconify-icon icon="lucide:eye" class="text-lg"></iconify-icon>
                                            </a>
                                            @if ($pesanan['status'] == 'Pending' || $pesanan['status'] == 'Completed' || $pesanan['status'] == 'Cancelled')
                                                <form action="{{ route('pesanan.destroy', $pesanan['id']) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-9 h-9 bg-white border border-slate-200 text-slate-400 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white hover:border-red-500 transition-all shadow-sm"
                                                        onclick="return confirm('Hapus riwayat pesanan ini?')">
                                                        <iconify-icon icon="lucide:trash-2" class="text-lg"></iconify-icon>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection