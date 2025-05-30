@extends('layouts.admin')

@section('title', 'Data Ulasan - Admin') 

@section('vite') 
    @vite('resources/js/customer/dashboard.js')
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-[25%] bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    <div class="head-btn-wrapper flex justify-between items-end px-3 mt-8">
        <h1 class="font-medium text-base text-primary">Total data ulasan saat ini: {{ $jumlahUlasan }}</h1>
    </div>
    <div class="relative overflow-x-auto shadow-lg {{ $ulasan->isEmpty() ? 'shadow-none' : 'shadow-slate-200/60'}} border rounded-2xl">
        @if($ulasan->isEmpty())
        <div class="py-5 px-6 flex items-center justify-start gap-2 bg-yellow-200 text-primary rounded-sm text-sm">
            <iconify-icon icon="mingcute:warning-line" class="text-2xl"></iconify-icon>
            <span>Tidak ada data ulasan yang tersedia.</span>
          </div>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-3 py-6 border-b text-center">No</th> <!-- Kolom Nomor Urut -->
                        <th scope="col" class="px-6 py-6 border-b">Pengulas</th>
                        <th scope="col" class="px-6 py-6 border-b">Email</th>
                        <th scope="col" class="px-6 py-6 border-b">Isi Pesan</th>
                        <th scope="col" class="px-6 py-6 border-b">Tanggal</th>
                        <th scope="col" class="px-6 py-6 gap-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ulasan as $item)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-3 py-4 text-center">{{ $loop -> iteration }}</td> <!-- Menampilkan Nomor Urut -->
                        <td class="px-6 py-4 flex items-center justify-start">
                            <img src="{{ $item->user->foto_profile ? asset('storage/' . $item->user->foto_profile) : asset('images/default-pfp-cust-single.png') }}" alt="profile img" class="w-10 h-10 object-cover rounded-full mr-3">
                            {{ $item->user->name }}
                        </td>                        
                        <td class="px-6 py-4">{{ $item->user->email }}</td>
                        <td class="px-6 py-4">{{ $item->pesan }}</td>
                        <td class="px-6 py-4">{{ $item->formatted_date }}</td>
                        <td class="px-6 py-4 gap-2">
                            <form action="{{ route('ulasan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');">
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
@endsection

