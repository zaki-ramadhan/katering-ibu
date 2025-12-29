@extends('layouts.admin')

@section('title', 'Data Menu - Admin')

@section('vite')
    @vite('resources/js/admin/data-menu.js')
@endsection

@if (session('success'))
    <div id="alert"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white shadow-xl text-sm px-6 py-3 rounded-xl z-[100] flex items-center justify-center gap-2 animate-fade-in-down">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    <div class="head-btn-wrapper flex justify-between items-end px-3 mt-8">
        <h1 class="font-medium text-base text-primary">Total data menu saat ini : {{ $jumlahMenu }}</h1>
        <a href="{{ route('admin.create-menu') }}"
            class="w-max text-sm rounded-lg py-3 px-6 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white hover:text-white">
            <button>Tambah Menu</button>
        </a>
    </div>
    <div class="relative overflow-x-auto shadow-sm border border-slate-100 rounded-2xl bg-white">
        @if($menu->isEmpty())
            <div class="py-10 px-6 flex flex-col items-center justify-center gap-4 text-slate-500">
                <iconify-icon icon="lucide:package-open" class="text-6xl text-slate-200"></iconify-icon>
                <span class="text-sm font-medium">Tidak ada data menu yang tersedia. Silahkan tambahkan menu pertama
                    Anda.</span>
            </div>
        @else
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">No</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Foto Menu</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Nama Menu</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Deskripsi</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Harga / Porsi</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($menu as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 font-bold text-slate-400">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto Menu"
                                    class="w-16 h-16 object-cover rounded-xl border border-slate-100 shadow-sm">
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $item->nama_menu }}
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="truncate text-slate-500">{{ $item->deskripsi }}</p>
                            </td>
                            <td class="px-6 py-4 font-black text-primary">
                                <span class="text-xs font-bold mr-0.5">Rp</span>{{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('menu.edit', $item->id) }}"
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-all">
                                        <iconify-icon icon="lucide:edit-3" class="text-lg"></iconify-icon>
                                    </a>
                                    <form action="{{ route('menu.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-500 hover:text-white transition-all">
                                            <iconify-icon icon="lucide:trash-2" class="text-lg"></iconify-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $menu->links() }}
@endsection