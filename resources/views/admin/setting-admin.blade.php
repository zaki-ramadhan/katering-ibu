@extends('layouts.admin')

@section('title', 'Pengaturan Akun Admin - Katering Ibu')

@section('vite')
    @vite(['resources/js/admin/dashboard-admin.js', 'resources/js/admin/edit-menu.js', 'resources/js/admin/setting-admin.js'])
@endsection

@section('content')
    @if (session('success'))
        <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
            <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
            {{ session('success') }}
        </div>
    @endif

    <div class="cards-wrapper container grid grid-cols-4 grid-flow-row-dense gap-4">
        <div class="card left-card col-span-1 flex flex-col justify-center items-center text-center gap-2 bg-white px-8 py-12 shadow-md  shadow-slate-200/60 rounded-2xl">
            <img src="{{ asset('images/admin.png') }}" alt="unsplash img" class="max-w-32 mb-3 aspect-square rounded-full object-cover">
            <div class="username text-primary font-medium">
                {{ $admin->name }}
            </div>
            <div class="username text-sm">
                {{ $admin->email }}
            </div>
        </div>
        <div class="card right-card col-span-3 flex flex-col gap-6 bg-white px-8 py-6 shadow-md  shadow-slate-200/60 rounded-2xl">
            {{-- <div class="decoration w-full h-1 rounded-full px-8 box-border bg-blue-200"></div> --}}
            <h1 class="font-medium text-2xl mb-3 text-primary">Edit dan update pengaturan akun admin</h1>
            <form id="adminForm" action="{{ route('setting-admin.update', $admin->id) }}" method="POST" class="text-sm">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-x-10 gap-y-5">
                    <div class="form-group flex flex-col gap-2 focus-within:text-primary">
                        <label for="username">Username :</label>
                        <input type="text" name="username" id="username" value="{{ $admin->name }}" class="w-full max-w-96 text-sm py-3 rounded-md focus:border-0 focus:text-primary">
                    </div>
                    <div class="form-group flex flex-col gap-2 focus-within:text-primary">
                        <label for="email">Email :</label>
                        <input type="email" name="email" id="email" value="{{ $admin->email }}" class="w-full max-w-96 text-sm py-3 rounded-md focus:border-0 focus:text-primary">
                    </div>
                    <div class="form-group flex flex-col gap-2 focus-within:text-primary">
                        <label for="password">Password baru:</label>
                        <div class="input-wrapper w-max relative">
                            <input type="password" name="password" id="password" class="min-w-96 text-sm py-3 rounded-md focus:border-0 focus:text-primary">
                            <div class="show-hide-btn absolute top-[.85rem] right-4">
                                <iconify-icon icon="fluent:eye-32-filled" id="hide-password-btn" class="hidden text-xl hover:text-primary cursor-pointer"></iconify-icon>
                                <iconify-icon icon="fluent:eye-off-32-filled" id="show-password-btn" class=" text-xl hover:text-primary cursor-pointer"></iconify-icon>
                            </div>
                        </div>
                        <div id="passwordAlert" class="text-red-500 text-xs hidden">Password harus lebih dari 8 karakter.</div>
                    </div>
                </div>
                <div class="btn-wrapper flex gap-2 mt-8">
                    <button type="button" onclick="window.location.href='dashboard-admin'" class="py-3 px-8 rounded-lg bg-slate-50 hover:bg-slate-100 active:bg-slate-50 border text-secondary">Batalkan</button>
                    <button type="submit" class="py-3 px-8 rounded-lg bg-emerald-400 hover:bg-emerald-300 active:bg-emerald-400 text-white">Update</button>
                </div>
            </form>
                        
        </div>
    </div>
@endsection
