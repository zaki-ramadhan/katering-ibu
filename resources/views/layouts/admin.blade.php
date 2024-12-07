<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts --> 
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 

        {{-- favicon --}}
        <link rel="icon" href="{{ asset('images/logo_fix.png') }}">

        <!-- Load JavaScript libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/components/sidebar-cust.js', 'resources/js/components/header-cust.js', 'resources/js/components/modal-logout.js'])
        @yield('vite')

        {{-- css --}}
        <style>
            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
                appearance: none;
            }
        </style>
        @yield('style')

    </head>

    <body class="font-inter bg-red-500 sm:bg-tertiary lg:bg-white">

        <x-header-admin></x-header-admin>
        <x-modal-logout></x-modal-logout>

            <!-- Page Content -->
        <main class="container">
            @yield('content')
        </main>

    </body>
</html>
