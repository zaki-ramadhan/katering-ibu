@extends('layouts.app')

@section('content')
<div class="container mx-auto my-8 px-4 lg:px-8">
    <h2 class="text-2xl font-semibold mb-6">Keranjang Belanja</h2>

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
                            <td class="py-3 px-4 text-right">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-right">Rp{{ number_format($item->total_harga_item, 0, ',', '.') }}</td>
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
    @else
        <p class="text-center mt-8 text-gray-600">Keranjang Anda kosong.</p>
    @endif
</div>
@endsection
