<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Menu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/create-menu.js'])
</head>
<body class="flex flex-col md:flex-row gap-4 items-center justify-center min-h-screen py-8 bg-tertiary">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="max-w-[80%] w-full bg-white p-8 pt-12 rounded-2xl shadow-md my-2">
        @csrf
        <h1 class="font-semibold text-2xl md:text-3xl text-primary leading-8 text-center mb-16">Lengkapi data berikut untuk menambah menu.</h1>
        {{-- <section class="hero-section flex flex-col items-center justify-center gap-5 mb-20">
            <img src="{{asset('images/add.svg')}}" alt="add menu svg" class="w-full max-w-xs">
        </section> --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- File Upload Section -->
            <div class="upload-file-wrapper">
                <label for="foto_menu" class="mb-4 md:mb-2 block font-semibold text-primary">
                    Upload Foto Menu <span class="text-error">*</span>
                </label>
    
                <div class="mb-2">
                    <input type="file" name="foto_menu" id="foto_menu" class="sr-only" accept="image/*" autocomplete="off" required />
                    <label for="foto_menu" id="foto_menu-label"
                        class="relative flex min-h-[17.4rem] mb-2 items-center justify-center rounded-md border-2 border-dashed border-gray-300 text-center hover:border-blue-500 transition-colors">
                        <div id="foto_menu-drop-text">
                            {{-- <span class="mb-2 block text-base font-semibold text-primary-600">
                                Drop files here
                            </span>
                            <span class="mb-2 block text-base font-medium text-secondary">
                                Or
                            </span> --}}
                            <span
                                class="inline-flex rounded-lg border-[1.5px] border-gray-300 py-3 px-8 text-sm text-primary hover:bg-slate-50 cursor-pointer transition-colors">
                                Browse
                            </span>
                        </div>
                        <img id="foto_menu-preview" class="hidden w-full h-full max-h-[20rem] object-cover" />
                    </label>
                    <span class="text-error hidden text-xs">**Bobot file yang diunggah tidak boleh melebihi 2048kb, dan harus berformat jpeg, jpg, dan png.</span>
                </div>
            </div>
    
            <!-- Form Inputs Section -->
            <div class="space-y-4">
                <!-- Nama Menu -->
                <div class="mb-4">
                    <label for="nama_menu" class="block text-primary font-semibold mb-2">Nama Menu <span class="text-error">*</span></label>
                    <input 
                        type="text" 
                        name="nama_menu"
                        id="nama_menu" 
                        required
                        autocomplete="off" 
                        class="w-full px-3 py-2 bg-gray-50 text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-.5px] focus:ring-blue-500"
                    >
                </div>
    
                <!-- Deskripsi Menu -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-primary font-semibold mb-2">Deskripsi Menu <span class="text-error">*</span></label>
                    <textarea 
                        name="deskripsi"
                        id="deskripsi" 
                        required
                        autocomplete="off"
                        class="px-3 py-2 w-full resize-none bg-gray-50 text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-[.5px] focus:ring-blue-500 h-24"
                    ></textarea>
                </div>
    
                <!-- Harga Menu -->
                <div class="mb-4">
                    <label for="harga" class="block text-primary font-semibold mb-2">Harga Menu <span class="text-error">*</span></label>
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp.</span>
                        <input type="number" step="0.01" name="harga"id="harga" requiredautocomplete="off" class="w-full indent-7 px-3 py-2 bg-gray-50 text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-[.5px] focus:ring-blue-500 before:content-['Rp.'] appearance-none [-moz-appearance:_textfield] [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none">
                    </div>
                </div>
    
                <!-- Submit Button -->
                <div class="btn-wrapper w-full grid grid-cols-3 gap-3 text-sm">
                    <a href="{{route('admin.data-menu')}}" class="text-center bg-tertiary-50 hover:bg-tertiary hover:border text-secondary  rounded-md py-3">
                        <button type="button">Batalkan</button>
                    </a>
                    <button type="submit" class="col-span-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-[.5px] focus:ring-blue-500">
                        Tambahkan Menu
                    </button>
                </div>
            </div>
        </div>
    </form>
    
    
</body>
</html>