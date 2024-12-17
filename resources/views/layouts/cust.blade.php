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

        {{-- ajax --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/components/sidebar-cust.js', 'resources/js/components/header-cust.js', 'resources/js/components/modal-logout.js', 'resources/js/components/modal-delete-account.js'])
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

    <body class="font-inter bg-red-500 sm:bg-tertiary {{ Route::currentRouteName() == 'profile.edit' ? 'lg:bg-tertiary' : 'lg:bg-white' }} min-h-screen">

        <x-header-cust></x-header-cust>
        <x-modal-logout></x-modal-logout>
        <x-modal-delete-account></x-modal-delete-account>

            <!-- Page Content -->
        <main class="container {{ Route::currentRouteName() == 'profile.edit' ? 'w-[78%] pb-20' : '' }} {{Route::currentRouteName() == 'customer.keranjang' ? 'pb-20' : ''}}">
            @yield('content')
        </main>

    </body>
</html>
