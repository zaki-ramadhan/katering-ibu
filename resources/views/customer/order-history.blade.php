@extends('layouts.cust')

@section('title', 'Riwayat Pesanan Saya') 

@section('vite') 
    @vite(['resources/js/profile.js', 'resources/js/components/sidebar-cust.js', 'resources/js/components/header-cust.js'])
@endsection

@section('style')
    <style>
        .cover {
            background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='80' height='80' patternTransform='scale(2) rotate(0)'><rect x='0' y='0' width='100%' height='100%' fill='%23334155ff'/><path d='M0 0v40h40V0H0zm40 40v40h40V40H40zM4 4h32v32H4V4zm4 4v24h24V8H8zm4 4h16v16H12V12zm4.043 3.988v8.004h8.004v-8.004h-8.004zM44 44h32v32H44V44zm4 4v24h24V48H48zm4 4h16v16H52V52zm4.043 3.984v8.006h8.004v-8.006h-8.004z'  stroke-width='1' stroke='none' fill='%23cbd5e1ff'/><path d='M44 4v32h32V4H44zm4 4h24v24H48V8zm4 4v16h16V12H52zm4 4h8v8h-8v-8zM4 44v32h32V44H4zm4 4h24v24H8V48zm4 4v16h16V52H12zm4 4h8v8h-8v-8z'  stroke-width='1' stroke='none' fill='%2394a3b8ff'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>")
        }
    </style>
@endsection

@section('content')
    <section id="hero-section" class="container px-10 py-16">
        <h1 class="font-semibold text-primary text-4xl leading-10">Kelola dan pantau riwayat pesanan Anda dengan mudah.</h1>
        <p class="text-sm leading-6 w-4/6 mt-4">Lihat semua pesanan Anda sebelumnya, pantau status terkini, dan kelola dengan mudah.</p>
    </section>
    <div class="relative overflow-x-auto shadow-lg shadow-slate-200 border rounded-2xl">
        {{-- <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tanggal memesan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Menu yang Dipesan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Porsi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Metode Pengambilan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Metode Pembayaran
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $order)
                    <tr class="bg-white border-b hover:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $order['created_date'] }}    
                        </th>
                        <td class="px-6 py-4">
                            {{ implode(', ', $order['menus']) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ implode(', ', $order['portions']) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ number_format($order['total_price'], 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $order['pickup_method'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order['pickup_method'] == 'Kirim' ? $order['address'] : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order['payment_method'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order['status'] }}
                        </td>
                        <td class="px-6 py-4 text-center flex flex-col items-end justify-end gap-2">
                            <a href="#" class="font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-amber-400  hover:bg-amber-300 active:bg-amber-400">Edit</a>
                            <a href="#" class="font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-red-500 hover:bg-red-400 active:bg-red-500">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    </div>
@endsection