@extends('layouts.cust')

@section('title', 'Detail Pembayaran Pesanan')

@section('vite')
    @vite('resources/js/customer/detail-pembayaran.js')
@endsection

@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="bg-white p-10 rounded-xl shadow-md shadow-slate-200/50 border">
            <h2 class="text-2xl font-semibold text-primary mb-8">Detail Pembayaran Pesanan</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium text-primary">Pesanan ID:</h3>
                        <p class="text-sm">{{ $pesanan->id }}</p>
                    </div>
                    <div>
                        <h3 class="font-medium text-primary">Tanggal Memesan:</h3>
                        <p class="text-sm">{{ $pesanan->created_at->format('d M Y') }}</p>
                    </div>
                    <div>
                        <h3 class="font-medium text-primary">Detail Menu:</h3>
                        <ul class="list-disc list-inside">
                            @foreach($pesanan->items as $item)
                                <li>{{ $item->menu->nama_menu }} - {{ $item->quantity }} porsi</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-medium text-primary">Total Harga:</h3>
                        <p class="text-sm">Rp {{ number_format($pesanan->total_amount, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <h3 class="font-medium text-primary">Metode Pembayaran:</h3>
                        <p class="text-sm">{{ $pesanan->payment_method }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div id="paymentSection" class="pb-2">
                        <h3 class="font-medium text-primary mb-2">Bukti Pembayaran:</h3>
                        @if($pesanan->payment_proof)
                            <div id="paymentProofContainer" class="w-96 h-auto aspect-video overflow-hidden">
                                <img id="existingPaymentProof" src="{{ Storage::url('payment_proofs/' . $pesanan->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-full object-cover rounded-xl border">
                            </div>
                        @else
                            <p id="noPaymentProof" class="text-red-400 text-sm">Belum ada bukti pembayaran.</p>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-medium text-primary mt-4 -mb-1">Unggah Bukti Pembayaran:</h3>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('pesanan.upload-payment-proof', $pesanan->id) }}" class="space-y-4">
                            @csrf
                            <input type="file" name="payment_proof" id="paymentProofInput" class="block w-max text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer" required>
                            <div class="flex justify-start gap-1 text-sm">
                                <button type="button" onclick="window.history.back()" class="px-6 py-[.7rem] mt-4 text-primary hover:text-primary bg-tertiary-50 hover:border-secondary hover:bg-tertiary border rounded-lg">Batalkan</button>
                                <button type="submit" class="px-10 py-[.7rem] mt-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 active:bg-blue-500">Unggah</button>
                            </div>
                        </form>                                                
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
