<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard Admin</title>
        
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css" />

        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit-icons.min.js"></script>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/dashboard-admin.js', 'resources/js/components/modal-logout.js', 'resources/js/components/sidebar-admin.js', 'resources/js/components/header-admin.js'])

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

            /* menghilangkan scrolll bar */
            .items-wrapper {
                scrollbar-width: none; /* Menjadikan scrollbar lebih kecil */
                scrollbar-color: #888 #f1f1f1; /* Warna scrollbar dan track */
            }

            
        </style>

    </head>
    <body class="font-inter bg-red-500 sm:bg-tertiary md:bg-primary-600">

        <x-header-admin></x-header-admin>
        <x-modal-logout></x-modal-logout>

        <main id="main-section" class="container px-8 flex flex-col gap-6 pb-16">
            <div class="sub-header-content container text-center  bg-primary rounded-lg py-4 ">
                <h1 class="text-base text-white">Selamat datang kembali Admin</h1>
            </div>
            {{-- hero section --}}
            <section id="hero-section" class="container px-4 py-6 flex items-center gap-8 rounded-xl bg-white">
                <img src="{{ asset('images/admin.svg') }}" alt="" class="w-72">
                <div class="text-wrapper flex flex-col gap-4 items-center justify-start">
                    <h1 class="font-bold sm:text-3xl md:text-4xl grow text-primary">Pantau dan kelola semua data dan pengaturan</h1>
                    <p class="text-sm leading-6">Kelola status pesanan, pelanggan, dan operasional bisnis Anda dalam satu dashboard.</p>
                </div>
            </section>

            <section id="dashboard-stats-section" class="container">
                <div class="card-wrapper grid grid-cols-2 gap-3 " uk-sortable>
                    <div class="card userData-card flex flex-col gap-3 p-5 rounded-2xl bg-white shadow-md shadow-slate-200">
                        <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-red-500">Data Pelanggan</p>
                        <h3 class="data-count text-2xl font-bold">0</h3>
                        <a href="" class="w-max hover:text-primary hover:no-underline">
                            <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                                Lihat selengkapnya
                                <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                            </button>
                        </a>
                    </div>
                    <div class="card menuData-card flex flex-col gap-3 p-5 rounded-2xl bg-white shadow-md shadow-slate-200">
                        <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-emerald-500">Data Menu</p>
                        <h3 class="data-count text-2xl font-bold">0</h3>
                        <a href="" class="w-max hover:text-primary hover:no-underline">
                            <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                                Lihat selengkapnya
                                <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                            </button>
                        </a>
                    </div>
                    <div class="card orderData-card flex flex-col gap-3 p-5 rounded-2xl bg-white shadow-md shadow-slate-200">
                        <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-blue-500">Data Pesanan</p>
                        <h3 class="data-count text-2xl font-bold">0</h3>
                        <a href="" class="w-max hover:text-primary hover:no-underline">
                            <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                                Lihat selengkapnya
                                <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                            </button>
                        </a>
                    </div>
                    <div class="card feedbackData-card flex flex-col gap-3 p-5 rounded-2xl bg-white shadow-md shadow-slate-200">
                        <p class="data-title relative after:absolute after:top-2 after:right-0 after:content-[''] after:w-[.6rem] after:aspect-square after:rounded-full after:bg-yellow-500">Data Ulasan</p>
                        <h3 class="data-count text-2xl font-bold">0</h3>
                        <a href="" class="w-max hover:text-primary hover:no-underline">
                            <button class="text-sm flex items-center justify-center gap-2 hover:text-primary">
                                Lihat selengkapnya
                                <iconify-icon icon="weui:arrow-filled" class="text-lg"></iconify-icon>
                            </button>
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
