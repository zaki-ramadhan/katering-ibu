@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('vite')
    @vite(['resources/js/customer/dashboard.js', 'resources/js/admin/edit-menu.js'])
@endsection

@section('content')
    @if (session('success'))
        <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
            <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
            {{ session('success') }}
        </div>
    @endif

    <div class="card mt-8 bg-white px-8 py-6 shadow-md rounded-2xl flex flex-col gap-7">
        <h1 class="font-semibold text-primary text-2xl mt-2">Edit Menu {{$menu->nama_menu}}</h1>
        <div class="content-wrapper grid grid-cols-3 gap-10">
            <div class="img-wrapper col-span-2">
                <img src="https://images.unsplash.com/photo-1536236397240-9b229a37a286?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fG1lbnV8ZW58MHwwfDB8fHww" alt="unsplash img" class="w-full aspect-video rounded-2xl object-cover">
            </div>
            <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3">
                @csrf
                @method('PUT')
                <label for="foto_menu" class="form-label text-sm text-primary font-medium mb-3">Foto Menu {{$menu->nama_menu}}</label>
                <label for="foto_menu" class="form-label text-sm text-primary font-medium relative group">
                    <div class="img-wrapper place-self-center w-60 duration-150">
                        <div class="flex flex-col gap-2 mb-2 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                            <input type="file" name="foto_menu" id="foto_menu" class="form-control opacity-0 rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none">
                        </div>
                        @if($menu->foto_menu)
                        <img id="menu-image" src="{{ asset('storage/' . $menu->foto_menu) }}" alt="Foto Menu" class="rounded-full aspect-square object-cover group-hover:brightness-90 ring-2 ring-secondary ring-offset-1">
                        @else
                        <img id="menu-image" src="{{ asset('images/default-menu.png') }}" alt="Foto Menu Default" class="rounded-full aspect-square object-cover group-hover:brightness-90 ring-2 ring-secondary ring-offset-1">
                        @endif
                    </div>
                    <label for="foto_menu" class="hidden font-normal px-4 py-2 rounded-md text-white border border-white absolute top-1/2 left-1/2 text-sm -translate-y-1/2 -translate-x-1/2 z-20 group-hover:inline-block hover:bg-black/10 active:scale-95 duration-100 cursor-pointer">Unggah gambar</label>
                </label>

                <div class="flex flex-col gap-2 my-2">
                    <label for="nama_menu" class="form-label text-sm text-primary font-medium">Nama Menu</label>
                    <input type="text" name="nama_menu" id="nama_menu" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                </div>
                <div class="flex flex-col gap-2 mb-2">
                    <label for="deskripsi" class="form-label text-sm text-primary font-medium">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="8" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" required>{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                </div>
                <div class="flex flex-col gap-2 mb-2">
                    <label for="harga" class="form-label text-sm text-primary font-medium">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control rounded-lg text-sm py-3 indent-1 focus:text-primary focus:ring-0 focus:outline-none" value="{{ old('harga', $menu->harga) }}" required>
                </div>
                <div class="btn-wrapper w-full grid grid-cols-3 gap-3 text-sm">
                    <button type="button" onclick="window.history.back();" class="border py-3 rounded-md hover:text-primary bg-tertiary-50 hover:border-secondary hover:bg-tertiary">Batalkan</button>
                    <button type="submit" class="col-span-2 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 text-white py-3 rounded-md">Perbarui Menu</button>
                </div>
            </form>
        </div>
    </div>
@endsection
