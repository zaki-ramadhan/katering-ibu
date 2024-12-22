@extends('layouts.admin')

@section('title', 'Edit Status dan Tanggal Pengiriman Pesanan Pelanggan') 

@section('vite')
    @vite('resources/js/admin/edit-pesanan.js')
@endsection

@section('content')
<div class="container mx-auto px-4 lg:px-8 py-8">
    <div class="bg-white p-10 rounded-2xl shadow-md shadow-slate-200/50 border">
        <h2 class="text-2xl font-semibold text-primary mb-8">Edit Pesanan Pelanggan</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-4">
                <div>
                    <h3 class="font-medium text-lg text-primary mb-4">Informasi Pelanggan</h3>
                    <div class="flex items-center">
                        <img src="{{ $pesanan->user->foto_profile ? asset('storage/' . $pesanan->user->foto_profile) : asset('images/default-pfp-cust-single.png') }}" alt="Profile Image" class="w-16 h-16 object-cover rounded-full mr-4">
                        <div>
                            <p class="text-gray-800 font-medium">{{ $pesanan->user->name }}</p>
                            <p class="text-gray-600 text-sm">{{ $pesanan->user->email }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="font-medium text-lg text-primary mt-8">Detail Pesanan :</h3>
                    <div class="mt-3 flex flex-col gap-3 text-sm">
                        <p><span class="text-primary">Tanggal Memesan :</span> {{ $pesanan->created_at->format('d M Y') }}</p>
                        <p><span class="text-primary">Metode Pembayaran :</span> {{ $pesanan->payment_method }}</p>
                        <p><span class="text-primary">Metode Pengambilan :</span> {{ $pesanan->pickup_method == 'pickup' ? 'Ambil Langsung' : 'Kirim ke Lokasi saya' }}</p>
                        @if ($pesanan->pickup_method == 'delivery')
                            <div class="address-wrapper flex items-start gap-2">
                                <p class="text-primary min-w-max">Alamat Pengiriman :</p>
                                <span>{{ $pesanan->delivery_address }}</span>
                            </div>
                        @endif
                        <p class="font-semibold text-primary"><span class="text-sm font-normal text-primary">Total Harga :</span> Rp. {{ number_format($pesanan->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div>
                    <h3 class="font-medium text-primary mt-8">Bukti Pembayaran :</h3>
                    @if($pesanan->payment_method == 'Cash')
                        <p>-</p>
                    @elseif($pesanan->payment_proof)
                        <div id="paymentProofContainer" class="w-72 h-auto aspect-video overflow-hidden mt-2 mb-3 cursor-pointer">
                            <img id="existingPaymentProof" src="{{ Storage::url('payment_proofs/' . $pesanan->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-full object-cover rounded-md border">
                        </div>
                        <span class="text-xs mt-10 text-red-400">*Klik pada foto untuk melihat bukti pembayaran lebih jelas.</span>
                    @else
                        <p class="text-red-400 text-sm mt-2">Belum ada bukti pembayaran.</p>
                    @endif
                </div>
                
                <!-- Modal -->
                <div id="imageModal" class="fixed -top-5 py-7 left-0 w-full h-[101vh] bg-black/40 backdrop-blur-sm hidden justify-center items-center z-50">
                    <iconify-icon icon="ic:baseline-close" width="28" height="28" id="iconCloseModal" class="absolute top-9 right-9 text-slate-200 hover:text-white active:text-slate-200 hover:scale-110 active:scale-90 cursor-pointer transition-all ease-in-out duration-150"></iconify-icon>
                    <div class="relative bg-white rounded-lg shadow-lg p-4 max-w-xl w-full h-full max-h-screen overflow-auto">
                        <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full h-auto">
                    </div>
                </div>                
            </div>                

            <div class="space-y-4">
                <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="max-w-72">
                        <h3 class="font-medium text-primary">Status Pesanan</h3>
                        <select id="status" name="status" class="mt-1 block w-full px-3 py-2 focus:text-primary border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            <option value="Pending" {{ $pesanan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Processed" {{ $pesanan->status == 'Processed' ? 'selected' : '' }}>Processed</option>
                            <option value="Completed" {{ $pesanan->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ $pesanan->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-8">
                        @if ($pesanan['payment_method'] !== 'Cash')
                        <h3 class="font-medium text-primary">Tanggal Pengiriman</h3>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-4">
                                    <input type="text" id="delivery_date" name="delivery_date" value="{{ $pesanan->delivery_date ? \Carbon\Carbon::parse($pesanan->delivery_date)->format('d-m-Y') : '' }}" class="mt-1 w-72 px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                    <button type="button" id="set-today" class="px-7 text-xs py-[.7rem] h-max min-w-max bg-slate-500 hover:bg-slate-600 active:bg-slate-500 text-white rounded-md translate-y-[2px]">Hari Ini</button>
                                </div>                                                                
                            </div>                            
                        </div>
                        @endif
                    </div>
                    <div class="flex justify-start gap-1 text-sm">
                        <button type="button" onclick="window.history.back();" class="px-6 py-[.7rem] mt-4 text-primary hover:text-primary bg-tertiary-50 hover:border-secondary hover:bg-tertiary border rounded-lg">Batalkan</button>
                        <button type="submit" class="px-6 py-[.7rem] mt-4 bg-emerald-400 text-white rounded-lg hover:bg-emerald-500 active:bg-emerald-400">Update Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
