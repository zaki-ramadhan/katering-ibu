@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Keranjang Belanja</h2>

    @if ($keranjang && $keranjang->items->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keranjang->items as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->total_harga_item }}</td>
                        <td>
                            <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total: Rp{{ $keranjang->total_harga }}</h3>
    @else
        <p>Keranjang Anda kosong.</p>
    @endif
</div>
@endsection
