{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
{{-- ! alternatif soalnya tailwindnya ga jalan --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Informasi Akun Saya</title>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/customer/profile.js', 'resources/js/components/modal-logout.js', 'resources/js/components/sidebar.js', 'resources/js/components/header-cust.js'])

        <!-- Load JavaScript libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
        
        <style>
            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
                appearance: none;
            }
            .cover {
                background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='80' height='80' patternTransform='scale(2) rotate(0)'><rect x='0' y='0' width='100%' height='100%' fill='%23334155ff'/><path d='M0 0v40h40V0H0zm40 40v40h40V40H40zM4 4h32v32H4V4zm4 4v24h24V8H8zm4 4h16v16H12V12zm4.043 3.988v8.004h8.004v-8.004h-8.004zM44 44h32v32H44V44zm4 4v24h24V48H48zm4 4h16v16H52V52zm4.043 3.984v8.006h8.004v-8.006h-8.004z'  stroke-width='1' stroke='none' fill='%23cbd5e1ff'/><path d='M44 4v32h32V4H44zm4 4h24v24H48V8zm4 4v16h16V12H52zm4 4h8v8h-8v-8zM4 44v32h32V44H4zm4 4h24v24H8V48zm4 4v16h16V52H12zm4 4h8v8h-8v-8z'  stroke-width='1' stroke='none' fill='%2394a3b8ff'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>")
            }
        </style>

    </head>
    <body class="font-inter bg-red-500 sm:bg-tertiary md:bg-primary-600">

        <x-header-cust></x-header-cust>
        <x-modal-logout></x-modal-logout>
        <main id="main-section" class="container px-6 pb-10">
            <div class="profile-cover relative w-full h-52">
                <div class="cover w-full h-full rounded-2xl"></div>
                <div class="img-profile-wrapper w-40 absolute top-0 -translate-x-1/2 left-1/2 translate-y-28">
                    <img src="{{asset('images/Me/jas jae.jpg')}}" alt="customer profile" class="ring-4 ring-tertiary rounded-full aspect-square object-cover object-[50%_20%]">
                    <div class="btn-tooltip-wrapper relative group">
                        <a href="{{ route('contact-us') }}#contact-form">
                            <button class="contact-us-btn absolute right-0 bottom-0 w-12 aspect-square rounded-full bg-primary hover:bg-primary-600 active:bg-slate-500 text-white text-lg active:textarea-md duration-200 border-2 border-tertiary grid place-content-center">
                                <iconify-icon icon="vaadin:headset"></iconify-icon>
                            </button>
                        </a>
                        {{-- tooltip --}}
                        <div class="tooltip w-max hidden group-hover:inline group-active:bg-slate-500 duration-200 absolute -top-10 -right-[6.3rem] px-3 py-2 rounded-lg bg-primary-600 text-white text-[.7rem]">
                            Hubungi Kami
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-data-cust-wrapper container h-auto aspect-square mt-8 text-center bg-white px-16 pt-12 rounded-3xl">
                <h1 class="username text-primary text-2xl mb-3 font-semibold">Zaki Rmdhn</h1>
                <div class="decoration-wrapper flex justify-center gap-2 text-xs font-normal">
                    <span class="role-user p-2 pe-4 ps-6 rounded-full bg-slate-200 text-slate-500 inline relative before:content-[''] before:w-[.5rem] before:aspect-square before:rounded-full before:bg-slate-400 before:absolute before:top-1/2 before:left-2 before:-translate-y-1/2">ID User : 16688034762</span>
                    <span class="id-user p-2 pe-4 ps-6 rounded-full bg-emerald-100 text-emerald-400 inline relative before:content-[''] before:w-[.5rem] before:aspect-square before:rounded-full before:bg-emerald-400 before:absolute before:top-1/2 before:left-2 before:-translate-y-1/2">Pelanggan</span>
                </div>
                
                <form action="" method="post" class="mt-14 w-full mx-auto flex flex-col items-center justify-center gap-7">
                    <header class="head-form flex w-full justify-between items-center mt-4 -mb-2">
                        <h2 class="font-medium text-primary">Informasi Pribadi Anda :</h2>
                        <a>
                            <button type="submit" name="updateBtn" class=" text-white text-xs flex items-center justify-center gap-2 p-3 rounded-lg bg-primary hover:bg-primaryHovered hover:text-white active:scale-95 border border-inherit active:border-slate-300 duration-150">
                                <iconify-icon icon="ix:pen-filled" class="text-base"></iconify-icon>
                                Perbarui data saya
                            </button>
                        </a>
                    </header>

                    {{-- username --}}
                    <div class="username-input w-full flex gap-3">
                        <label for="username" class="p-2 rounded-lg rounded-es-none bg-slate-100 text-xl w-10 aspect-square grid place-content-center outline-none focus:ring-0">
                            <iconify-icon icon="bxs:user"></iconify-icon>
                        </label>
                        <input readonly disabled type="text" name="username" id="username" value="Zaki Ramadhan" class="w-full border-0 focus:ring-0 focus:ring-offset-0 border-b rounded-lg bg-tertiary-50 rounded-es-none rounded-ee-none text-sm p-1 ps-4">
                    </div>

                    {{-- email --}}
                    <div class="email-input w-full flex gap-3">
                        <label for="email" class="p-2 rounded-lg rounded-es-none bg-slate-100 text-xl w-10 aspect-square grid place-content-center outline-none focus:ring-0">
                            <iconify-icon icon="dashicons:email"></iconify-icon>
                        </label>
                        <input readonly disabled type="email" name="email" id="email" value="zakiram4dhan@gmail.com" class="w-full border-0 focus:ring-0 focus:ring-offset-0 border-b rounded-lg bg-tertiary-50 rounded-es-none rounded-ee-none text-sm p-1 ps-4">
                    </div>

                    {{-- password --}}
                    <div class="password-input w-full flex gap-3 relative">
                        <label for="password" class="p-2 rounded-lg rounded-es-none bg-slate-100 text-xl w-10 aspect-square grid place-content-center outline-none focus:ring-0">
                            <iconify-icon icon="bxs:lock"></iconify-icon>
                        </label>
                        <input readonly disabled type="password" name="password" id="password" value="081214772370" class="w-full border-0 focus:ring-0 focus:ring-offset-0 border-b rounded-lg bg-tertiary-50 rounded-es-none rounded-ee-none text-sm p-1 ps-4">
                        <div class="eyes-icon-wrapper text-xl absolute top-1/2 right-5 -translate-y-1/2">
                            <iconify-icon icon="bi:eye-fill" class="opened-eye p-1 cursor-pointer hover:text-primary active:scale-75 transition-transform duration-150"></iconify-icon>
                            <iconify-icon icon="mdi:eye-off" class="closed-eye p-1 cursor-pointer hover:text-primary active:scale-75 transition-transform duration-150"></iconify-icon>
                        </div>
                    </div>

                    {{-- notelp --}}
                    <div class="notelp-input w-full flex gap-3">
                        <label for="notelp" class="p-2 rounded-lg rounded-es-none bg-slate-100 text-xl w-10 aspect-square grid place-content-center outline-none focus:ring-0">
                            <iconify-icon icon="carbon:phone-filled"></iconify-icon>
                        </label>
                        <input readonly disabled type="telp" name="notelp" id="notelp" value="081214772370" class="w-full border-0 focus:ring-0 focus:ring-offset-0  border-primary border-b rounded-lg bg-tertiary-50 rounded-es-none rounded-ee-none text-sm p-1 ps-4">
                    </div>
                </form>
            </div>
        </main>
        <h1>INI ADALAH PERUBAHAN TERBARU</h1>
    </body>
</html>