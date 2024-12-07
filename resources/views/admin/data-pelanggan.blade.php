@extends('layouts.admin')

@section('title', 'Data Pelanggan - Admin') 

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
    <div class="relative overflow-x-auto shadow-lg shadow-slate-200 border rounded-2xl mt-3">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-6">
                        id
                    </th>
                    <th scope="col" class="px-6 py-6">
                        nama pelanggan
                    </th>
                    <th scope="col" class="px-6 py-6">
                        email pelanggan
                    </th>
                    <th scope="col" class="px-6 py-6">
                        tanggal registrasi akun
                    </th>
                    <th scope="col" class="text-center px-6 py-6">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelanggan as $item)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $item->id }}</td>
                    <td class="px-6 py-4">{{ $item->name }}</td>
                    <td class="px-6 py-4">{{ $item->email }}</td> 
                    <td class="px-6 py-4">{{ $item->formatted_date }}</td>  
                    <td class="px-6 py-4 flex justify-center gap-2"> 
                        <!-- Tombol Aksi (Edit dan Hapus) --> 
                        <a href="" class="edit-btn font-medium px-5 py-2 rounded-md text-white bg-amber-400 hover:bg-amber-300 active:bg-amber-400 hover:text-white hover:no-underline">Edit</a> 

                        <form action="" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?');"> 
                            @csrf 
                            @method('DELETE') 
                            <button type="submit" class="delete-btn font-medium px-5 py-2 rounded-md text-white bg-red-500 hover:bg-red-400 active:bg-red-500 hover:text-white hover:no-underline">Hapus</button> 
                        </form>
                    </td> 
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
@endsection