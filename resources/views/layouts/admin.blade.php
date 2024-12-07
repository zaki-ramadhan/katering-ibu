<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', config('app.name', 'Laravel'))</title>
        
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css" />
        

        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit-icons.min.js"></script>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/components/modal-logout.js', 'resources/js/components/modal-delete-data.js', 'resources/js/components/sidebar-admin.js', 'resources/js/components/header-admin.js'])
        @yield('vite')

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
        @yield('style')

    </head>

    <body class="font-inter bg-red-500 sm:bg-tertiary">

        
        <x-header-admin></x-header-admin>
        <x-modal-logout></x-modal-logout>
        
        <x-modal-delete-data></x-modal-delete-data>

            <!-- Page Content -->
        <main class="container px-8 flex flex-col gap-6 pb-16">
            @yield('content')
        </main>

    </body>
</html>
