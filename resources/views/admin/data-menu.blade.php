@extends('layouts.admin')

@section('title', 'Data Menu - Admin') 

@section('vite') 
    @vite('resources/js/admin/data-menu.js')
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    <div class="head-btn-wrapper flex justify-end items-center px-3 mt-8">
        {{-- <h1 class="font-medium text-lg text-primary">Jumlah data menu saat ini : {{ $jumlahMenu }}</h1> --}}
        
        <a href="{{ route('admin.create-menu') }}" class="w-max text-sm rounded-lg py-3 px-6 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white hover:text-white">
            <button>Tambah Menu</button>
        </a>
    </div>
    <div class="relative overflow-x-auto shadow-lg mt-3 shadow-slate-200 border rounded-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-6 border-b">
                        Id
                        </th>
                    <th scope="col" class="px-6 py-6 border-b">
                        Foto Menu
                    </th>
                    <th scope="col" class="px-6 py-6 border-b">
                        Nama Menu
                    </th>
                    <th scope="col" class="px-6 py-6 border-b">
                        Deskripsi Menu
                    </th>
                    <th scope="col" class="px-6 py-6 border-b">
                        Harga per porsi
                    </th>
                    <th scope="col" class="text-center px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menu as $item)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <!-- Menampilkan nama_menu -->
                    <td class="px-6 py-4">
                        {{ $item->id }}
                    </td>
                    <!-- Menampilkan foto_menu -->
                    <td class="px-6 py-4">
                        <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto Menu" class="max-w-16 aspects-square object-cover rounded-lg">
                    </td>

                    <!-- Menampilkan nama_menu -->
                    <td class="px-6 py-4">
                        {{ $item->nama_menu }}
                    </td>

                    <!-- Menampilkan deskripsi -->
                    <td class="px-6 py-4 min-w-60">
                        {{ Str::limit($item->deskripsi, 50) }} <!-- Menampilkan deskripsi dengan batasan 50 karakter -->
                    </td>

                    <!-- Menampilkan harga -->
                    <td class="px-6 py-4">
                        {{ number_format($item->harga, 0, ',', '.') }} <!-- Format harga dengan pemisah ribuan -->
                    </td>

                    <!-- Kolom aksi (Edit dan Hapus) -->
                    <td class="px-6 py-4 text-center flex flex-col items-end justify-end gap-2">

                        <!-- Tombol Edit -->
                        <a href="{{ route('menu.edit', $item->id) }}" class="edit-btn font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-amber-400 hover:bg-amber-300 active:bg-amber-400 hover:no-underline hover:text-white">Edit</a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn font-medium px-4 py-2 rounded-md w-max min-w-20 text-white bg-red-500 hover:bg-red-400 active:bg-red-500 hover:no-underline hover:text-white">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection