@extends('layouts.cust')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold mb-6 text-center">Detail Pesanan</h2>

    <div class="flex flex-wrap lg:flex-nowrap gap-8">
        <!-- Bagian Kiri: Detail Pesanan -->
        <div class="w-full lg:w-2/3 bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-xl font-semibold mb-4">Keterangan Menu yang Dipesan</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                <table class="min-w-full bg-white rounded-lg">
                    <thead class="bg-gray-200 text-gray-600 font-medium">
                        <tr>
                            <th class="py-2 px-4 text-left">No.</th>
                            <th class="py-2 px-4 text-left">Menu</th>
                            <th class="py-2 px-4 text-left">Foto</th>
                            <th class="py-2 px-4 text-center">Jumlah</th>
                            <th class="py-2 px-4 text-right">Harga</th>
                            <th class="py-2 px-4 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($cartItems as $index => $item)
                            @if($item->menu)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4">{{ $item->menu->nama_menu }}</td>
                                    <td class="py-2 px-4">
                                        <img src="{{ Storage::url($item->menu->foto_menu) }}" alt="{{ $item->menu->nama_menu }}" class="w-16 h-16 object-cover rounded">
                                    </td>
                                    <td class="py-2 px-4 text-center">{{ $item->jumlah }} porsi</td>
                                    <td class="py-2 px-4 text-right">Rp. {{ number_format($item->menu->harga, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 text-right">Rp. {{ number_format($item->jumlah * $item->menu->harga, 0, ',', '.') }}</td>
                                </tr>
                            @else
                                <tr class="border-b">
                                    <td class="py-2 px-4" colspan="6">Item tidak ditemukan.</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium mb-2">Ongkos Kirim</h3>
                <p id="shipping_cost">Rp. 0</p>
            </div>
            <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium mb-2">Total Pesanan</h3>
                <p id="total_cost">Rp. {{ number_format($cartItems->sum(function($item) { return $item->jumlah * $item->menu->harga; }), 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Bagian Kanan: Form -->
        <div class="w-full lg:w-1/3 bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('order.process') }}" method="POST">
                @csrf

                <!-- Metode Pembayaran -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2">Metode Pembayaran</h3>
                    <select name="payment_method" class="w-full p-3 border border-gray-300 rounded">
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="cash_on_delivery">Bayar di Tempat</option>
                    </select>
                </div>

                <!-- Metode Pengambilan -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2">Metode Pengambilan</h3>
                    <select name="pickup_method" id="pickup_method" class="w-full p-3 border border-gray-300 rounded">
                        <option value="pickup">Ambil di Tempat</option>
                        <option value="delivery">Dikirim ke Lokasi</option>
                    </select>
                </div>

                <!-- Alamat Pengiriman -->
                <div class="mb-6" id="delivery_address_section" style="display: none;">
                    <h3 class="text-lg font-medium mb-2">Alamat Pengiriman</h3>
                    <input type="text" name="delivery_address" class="w-full p-3 border border-gray-300 rounded" placeholder="Masukkan Alamat Pengiriman">
                </div>

                <!-- Tombol Proses Pesanan dan Batal -->
                <div class="flex justify-center gap-4">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">Proses Pesanan</button>
                    <a href="{{ route('customer.keranjang') }}" class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('pickup_method').addEventListener('change', function() {
    var deliveryAddressSection = document.getElementById('delivery_address_section');
    var shippingCost = document.getElementById('shipping_cost');
    var totalCost = document.getElementById('total_cost');
    var initialTotal = {{ $cartItems->sum(function($item) { return $item->jumlah * $item->menu->harga; }) }};
    var deliveryFee = 20000; // Contoh ongkir

    if (this.value === 'delivery') {
        deliveryAddressSection.style.display = 'block';
        shippingCost.textContent = 'Rp. ' + deliveryFee.toLocaleString('id-ID');
        totalCost.textContent = 'Rp. ' + (initialTotal + deliveryFee).toLocaleString('id-ID');
    } else {
        deliveryAddressSection.style.display = 'none';
        shippingCost.textContent = 'Rp. 0';
        totalCost.textContent = 'Rp. ' + initialTotal.toLocaleString('id-ID');
    }
});
</script>
@endsection
