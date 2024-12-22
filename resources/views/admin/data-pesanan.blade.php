@extends('layouts.admin')

@section('title', 'Data Pesanan - Admin') 

@section('vite') 
    {{-- @vite('resources/js/admin/data-menu.js') --}}
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
    <div class="relative overflow-x-auto shadow-md shadow-slate-200/60 bg-white border rounded-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Tanggal Memesan</th>
                    <th scope="col" class="px-6 py-3">Nama Pelanggan</th>
                    <th scope="col" class="px-6 py-3">Menu yang Dipesan</th>
                    <th scope="col" class="px-6 py-3">Porsi</th>
                    <th scope="col" class="px-6 py-3">Total Harga</th>
                    <th scope="col" class="px-6 py-3">Metode Pengambilan</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Metode Pembayaran</th>
                    <th scope="col" class="px-6 py-3">Bukti Pembayaran</th>
                    <th scope="col" class="px-6 py-3">Tanggal Pengiriman</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $pesanan)
                    <tr class="bg-white border-b hover:bg-gray-50 text-xs">
                        <td class="px-6 py-4 text-center">
                            {{ $loop -> iteration }}
                        </td>
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ $pesanan['created_date'] }}
                        </td>
                        <td class="px-6 py-4 text-center ">
                            <div class="img-wrapper flex items-center justify-center">
                                <img src="{{ $pesanan['foto_profile'] ? asset('storage/' . $pesanan['foto_profile']) : asset('images/default-pfp-cust-single.png') }}" alt="profile img" class="w-10 h-10 object-cover rounded-full mr-3">
                                <span>{{ $pesanan['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-left  text-xs min-w-60">
                            <div class="line-clamp-2">
                                {{ implode(', ', $pesanan['menus']) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ implode(', ', $pesanan['portions']) }}
                        </td>
                        <td class="px-6 py-4 text-center min-w-40">
                            Rp. {{ number_format($pesanan['total_price'], 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{$pesanan['pickup_method']}}
                        </td>
                        <td class="px-6 py-4 {{ $pesanan['pickup_method'] == 'Delivery' ? 'text-left' : 'text-center'}} min-w-80">
                            {{ $pesanan['pickup_method'] == 'Delivery' ? $pesanan['address'] : '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($pesanan['payment_method'] == 'Transfer')
                                Transfer
                            @elseif ($pesanan['payment_method'] == 'Cash')
                                Bayar langsung
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center min-w-44">
                            @if($pesanan['payment_method'] !== 'Cash' && !$pesanan['payment_proof'])
                                <div class="text-red-300">
                                    Bukti pembayaran belum dikirim.
                                </div>
                            @elseif($pesanan['payment_method'] === 'Cash')
                                <p>-</p>
                            @else
                                <div class="flex justify-center">
                                    <img src="{{ Storage::url('payment_proofs/' . $pesanan['payment_proof']) }}" alt="Bukti Pembayaran" class="w-24 h-24 object-cover rounded-md border">
                                </div>
                            @endif
                        </td>                        
                        <td class="px-6 py-4 text-center">
                            {{ $pesanan['delivery_date'] ? \Carbon\Carbon::parse($pesanan['delivery_date'])->format('d M Y') : '-' }}
                        </td>                        
                        <td class="px-6 py-4 text-center">
                            @if($pesanan['status'] == 'Pending')
                            <span class="py-2 px-3 rounded-full bg-amber-50 text-amber-300">
                                {{ $pesanan['status'] }}
                            </span>
                            @elseif($pesanan['status'] == 'Processed')
                            <span class="py-2 px-3 rounded-full bg-emerald-50 text-emerald-300">
                                {{ $pesanan['status'] }}
                            </span>
                            @elseif($pesanan['status'] == 'Completed')
                            <span class="py-2 px-3 rounded-full bg-blue-50 text-blue-300">
                                {{ $pesanan['status'] }}
                            </span>
                            @elseif($pesanan['status'] == 'Cancelled')
                            <span class="py-2 px-3 rounded-full bg-red-50 text-red-300">
                                {{ $pesanan['status'] }}
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="button-wrapper flex gap-1 items-center">
                                {{-- @if(!($pesanan['status'] == 'Canceled' || $pesanan['status'] == 'Completed' || $pesanan['status'] == 'Processed')) --}}
                                <a href="{{ route('pesanan.edit', $pesanan['id']) }}" class="font-medium min-w-9 aspect-square grid place-content-center rounded-md text-white bg-amber-300 hover:bg-amber-400 active:bg-amber-300">
                                    <iconify-icon icon="lucide:edit" width="20" height="20"></iconify-icon>
                                </a>
                            {{-- @endif --}}
                            
                            {{-- @if(!($pesanan['status'] == 'Pending' || $pesanan['status'] == 'Processed')) --}}
                            <form action="{{ route('pesanan.destroy', $pesanan['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan dengan id = {{$pesanan['id']}} ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium min-w-9 aspect-square grid place-content-center rounded-md text-white bg-red-400 hover:bg-red-500 active:bg-red-400">
                                        <iconify-icon icon="weui:delete-filled" width="22" height="22"></iconify-icon>
                                    </button>
                                </form>
                            </div>
                            {{-- @endif --}}
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection