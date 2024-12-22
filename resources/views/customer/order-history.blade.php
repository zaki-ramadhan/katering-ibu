@extends('layouts.cust')

@section('title', 'Riwayat Pesanan Saya') 

@section('vite') 
    @vite('resources/js/customer/order-history.js')
@endsection

@section('style')
    <style>
        .cover {
            background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='80' height='80' patternTransform='scale(2) rotate(0)'><rect x='0' y='0' width='100%' height='100%' fill='%23334155ff'/><path d='M0 0v40h40V0H0zm40 40v40h40V40H40zM4 4h32v32H4V4zm4 4v24h24V8H8zm4 4h16v16H12V12zm4.043 3.988v8.004h8.004v-8.004h-8.004zM44 44h32v32H44V44zm4 4v24h24V48H48zm4 4h16v16H52V52zm4.043 3.984v8.006h8.004v-8.006h-8.004z'  stroke-width='1' stroke='none' fill='%23cbd5e1ff'/><path d='M44 4v32h32V4H44zm4 4h24v24H48V8zm4 4v16h16V12H52zm4 4h8v8h-8v-8zM4 44v32h32V44H4zm4 4h24v24H8V48zm4 4v16h16V52H12zm4 4h8v8h-8v-8z'  stroke-width='1' stroke='none' fill='%2394a3b8ff'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>")
        }
    </style>
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
<div class="relative overflow-x-auto">
    @if($data->isEmpty())
    <div class="p-6 text-center text-gray-500">
        <h3 class="text-lg font-medium">Belum ada pesanan</h3>
        <p class="mt-2">Anda belum pernah melakukan pesanan. Ayo lakukan pesanan sekarang!</p>
        <a href="{{ route('menu') }}" class="mt-4 inline-block px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark">Pesan Sekarang</a>
    </div>
    @else
    <section id="hero-section" class="container flex justify-between items-end px-10 py-16">
        <div class="text-wrapper">
            <h1 class="font-semibold text-primary text-4xl leading-10">Riwayat pesanan saya.</h1>
            <p class="text-sm leading-6 mt-2">Lihat semua pesanan Anda sebelumnya, pantau status terkini, dan kelola dengan mudah.</p>
        </div>
        <a href="{{route('menu')}}" class="px-4 py-3 rounded-md text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-500 text-xs">Buat Pesanan Lagi</a>
    </section>
    <div class="container mx-auto px-4 lg:px-8 -mt-6">
        <div class="relative overflow-x-auto border rounded-2xl">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Tgl memesan</th>
                        <th scope="col" class="px-6 py-3">Menu yang Dipesan</th>
                        <th scope="col" class="px-6 py-3">Jumlah Porsi</th>
                        <th scope="col" class="px-6 py-3 min-w-40">Total Harga</th>
                        <th scope="col" class="px-6 py-3">Metode Pengambilan</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                        <th scope="col" class="px-6 py-3">Metode Pembayaran</th>
                        <th scope="col" class="px-6 py-3">Bukti Pembayaran</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $pesanan)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$loop->iteration}}
                            </th>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $pesanan['created_date'] }}
                            </td>
                            <td class="px-6 py-4 min-w-60">
                                <div class="line-clamp-2">
                                    {{ implode(', ', $pesanan['menus']) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ implode(', ', $pesanan['portions']) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                Rp. {{ number_format($pesanan['total_price'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($pesanan['pickup_method'] == 'Pickup')
                                    Ambil langsung
                                @elseif ($pesanan['pickup_method'] == 'Delivery')
                                    Kirim ke lokasi saya
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 min-w-72">
                                <div class="line-clamp-2 {{ ($pesanan['address'] == null ? 'text-center' : '') }}">
                                    {{ $pesanan['pickup_method'] == 'Delivery' ? $pesanan['address'] : '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $pesanan['payment_method'] }}
                            </td>
                            <td class="px-6 py-2 text-center min-w-56">
                                @if($pesanan['payment_method'] == 'Cash')
                                    <span>-</span>
                                @elseif(!$pesanan['payment_proof'])
                                    <div class="text-red-500 text-xs">
                                        Anda belum mengunggah bukti pembayaran.<br>
                                        <a href="{{ route('pesanan.payOrder', $pesanan['id']) }}" class="text-blue-500 hover:underline active:text-blue-600">Unggah Sekarang</a>
                                    </div>
                                @else
                                <div class="flex justify-center items-center">
                                    <img src="{{ Storage::url('payment_proofs/' . $pesanan['payment_proof']) }}" alt="Bukti Pembayaran" class="w-24 h-12 object-cover rounded-md border">
                                    @if($pesanan['status_payment_proof'] == 'Accepted')
                                        <iconify-icon icon="mdi:check-circle" class="text-green-500 text-xl ml-2"></iconify-icon>
                                    @elseif($pesanan['status_payment_proof'] == 'Rejected')
                                        <iconify-icon icon="mdi:alert-circle" class="text-red-500 text-xl ml-2"></iconify-icon>
                                    @endif
                                </div>
                                @endif
                            </td>                                                                                                                
                            <td class="px-6 py-4 text-xs min-w-56 text-center">
                                @if($pesanan['status'] == 'Pending')
                                    <span class="py-2 px-3 rounded-full bg-slate-100 text-slate-500">
                                        Menunggu konfirmasi
                                    </span>
                                @elseif($pesanan['status'] == 'Processed')
                                    <span class="py-2 px-3 rounded-full bg-yellow-50 text-yellow-500">
                                        Sedang diproses
                                    </span>
                                @elseif($pesanan['status'] == 'Completed')
                                    <span class="py-2 px-3 rounded-full bg-emerald-50 text-emerald-500">
                                        Selesai
                                    </span>
                                @elseif($pesanan['status'] == 'Cancelled')
                                    <span class="py-2 px-3 rounded-full bg-red-50 text-red-500">
                                        Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-1">
                                @if ($pesanan['status'] == 'Pending')
                                    <a href="{{ route('pesanan.payOrder', $pesanan['id']) }}" class="min-w-9 aspect-square grid place-content-center rounded-md text-white bg-amber-300 hover:bg-amber-400 active:bg-amber-300">
                                        <iconify-icon icon="lucide:edit" width="20" height="20"></iconify-icon> 
                                    </a>
                                    <form action="{{ route('pesanan.destroy', $pesanan['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="min-w-9 aspect-square grid place-content-center rounded-md text-white bg-red-400 hover:bg-red-500 active:bg-red-400" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                            <iconify-icon icon="weui:delete-filled" width="22" height="22"></iconify-icon>
                                        </button>
                                    </form>
                                @elseif ($pesanan['status'] == 'Completed' || $pesanan['status'] == 'Cancelled')
                                    <form action="{{ route('pesanan.destroy', $pesanan['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="min-w-9 aspect-square grid place-content-center rounded-md text-white bg-red-400 hover:bg-red-500 active:bg-red-400" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                            <iconify-icon icon="weui:delete-filled" width="22" height="22"></iconify-icon>
                                        </button>
                                    </form>
                                @endif
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
