@extends('layouts.cust')

@section('title', 'Edit Informasi Pribadi Saya')

@section('vite')
    @vite('resources/js/customer/profile-edit.js')
@endsection

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            {{-- Header --}}
            <div class="p-8 border-b border-slate-50">
                <h1 class="text-2xl font-black text-slate-800">Edit Profil</h1>
                <p class="text-slate-500 text-sm">Perbarui informasi akun Anda untuk pengalaman yang lebih baik.</p>
            </div>

            <form method="POST" action="{{ route('profile.update', auth()->user()->id) }}" enctype="multipart/form-data"
                class="p-8">
                @csrf
                @method('PUT')

                <div class="flex flex-col lg:flex-row gap-12">
                    {{-- Left: Avatar Upload --}}
                    <div class="flex flex-col items-center space-y-4">
                        <div class="relative group">
                            <div
                                class="w-40 h-40 rounded-3xl overflow-hidden ring-8 ring-slate-50 shadow-inner bg-slate-100">
                                @if(auth()->user()->foto_profile)
                                    <img id="profile-image" src="{{ asset('storage/' . auth()->user()->foto_profile) }}"
                                        alt="Profile"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <img id="profile-image" src="{{ asset('images/default-pfp-cust-single.png') }}"
                                        alt="Profile"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @endif
                                {{-- Overlay --}}
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                                    <iconify-icon icon="lucide:camera" class="text-white text-3xl"></iconify-icon>
                                </div>
                            </div>
                            <input type="file" name="foto_profile" id="foto_profile"
                                class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Foto Profil</p>
                            <p class="text-[10px] text-slate-400 mt-1">JPG, PNG atau WebP (Maks. 2MB)</p>
                        </div>
                    </div>

                    {{-- Right: Form Fields --}}
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div class="space-y-2">
                            <label for="name" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nama
                                Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                                required
                                class="w-full p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-all outline-none">
                        </div>

                        {{-- Email --}}
                        <div class="space-y-2">
                            <label for="email" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Alamat
                                Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                required
                                class="w-full p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-all outline-none">
                        </div>

                        {{-- Phone --}}
                        <div class="space-y-2">
                            <label for="notelp" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nomor
                                Telepon</label>
                            <input type="tel" name="notelp" id="notelp" value="{{ old('notelp', auth()->user()->notelp) }}"
                                class="w-full p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-all outline-none">
                        </div>

                        <div class="hidden md:block"></div>

                        {{-- Password --}}
                        <div class="space-y-2">
                            <label for="password"
                                class="text-xs font-bold text-slate-400 uppercase tracking-widest">Password Baru</label>
                            <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak diubah"
                                class="w-full p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-all outline-none">
                            <p class="text-[10px] text-slate-400">*Minimal 8 karakter</p>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="space-y-2">
                            <label for="password_confirmation"
                                class="text-xs font-bold text-slate-400 uppercase tracking-widest">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Ulangi password baru"
                                class="w-full p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-all outline-none">
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="mt-12 pt-8 border-t border-slate-50 flex flex-col sm:flex-row justify-end gap-4">
                    <button type="button" onclick="window.history.back();"
                        class="px-8 py-3 bg-slate-50 text-slate-600 font-bold text-sm rounded-xl hover:bg-slate-100 transition-all active:scale-95">
                        Batalkan
                    </button>
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white font-bold text-sm rounded-xl hover:bg-primary-700 transition-all shadow-lg shadow-primary/20 active:scale-95 flex items-center justify-center gap-2">
                        <iconify-icon icon="lucide:save" class="text-lg"></iconify-icon>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection