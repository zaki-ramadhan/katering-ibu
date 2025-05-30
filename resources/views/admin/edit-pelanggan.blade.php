@extends('layouts.admin')

@section('title', 'Edit Data Pelanggan')

@section('vite')
    @vite(['resources/js/customer/dashboard.js', 'resources/js/admin/edit-pelanggan.js'])
@endsection

@section('content')
    @if (session('success'))
        <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-[25%] bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
            <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
            {{ session('success') }}
        </div>
    @endif

    <div class="card mt-8 bg-white px-8 py-6 shadow-md rounded-2xl flex flex-col gap-7">
        <h1 class="font-semibold text-primary text-2xl mt-2">Edit Data Pelanggan</h1>
        <div class="content-wrapper grid grid-cols-3 gap-10">
            <div class="img-wrapper col-span-2">
                <img src="https://images.unsplash.com/photo-1556740720-776b84291f8e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGN1c3RvbWVyfGVufDB8MHwwfHx8MA%3D%3D" alt="unsplash img" class="w-full aspect-video rounded-2xl object-cover">
            </div>
            <form action="{{ route('admin.update-pelanggan', $pelanggan->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3">
                @csrf
                @method('PUT')
                <label for="foto_profile" class="form-label text-sm text-primary font-medium mb-6">Foto profil pelanggan {{$pelanggan -> name}}</label>
                <label for="foto_profile" class="form-label text-sm text-primary font-medium place-self-center relative group">
                    <div class="img-wrapper w-60 duration-150">
                        <div class="flex flex-col gap-2 mb-2 absolute top-1/2 left-1/2 -translate-x-[25%] -translate-y-[25%]">
                            <input type="file" name="foto_profile" id="foto_profile" class="form-control opacity-0 rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none">
                        </div>
                        @if($pelanggan->foto_profile)
                        <img id="profile-image" src="{{ asset('storage/' . $pelanggan->foto_profile) }}" alt="Foto Profil" class="rounded-full aspect-square object-cover group-hover:brightness-90 ring-2 ring-secondary ring-offset-1">
                        @else
                        <img id="profile-image" src="{{ asset('images/default-pfp-cust-single.png') }}" alt="Foto Profil Default" class="rounded-full aspect-square object-cover group-hover:brightness-90 ring-2 ring-secondary ring-offset-1">
                        @endif
                    </div>
                    <label for="foto_profile" class="hidden w-max font-normal px-4 py-2 rounded-md text-white border border-white absolute top-1/2 left-1/2 text-sm -translate-x-[25%] -translate-y-[25%] z-20 group-hover:inline-block hover:bg-black/20 active:scale-95 duration-100 cursor-pointer">Unggah gambar</label>
                </label>

                <div class="flex flex-col gap-2 my-2">
                    <label for="name" class="form-label text-sm text-primary font-medium">Nama Pelanggan</label>
                    <input type="text" name="name" id="name" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('name', $pelanggan->name) }}" required>
                </div>
                <div class="flex flex-col gap-2 mb-2">
                    <label for="email" class="form-label text-sm text-primary font-medium">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('email', $pelanggan->email) }}" required>
                </div>
                <div class="flex flex-col gap-2 mb-2">
                    <label for="notelp" class="form-label text-sm text-primary font-medium">Nomor Telepon</label>
                    <input type="tel" name="notelp" id="notelp" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('notelp', $pelanggan->notelp) }}">
                </div>
                <div class="btn-wrapper w-full grid grid-cols-3 gap-3 text-sm">
                    <button type="button" onclick="window.history.back();" class="border py-3 rounded-md hover:text-primary bg-tertiary-50 hover:border-secondary hover:bg-tertiary">Batalkan</button>
                    <button type="submit" class="col-span-2 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white py-3 rounded-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
