@extends('layouts.admin')

@section('title', 'Edit Status dan Tanggal Pengiriman Pesanan Pelanggan') 

@section('vite')
    @vite('resources/js/admin/edit-pesanan.js')
    <!-- jQuery -->
@endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


@section('content')
<div class="container mx-auto px-4 lg:px-8">
    <div class="bg-white p-6 shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-6">Edit Pesanan</h1>
        <div class="mb-4 p-4 bg-gray-50 rounded-lg shadow-inner">
            <h2 class="text-lg font-medium text-gray-700 mb-2">Informasi Pelanggan</h2>
            <div class="flex items-center mb-4">
                <img src="{{ $pesanan->user->foto_profile ? asset('storage/' . $pesanan->user->foto_profile) : asset('images/default-pfp-cust-single.png') }}" alt="Profile Image" class="w-16 h-16 object-cover rounded-full mr-4">
                <div>
                    <p class="text-gray-800 font-medium">{{ $pesanan->user->name }}</p>
                    <p class="text-gray-600 text-sm">{{ $pesanan->user->email }}</p>
                </div>
            </div>
            <h2 class="text-lg font-medium text-gray-700 mb-2">Detail Pesanan</h2>
            <div class="mb-4">
                <p class="text-gray-700"><span class="font-medium">Tanggal Memesan:</span> {{ $pesanan->created_at->format('d M Y') }}</p>
                <p class="text-gray-700"><span class="font-medium">Metode Pembayaran:</span> {{ $pesanan->payment_method }}</p>
                <p class="text-gray-700"><span class="font-medium">Metode Pengambilan:</span> {{ $pesanan->pickup_method == 'pickup' ? 'Ambil Langsung' : 'Kirim ke Lokasi saya' }}</p>
                @if ($pesanan->pickup_method == 'delivery')
                    <p class="text-gray-700"><span class="font-medium">Alamat Pengiriman:</span> {{ $pesanan->delivery_address }}</p>
                @endif
                <p class="text-gray-700"><span class="font-medium">Total Harga:</span> {{ number_format($pesanan->total_amount, 0, ',', '.') }}</p>
            </div>
            <h2 class="text-lg font-medium text-gray-700 mb-2">Menu yang Dipesan</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach ($pesanan->items as $item)
                    <li>{{ $item->menu->nama_menu }} - {{ $item->quantity }} porsi</li>
                @endforeach
            </ul>
        </div>
        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status Pesanan</label>
                <select id="status" name="status" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="Pending" {{ $pesanan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Processed" {{ $pesanan->status == 'Processed' ? 'selected' : '' }}>Processed</option>
                    <option value="Completed" {{ $pesanan->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $pesanan->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="mb-8">
                <label for="delivery_date" class="block text-sm font-medium text-gray-700">Tanggal Pengiriman</label>
                <div class="flex items-center">
                    <input type="text" id="delivery_date" name="delivery_date" value="{{ $pesanan->delivery_date ? $pesanan->delivery_date : '' }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <button type="button" id="set-today" class="ml-2 px-4 py-2 bg-emerald-400 hover:bg-emerald-500 text-white rounded-md">Hari Ini</button>
                </div>
                <x-flat-picker name="admission_date"></x-flat-picker>
            </div>
                       
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 text-sm bg-emerald-400 hover:bg-emerald-500 active:bg-emerald-400 text-white rounded-md">Update Pesanan</button>
            </div>
        </form>
    </div>
</div>
@endsection