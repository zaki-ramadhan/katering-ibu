@extends('layouts.admin')

@section('title', 'Dashboard Admin') 

@section('vite') 
    @vite('resources/js/customer/dashboard.js')
@endsection

@if (session('success'))
    <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
        <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
        {{ session('success') }}
    </div>
@endif

@section('content')
    {{-- <div class="sub-header-content container text-center bg-primary rounded-lg py-4 ">
        <h1 class="text-base text-white">Selamat datang kembali Admin</h1>
    </div> --}}
    {{-- hero section --}}
    <div class="relative overflow-x-auto shadow-lg shadow-slate-200 border rounded-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-6 border-b">ID</th>
                    <th scope="col" class="px-6 py-6 border-b">Nama Pengulas</th>
                    <th scope="col" class="px-6 py-6 border-b">Email Pengulas</th>
                    <th scope="col" class="px-6 py-6 border-b">Isi Pesan</th>
                    <th scope="col" class="px-6 py-6 border-b">Tanggal Dibuat</th>
                    <th scope="col" class="px-6 py-6 text-center border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ulasan as $item)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->nama_pelanggan }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4">{{ $item->pesan }}</td>
                        <td class="px-6 py-4">{{ $item->formatted_date }}</td>
                        <td class="px-6 py-4 text-center gap-2">
                            <button type="button" data-id="{{ $item->id }}" class="delete-btn font-medium px-4 py-2 rounded-md w-max min-w-20 text-white bg-red-500 hover:bg-red-400 active:bg-red-500 hover:no-underline hover:text-white">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>z
@endsection
