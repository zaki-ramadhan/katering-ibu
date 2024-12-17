@extends('layouts.cust')

@section('title', 'Keranjang Saya') 

@section('vite') 
    @vite(['resources/js/customer/keranjang.js'])
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
<div class="container mx-auto mt-8 px-4 lg:px-8">
    @if ($keranjang && $keranjang->items->count() > 0)
        <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left font-medium w-1/12">No.</th>
                        <th class="py-3 px-4 text-left font-medium w-2/12">Item</th>
                        <th class="py-3 px-4 text-left font-medium w-2/12">Foto</th>
                        <th class="py-3 px-4 text-center font-medium w-2/12">Jumlah</th>
                        <th class="py-3 px-4 text-right font-medium w-2/12">Harga</th>
                        <th class="py-3 px-4 text-right font-medium w-2/12">Total</th>
                        <th class="py-3 px-4 text-center font-medium w-1/12">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    @foreach ($keranjang->items as $index => $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">{{ $item->menu->nama_menu }}</td>
                            <td class="py-3 px-4">
                                <img src="{{ Storage::url($item->menu->foto_menu) }}" alt="{{ $item->menu->nama_menu }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="py-3 px-4 text-center">{{ $item->jumlah }}</td>
                            <td class="py-3 px-4 text-right">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-right">Rp. {{ number_format($item->total_harga_item, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-center">
                                <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <iconify-icon icon="fluent:delete-24-regular" class="text-lg"></iconify-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-6">
            <h3 class="text-lg font-semibold">Total: Rp{{ number_format($keranjang->total_harga, 0, ',', '.') }}</h3>
        </div>
        <div class="flex justify-end mt-4 gap-2 text-sm">
            <a href="{{ route('menu') }}" class="px-6 py-3 bg-slate-600 hover:bg-primary active:bg-slate-600 text-white rounded-lg">Pilih Menu Lagi</a>
            <form action="{{ route('order.detail') }}" method="GET">
                @csrf
                <button type="submit" class="px-6 py-3 bg-green-400 hover:bg-green-500 active:bg-green-400 text-white rounded-lg">Checkout</button>
            </form>
        </div>
        
    @else
        <div class="empty-cart-alert container w-full h-full flex justify-center items-center gap-10 translate-y-10">
            <img src="{{asset('images/empty cart.svg')}}" alt="empty cart svg" class="max-w-96">
            <div class="text-wrapper flex flex-col gap-2">
                <p class="leading-7">Yahh...</p>
                <h2 class="text-3xl font-semibold text-primary">Keranjang Anda masih kosong.</h2>
                <p class="leading-7">Ayo buat pesanan pertama Anda sekarang. Klik "<a href="{{route('menu')}}" class="hover:underline hover:text-primary">Buat Pesanan</a>"<br> untuk memesan menu.</p>
            </div>
        </div>
    @endif
</div>
@endsection
