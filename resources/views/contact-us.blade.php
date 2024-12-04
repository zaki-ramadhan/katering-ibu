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
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Hubungi Kami - Katering Ibu</title>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/contact-us.js', 'resources/js/components/modal-logout.js', 'resources/js/components/header.js'])

        <!-- Load JavaScript libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
        

        <style>
            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
                appearance: none;
            }
        </style>

    </head>
    <body class="font-inter bg-red-500 sm:bg-white">

        <x-header></x-header>
        <x-modal-logout></x-modal-logout>

        <main class="main-content-wrapper container flex flex-col gap-12">

            {{-- hero-section --}}
            <section id font-light="hero-section" class="container px-4 py-12 relative text-primary flex flex-col-reverse justify-between items-center">
                    <img src="{{ asset('images/contact-us.svg') }}" alt="hero img" class="w-96 lg:w-[36rem] -ms-5 mt-6">
                <div class="text-btn-wrapper flex flex-col gap-4 pe-8 items-center text-center">
                    <h2 class="font-medium lg:text-lg text-primary-600">Punya pertanyaan terkait Katering Ibu?</h2>
                    <h1 class="w-[34rem] lg:w-[45rem] font-bold text-4xl lg:text-5xl leading-[1.2]">Kami selalu siap mendengar & menjawab keluhan Anda.</h1>
                    <p class="font-light text-sm lg:taxt-base lg:text-base text-secondary leading-6">Anda bisa tanyakan apapun terkait Katering Ibu,<br>
                        Kami akan dengan senang hati menjawab pertanyaan Anda.</p>
                    @auth
                    <a href="#contact-form" class="scroll-to">
                        <button class="w-max py-4 px-5 mt-3 rounded-lg bg-primary hover:bg-primary-600 active:bg-primary duration-150 text-white text-xs lg:text-sm">Kirimkan pertanyaan Anda</button>
                    </a>
                        
                    @else
                    <a href="login" class="scroll-to">
                        <button class="w-max py-4 px-5 mt-3 rounded-lg bg-primary hover:bg-primary-600 active:bg-primary duration-150 text-white text-xs">Kirimkan pertanyaan Anda</button>
                    </a>
                    @endauth
                </div>
            </section>
            
            <section id="form-section" class="container px-4 py-32 flex flex-col gap-20 text-primary bg-tertiary">
                <div class="detail-info-group flex flex-col gap-3 mx-8">
                    <h1 class="font-medium text-2xl">Mari terhubung!</h1>
                    <p class="text-secondary font-light">Butuh informasi lebih lanjut? Anda bisa menghubungi Kami melalui detail di bawah ini. Kami siap menjawab setiap pertanyaan Anda!</p>
                    <ul class="flex flex-col gap-8 mt-8">
                        <li>
                            <div class="item-wrapper flex gap-6 pe-16">
                                <iconify-icon icon="ion:location-sharp" class="w-12 h-12 aspect-square bg-primary rounded-md text-white text-2xl grid place-content-center"></iconify-icon>
                                <div class=" flex flex-col gap-1">
                                    <h3 class="font-medium text-base">Alamat</h3>
                                    <p class="text-secondary text-sm font-light">Perumahan Margalaksana 1, Jalan Gunung Ciremai No.25, RT.4/RW.8, Margadadi,  Indramayu</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-wrapper flex gap-6">
                                <iconify-icon icon="fontisto:email" class="w-12 aspect-square bg-primary rounded-md text-white text-2xl grid place-content-center"></iconify-icon>
                                <div class=" flex flex-col gap-1">
                                    <h3 class="font-medium text-base">Email</h3>
                                    <p class="text-secondary text-sm font-light">pujiarti302@gmail.com</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-wrapper flex gap-6">
                                <iconify-icon icon="fontisto:phone" class="w-12 h-max aspect-square bg-primary rounded-md text-white text-lg grid place-content-center"></iconify-icon>
                                <div class=" flex flex-col gap-1">
                                    <h3 class="font-medium text-base">No. telepon</h3>
                                    <p class="text-secondary text-sm font-light">0899-0899-0899</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <form id="contact-form" action="" class="flex flex-col gap-3 p-8 rounded-2xl bg-white">
                    <h1 class="font-medium text-xl mb-3">Kirim Pesan</h1>
                    <div class="nameInput-wrapper flex flex-col gap-2">
                        <label for="name" class="text-sm ">Nama Lengkap Anda<span class="text-red-400 ms-[2px]">*</span></label>
                        <input type="text" name="name" id="name" autocomplete="off" required class="rounded-md focus:ring-0 text-sm">
                    </div>
                    <div class="emailInput-wrapper flex flex-col gap-2">
                        <label for="email" class="text-sm ">Alamat Email<span class="text-red-400 ms-[2px]">*</span></label>
                        <input type="email" name="email" id="email" autocomplete="off" required class="rounded-md focus:ring-0 text-sm">
                    </div>
                    <div class="messageInput-wrapper flex flex-col gap-2">
                        <label for="message" class="text-sm ">Isi Pesan<span class="text-red-400 ms-[2px]">*</span></label>
                        <textarea name="message" id="message" autocomplete="off" required cols="30" rows="5" class="resize-none rounded-md focus:ring-0 text-sm"></textarea>
                    </div>
                    @auth
                    <button class="w-max bg-primary hover:bg-primary-600 active:bg-primary duration-150 text-white px-8 py-4 rounded-lg text-xs font-normal">Kirim Pesan</button>
                    @else
                    <button disabled class="w-max bg-secondary text-white px-8 py-4 rounded-lg text-xs font-normal">Kirim Pesan</button>
                    @endauth
                </form>
            </section>

        </main>
        <button class="btn-scroll-top group fixed right-5 bottom-5 w-12 h-auto aspect-square rounded-full bg-primary text-white text-2xl border border-tertiary grid place-content-center hover:shadow-lg hover:-translate-y-[3px] hover:bg-primary-600 active:bg-primary duration-150">
            <iconify-icon icon="mdi:arrow-top" class="group-active:-translate-y-2 duration-200"></iconify-icon>
        </button>
        
        <x-footer></x-footer>

        
        
        
        
        
        
        {{-- link js --}}
        {{-- <script type="module">
            $("#menu-btn").click(function(){
                alert("Thanks");
                });
        </script> --}}
    </body>
</html>