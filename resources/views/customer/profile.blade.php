@extends('layouts.cust')

@section('title', 'Informasi Pribadi Saya')

@section('vite')
    @vite('resources/js/customer/profile.js')
@endsection

@if (session('success'))
    <div id="alert"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white shadow-xl text-sm px-6 py-3 rounded-full z-50 flex items-center justify-center gap-2 animate-bounce">
        <iconify-icon icon="lucide:check-circle" class="text-xl"></iconify-icon>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Profile Header Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            {{-- Cover with Gradient --}}
            <div class="h-40 bg-gradient-to-r from-primary to-primary-700 relative">
                <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
                </div>
            </div>

            {{-- Profile Info Header --}}
            <div class="px-8 pb-8">
                <div class="relative flex flex-col md:flex-row items-center md:items-end gap-6 -mt-16 mb-8">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-3xl ring-8 ring-white overflow-hidden shadow-2xl bg-white">
                            @if(auth()->user()->foto_profile)
                                <img src="{{ asset('storage/' . auth()->user()->foto_profile) }}" alt="Profile"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('images/default-pfp-cust-single.png') }}" alt="Profile"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 text-white rounded-2xl border-4 border-white flex items-center justify-center shadow-lg">
                            <iconify-icon icon="lucide:check" class="text-base"></iconify-icon>
                        </div>
                    </div>

                    <div class="flex-1 text-center md:text-left space-y-1">
                        <h1 class="text-2xl font-black text-slate-800">{{ $user->name }}</h1>
                        <div class="flex flex-wrap justify-center md:justify-start gap-2">
                            <span
                                class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full uppercase tracking-wider border border-emerald-100">Pelanggan</span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('profile.edit') }}"
                            class="px-6 py-2.5 bg-primary text-white font-bold text-sm rounded-xl hover:bg-primary-700 transition-all shadow-lg shadow-primary/20 active:scale-95 flex items-center gap-2">
                            <iconify-icon icon="lucide:edit-3" class="text-lg"></iconify-icon>
                            Edit Profil
                        </a>
                    </div>
                </div>

                <hr class="border-slate-100 mb-8">

                {{-- Profile Details Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Username --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <iconify-icon icon="lucide:user" class="text-base text-primary"></iconify-icon>
                            Username
                        </label>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold">
                            {{ $user->name }}
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <iconify-icon icon="lucide:mail" class="text-base text-primary"></iconify-icon>
                            Alamat Email
                        </label>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold">
                            {{ $user->email }}
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <iconify-icon icon="lucide:phone" class="text-base text-primary"></iconify-icon>
                            Nomor Telepon
                        </label>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold">
                            {{ $user->notelp ?? 'Belum diatur' }}
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <iconify-icon icon="lucide:lock" class="text-base text-primary"></iconify-icon>
                            Kata Sandi
                        </label>
                        <div class="relative flex items-center">
                            <input type="password" readonly value="********"
                                class="w-full p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold focus:ring-0 focus:outline-none cursor-default">
                            <div class="absolute right-4 text-slate-400 flex items-center">
                                <iconify-icon icon="lucide:eye-off" class="text-xl"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Support Section --}}
                <div
                    class="mt-12 p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4 text-center md:text-left">
                        <div
                            class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-emerald-500 shadow-sm">
                            <iconify-icon icon="lucide:headphones" class="text-2xl"></iconify-icon>
                        </div>
                        <div>
                            <p class="font-bold text-emerald-900">Butuh bantuan?</p>
                            <p class="text-sm text-emerald-700 opacity-80">Hubungi tim dukungan kami jika ada kendala.</p>
                        </div>
                    </div>
                    <a href="{{ route('contact-us') }}"
                        class="px-6 py-2.5 bg-white text-emerald-600 font-bold text-sm rounded-xl hover:bg-emerald-50 transition-all shadow-sm border border-emerald-100">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection