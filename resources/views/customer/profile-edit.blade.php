@extends('layouts.cust')

@section('title', 'Edit Informasi Pribadi Saya')

@section('vite')
    @vite('resources/js/customer/profile.js')
@endsection

@if (session('success'))
<div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
    <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
    {{ session('success') }}
</div>
@endif

@section('content')
    <div class="card mt-8 bg-white px-8 py-6 shadow-md rounded-2xl flex flex-col gap-7">
        <h1 class="font-semibold text-primary text-2xl mt-2">Lengkapi dan perbarui data akun Anda disini.</h1>
        <div class="content-wrapper grid grid-cols-3 gap-7">
            <div class="img-wrapper col-span-2">
                <img src="https://images.unsplash.com/photo-1600087626120-062700394a01?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzF8fHVwZGF0ZXxlbnwwfHwwfHx8MA%3D%3D" alt="unsplash img" class="rounded-2xl h-[87%] object-cover">
            </div>
            <form method="POST" action="{{ route('profile.update', auth()->user()->id) }}" class="flex flex-col gap-3">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2 mb-2">
                    <label for="name" class="form-label text-sm text-primary font-medium">Nama Anda</label>
                    <input type="text" name="name" id="name" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('name', auth()->user()->name) }}" required>
                </div>
                <div class="flex flex-col gap-2 mb-2">
                    <label for="email" class="form-label text-sm text-primary font-medium">Email Anda</label>
                    <input type="email" name="email" id="email" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('email', auth()->user()->email) }}" required>
                </div>
                <div class="flex flex-col gap-2 mb-2 group">
                    <label for="password" class="form-label text-sm text-primary font-medium">Password<br><span class="text-xs font-normal">(Kosongkan jika tidak ingin mengubah)</span></label>
                    <input type="password" name="password" id="password" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none">
                    <span class="hidden text-red-400 text-xs group-focus-within:inline">*Password minimal 8 karakter.</span>
                </div>
                <div class="flex flex-col gap-2 mb-2 group">
                    <label for="password_confirmation" class="form-label text-sm text-primary font-medium">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none">
                    <span class="hidden text-red-400 text-xs group-focus-within:inline">*Password harus sama dengan yang di atas.</span>
                </div>
                <div class="flex flex-col gap-2 mb-2">
                    <label for="notelp" class="form-label text-sm text-primary font-medium">Nomor Telepon</label>
                    <input type="tel" name="notelp" id="notelp" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('notelp', auth()->user()->notelp) }}">
                </div>
                <div  class="btn-wrapper w-full grid grid-cols-3 gap-3 text-sm ">
                    <button type="button" onclick="window.history.back();" class="border py-3 rounded-md hover:text-primary bg-tertiary-50 hover:border-secondary hover:bg-tertiary">Batalkan</button>
                    <button type="submit" class="col-span-2 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white py-3 rounded-md">Perbarui Profil</button>
                </div>
            </form>
        </div>
    </div>
@endsection

