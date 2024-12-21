@extends('layouts.cust')

@section('title', 'Detail Pembayaran Pesanan')

@section('vite') 
    @vite('resources/js/customer/detail-pembayaran.js')
@endsection

@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Detail Pembayaran Pesanan</h2>
            <div class="flex flex-col gap-4">
                <div>
                    <h3 class="text-lg font-medium">Pesanan ID: {{ $pesanan->id }}</h3>
                    <p class="text-sm">Tanggal Memesan: {{ $pesanan->created_at->format('d M Y') }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium">Detail Menu:</h3>
                    <ul class="list-disc list-inside">
                        @foreach($pesanan->items as $item)
                            <li>{{ $item->menu->nama_menu }} - {{ $item->quantity }} porsi</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-medium">Total Harga:</h3>
                    <p class="text-sm">Rp {{ number_format($pesanan->total_amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium">Metode Pembayaran:</h3>
                    <p class="text-sm">{{ $pesanan->payment_method }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium">Bukti Pembayaran:</h3>
                    @if($pesanan->payment_proof)
                        <img src="{{ asset('uploads/payment_proofs/' . $pesanan->payment_proof) }}" alt="Bukti Pembayaran" class="w-64 h-auto" id="existingPaymentProof">
                    @else
                        <p class="text-red-500">Belum ada bukti pembayaran.</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-lg font-medium">Unggah Bukti Pembayaran:</h3>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('pesanan.upload-payment-proof', $pesanan->id) }}">
                        @csrf
                        <input type="file" name="payment_proof" id="paymentProofInput" required>
                        <img id="paymentProofPreview" class="w-64 h-auto mt-2 hidden">
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Unggah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
