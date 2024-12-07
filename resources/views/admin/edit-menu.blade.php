@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-2xl font-semibold leading-tight">Edit Menu {{$menu->nama_menu}}</h2>

        <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')
            <div class="menu-img-wrapper mb-4">
                <label class="block text-sm font-medium text-gray-700">Foto Menu</label>
                @if ($menu->foto_menu)
                    <img src="{{ asset('storage/' . $menu->foto_menu) }}" alt="Current Menu Photo" class="mt-2 h-32 w-32 object-cover">
                @endif
                <input type="file" name="foto_menu" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
            </div>

            <div class="menu-name-wrapper mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Menu</label>
                <input type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
            </div>

            <div class="menu-desc-wrapper mb-4">
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
            </div>

            <div class="menu-price-wrapper mb-4">
                <label class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
            </div>


            <div class="flex items-center justify-end gap-2">
                <button type="button" onclick="window.history.back();" class="px-4 py-2 border rounded-lg hover:text-primary hover:border-secondary hover:bg-tertiary">Batalkan</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-700">Perbarui Menu</button>
            </div>
        </form>
    </div>
@endsection
