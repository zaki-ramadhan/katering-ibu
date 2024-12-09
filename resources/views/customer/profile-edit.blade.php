@extends('layouts.cust')

@section('title', 'Edit Informasi Pribadi Saya')

@section('vite')
    @vite('resources/js/customer/profile-edit.js')
@endsection

@section('content')
    <div class="card mt-8 bg-white px-8 py-6 shadow-md rounded-2xl flex flex-col gap-7">
        <h1 class="font-semibold text-primary text-2xl mt-2">Lengkapi dan perbarui data akun Anda disini.</h1>
        <div class="content-wrapper grid grid-cols-3 gap-7">
            <div class="img-wrapper col-span-2">
                <img src="{{asset('images/update-acc.svg')}}" alt="unsplash img" class="rounded-2xl object-cover">
            </div>
            <form method="POST" action="{{ route('profile.update', auth()->user()->id) }}" enctype="multipart/form-data" class="flex flex-col gap-3">
                @csrf
                @method('PUT')
                <label for="foto_profile" class="form-label text-sm text-primary font-medium">Foto Profil Anda</label>
                <label for="foto_profile" class="form-label text-sm text-primary font-medium relative group">
                    <div class="img-wrapper w-60 duration-150">
                        <div class="flex flex-col gap-2 mb-2 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                            <input type="file" name="foto_profile" id="foto_profile" class="form-control opacity-0 rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none">
                        </div>
                        @if(auth()->user()->foto_profile)
                        <img id="profile-image" src="{{ asset('storage/' . auth()->user()->foto_profile) }}" alt="Foto Profil" class="rounded-full aspect-square object-cover group-hover:brightness-90 ring-2 ring-secondary ring-offset-1">
                        @else
                        <img id="profile-image" src="{{ asset('images/default-pfp-cust-single.png') }}" alt="Foto Profil Default" class="rounded-full aspect-square object-cover group-hover:brightness-90 ring-2 ring-secondary ring-offset-1">
                        @endif
                    </div>
                    <label for="foto_profile" class="hidden font-normal px-4 py-2 rounded-md text-white border border-white absolute top-1/2 left-[45%] -translate-x-1/2 text-sm -translate-y-1/2 z-20 group-hover:inline-block hover:bg-black/20 active:scale-95 duration-100 cursor-pointer">Unggah gambar</label>
                </label>


                <div class="flex flex-col gap-2 my-2">
                    <label for="name" class="form-label text-sm text-primary font-medium">Nama Anda</label>
                    <input type="text" name="name" id="name" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('name', auth()->user()->name) }}" required>
                </div>
                <div class="flex flex-col gap-2 mb-2">
                    <label for="email" class="form-label text-sm text-primary font-medium">Email Anda</label>
                    <input type="email" name="email" id="email" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('email', auth()->user()->email) }}" required>
                </div>
                <div class="flex flex-col gap-2 mb-2 group">
                    <label for="password" class="form-label text-sm text-primary font-medium">Password</label>
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
                <div class="btn-wrapper w-full grid grid-cols-3 gap-3 text-sm">
                    <button type="button" onclick="window.history.back();" class="border py-3 rounded-md hover:text-primary bg-tertiary-50 hover:border-secondary hover:bg-tertiary">Batalkan</button>
                    <button type="submit" class="col-span-2 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white py-3 rounded-md">Perbarui Profil</button>
                </div>
            </form>
        </div>
    </div>
@endsection
