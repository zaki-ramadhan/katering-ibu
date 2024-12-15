<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <link rel="icon" href="{{ asset('images/logo_fix.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- icon --}}
        <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('vite')
    </head>
    <body class="font-sans text-gray-900 antialiased">

        {{-- alert berhasil --}}
        @if (session('success'))
        <div id="alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white shadow-md text-sm px-4 py-3 rounded-lg z-50 flex items-center justify-center gap-1">
            <iconify-icon icon="lets-icons:check-fill" class="text-xl"></iconify-icon>
            {{ session('success') }}
        </div>
        @endif

        <div class="min-h-screen flex flex-col lg:flex-row">
            <!-- Left side - Registration Form -->
            <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-white">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center gap-1 mb-8">
                        <img src="{{asset('images/logo_fix.png')}}" alt="logo katering ibu" class="w-10">
                        <span class="text-xl font-semibold">Katering Ibu</span>
                    </div>

                    {{ $slot }}
                    
        </div>
    </body>
</html>
