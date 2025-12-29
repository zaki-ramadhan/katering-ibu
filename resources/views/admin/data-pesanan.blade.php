@extends('layouts.admin')

@section('title', 'Data Pesanan - Admin')

@section('vite')
    @vite('resources/js/admin/data-pesanan.js')
@endsection

@if (session('success'))
    <div id="alert"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white shadow-xl text-sm px-6 py-3 rounded-xl z-[100] flex items-center justify-center gap-2 animate-fade-in-down">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    <div class="head-btn-wrapper flex justify-between items-end px-3 mt-8">
        <h1 class="font-medium text-base text-primary">Total data pesanan saat ini : {{ $jmlPesanan }}</h1>
        {{-- <a href="{{ route('admin.create-menu') }}"
            class="w-max text-sm rounded-lg py-3 px-6 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white hover:text-white">
            <button>Tambah Menu</button>
        </a> --}}
    </div>
    <div class="relative overflow-x-auto shadow-sm border border-slate-100 rounded-2xl bg-white">
        <table class="w-full text-sm text-left text-slate-600">
            <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">No</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Tanggal Pesan</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Pelanggan</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Menu</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Porsi</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Total</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Pengambilan</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Alamat</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Pembayaran</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Bukti</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Tgl Kirim</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Status</th>
                    <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach ($pesanan as $pesanan)
                            <tr class="hover:bg-slate-50/50 transition-colors group text-xs md:text-sm">
                                <td class="px-6 py-4 text-center font-bold text-slate-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-500">
                                    {{ $pesanan['created_date'] }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $pesanan['foto_profile'] ? asset('storage/' . $pesanan['foto_profile']) : asset('images/default-pfp-cust-single.png') }}"
                                            alt="profile" class="w-8 h-8 rounded-full object-cover border border-slate-100 shadow-sm">
                                        <span class="font-bold text-slate-800 whitespace-nowrap">{{ $pesanan['name'] }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 min-w-[15rem]">
                                    <p class="line-clamp-2 text-slate-500 leading-relaxed">
                                        {{ implode(', ', $pesanan['menus']) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-slate-800">
                                    {{ implode(', ', $pesanan['portions']) }}
                                </td>
                                <td class="px-6 py-4 font-black text-primary whitespace-nowrap">
                                    <span
                                        class="text-[10px] font-bold mr-0.5">Rp</span>{{ number_format($pesanan['total_price'], 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $pesanan['pickup_method'] == 'Delivery' ? 'bg-blue-50 text-blue-600' : 'bg-slate-100 text-slate-600' }}">
                                        {{$pesanan['pickup_method']}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 min-w-[20rem]">
                                    <p class="line-clamp-2 text-slate-500 text-xs">
                                        {{ $pesanan['pickup_method'] == 'Delivery' ? $pesanan['address'] : '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-600">
                                    {{$pesanan['payment_method']}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($pesanan['payment_method'] !== 'Cash' && !$pesanan['payment_proof'])
                                        <span class="text-[10px] font-bold text-red-400 uppercase">Belum Kirim</span>
                                    @elseif($pesanan['payment_method'] === 'Cash')
                                        <span class="text-slate-300">-</span>
                                    @else
                                        <div class="relative inline-block group/img">
                                            <img src="{{ Storage::url('payment_proofs/' . $pesanan['payment_proof']) }}" alt="Bukti"
                                                class="w-10 h-10 object-cover rounded-lg border border-slate-100 shadow-sm transition-transform group-hover/img:scale-150 group-hover/img:z-10">
                                            @if($pesanan['status_payment_proof'] == 'Accepted')
                                                <div class="absolute -top-2 -right-2 bg-emerald-500 text-white rounded-full p-0.5 shadow-sm">
                                                    <iconify-icon icon="lucide:check" class="text-[10px]"></iconify-icon>
                                                </div>
                                            @elseif($pesanan['status_payment_proof'] == 'Rejected')
                                                <div class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-0.5 shadow-sm">
                                                    <iconify-icon icon="lucide:x" class="text-[10px]"></iconify-icon>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                                    {{ $pesanan['delivery_date'] ? \Carbon\Carbon::parse($pesanan['delivery_date'])->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusClasses = [
                                            'Pending' => 'bg-slate-100 text-slate-500',
                                            'Processed' => 'bg-amber-50 text-amber-600',
                                            'Completed' => 'bg-emerald-50 text-emerald-600',
                                            'Cancelled' => 'bg-red-50 text-red-600',
                                        ];
                                        $currentStatus = $pesanan['status'] ?? 'Pending';
                                    @endphp
                     <span
                                        class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusClasses[$currentStatus] ?? $statusClasses['Pending'] }}">
                                        {{ $currentStatus }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('pesanan.edit', $pesanan['id']) }}"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-all">
                                            <iconify-icon icon="lucide:edit-3" class="text-base"></iconify-icon>
                                        </a>
                                        <form action="{{ route('pesanan.destroy', $pesanan['id']) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-500 hover:text-white transition-all">
                                                <iconify-icon icon="lucide:trash-2" class="text-base"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection