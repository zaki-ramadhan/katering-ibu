<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    {{-- scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/components/modal-logout.js', 'resources/js/components/sidebar-admin.js', 'resources/js/components/header-admin.js'])
    @yield('vite')

    <link rel="icon" href="{{ asset('images/logo_fix.png') }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <!-- Load JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

    <style>
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            appearance: none;
        }

        /* Custom Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate(-50%, -20px);
            }

            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out forwards;
        }

        /* Scrollbar styling */
        .items-wrapper {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .items-wrapper::-webkit-scrollbar {
            width: 6px;
        }

        .items-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }

        .items-wrapper::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
    </style>
    @yield('style')

</head>

<body class="font-inter bg-slate-100 min-h-screen">

    <x-header-admin></x-header-admin>
    <x-modal-logout></x-modal-logout>

    <!-- Page Content -->
    <main class="container px-8 flex flex-col gap-6 pb-16">
        @yield('content')
    </main>

</body>

</html>

{{-- @yield('script') --}}
@yield('script')