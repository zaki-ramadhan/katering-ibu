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
    <div class="head-btn-wrapper flex justify-between items-end px-3 mt-8">
        <h1 class="font-medium text-base text-primary">Total data menu saat ini : {{ $jumlahMenu }}</h1>
        <a href="{{ route('admin.create-menu') }}" class="w-max text-sm rounded-lg py-3 px-6 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white hover:text-white">
            <button>Tambah Menu</button>
        </a>
    </div>
    <div class="relative overflow-x-auto shadow-md shadow-slate-200/60 border rounded-2xl">
        @if($menu->isEmpty())
        <div class="py-5 px-6 flex items-center justify-start gap-2 bg-yellow-200 text-primary rounded-sm text-sm">
            <iconify-icon icon="mingcute:warning-line" class="text-2xl"></iconify-icon>
            <span>Tidak ada data menu yang tersedia. Silahkan tambahkan menu pertama Anda.</span>
          </div>
        @else
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="p-6 border-b border-e">no</th>
                    <th scope="col" class="p-6 border-b">Foto Menu</th>
                    <th scope="col" class="p-6 border-b">Nama Menu</th>
                    <th scope="col" class="p-6 border-b">Deskripsi</th>
                    <th scope="col" class="p-6 border-b">Harga per porsi</th>
                    <th scope="col" class="text-center px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menu as $index => $item)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-2 border-e">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-2">
                        <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto Menu" class="max-w-16 aspects-square object-cover rounded-lg">
                    </td>
                    <td class="px-6 py-2 max-w-40">
                        {{ $item->nama_menu }}
                    </td>
                    <td class="px-6 py-2 min-w-60">
                        {{ Str::limit($item->deskripsi, 50) }} <!-- Menampilkan deskripsi dengan batasan 50 karakter -->
                    </td>
                    <td class="px-6 py-2">
                        Rp. {{ number_format($item->harga, 0, ',', '.') }} <!-- Format harga dengan pemisah ribuan -->
                    </td>
                    <td class="px-6 py-4 text-center flex gap-1 items-center">
                        <a href="{{ route('menu.edit', $item->id) }}" class="edit-btn min-w-9 aspect-square grid place-content-center rounded-md text-white bg-amber-300 hover:bg-amber-400 active:bg-amber-300">
                            <iconify-icon icon="lucide:edit" width="20" height="20"></iconify-icon>
                        </a>
                        <form action="{{ route('menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn min-w-9 aspect-square grid place-content-center rounded-md text-white bg-red-400 hover:bg-red-500 active:bg-red-400">
                                <iconify-icon icon="weui:delete-filled" width="22" height="22"></iconify-icon>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
    {{ $menu->links() }}
@endsection