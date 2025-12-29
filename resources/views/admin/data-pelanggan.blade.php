@extends('layouts.admin')

@section('title', 'Data Pelanggan - Admin')

@section('vite')
    @vite('resources/js/customer/dashboard.js')
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
        <h1 class="font-medium text-base text-primary">Total data pelanggan saat ini : {{ $jumlahPelanggan }}</h1>
    </div>
    <div class="relative overflow-x-auto shadow-sm border border-slate-100 rounded-2xl bg-white">
        @if($pelanggan->isEmpty())
            <div class="py-10 px-6 flex flex-col items-center justify-center gap-4 text-slate-500">
                <iconify-icon icon="lucide:users" class="text-6xl text-slate-200"></iconify-icon>
                <span class="text-sm font-medium">Tidak ada data pelanggan yang tersedia.</span>
            </div>
        @else
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">No</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Foto Profile</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Nama Pelanggan</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">No. Telp</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider">Tgl Registrasi</th>
                        <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($pelanggan as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 font-bold text-slate-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ $item->foto_profile ? asset('storage/' . $item->foto_profile) : asset('images/default-pfp-cust-single.png') }}"
                                    alt="Foto Profil" class="w-10 h-10 rounded-full object-cover border border-slate-100 shadow-sm">
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-800">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-slate-500 max-w-xs truncate">{{ $item->email }}</td>
                            <td class="px-6 py-4 text-slate-500 font-medium">{{ $item->notelp ?: '-' }}</td>
                            <td class="px-6 py-4 text-slate-500 text-xs">{{ $item->formatted_date }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.edit-pelanggan', $item->id) }}"
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-all">
                                        <iconify-icon icon="lucide:edit-3" class="text-lg"></iconify-icon>
                                    </a>
                                    <form action="{{ route('admin.data-pelanggan.destroy', $item->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?');">
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
    {{ $pelanggan->links() }}
@endsection