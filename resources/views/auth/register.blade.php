@section('title', 'Registrasi Akun Katering Ibu')


@section('vite')
    @vite(['resources/js/register.js'])
@endsection

<x-guest-layout>
    <h1 class="text-3xl font-bold mb-2">Buat Akun Baru Anda.</h1>
    <p class="text-gray-600 mb-8">Silahkan lengkapi data Anda untuk membuat akun</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata sandi')" />
            <div class="input-wrapper w-full relative">
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

                <div class="show-hide-btn absolute top-[.85rem] right-4 text-secondary">
                    <iconify-icon icon="fluent:eye-32-filled" id="hide-password-btn" class="hidden text-xl hover:text-primary cursor-pointer"></iconify-icon>
                    <iconify-icon icon="fluent:eye-off-32-filled" id="show-password-btn" class="hidden text-xl hover:text-primary cursor-pointer"></iconify-icon>
                </div>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi kata sandi')" />

            <div class="input-wrapper w-full relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

                <div class="show-hide-btn absolute top-[.85rem] right-4 text-secondary">
                    <iconify-icon icon="fluent:eye-32-filled" id="hide-confirm-password-btn" class="hidden text-xl hover:text-primary cursor-pointer"></iconify-icon>
                    <iconify-icon icon="fluent:eye-off-32-filled" id="show-confirm-password-btn" class="hidden text-xl hover:text-primary cursor-pointer"></iconify-icon>
                </div>
            </div>
                
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> --}}

            <x-primary-button class="ms-4">
                {{ __('Buat Akun') }}
            </x-primary-button>
        </div>
    </form>
    <p class="mt-6 translate-y-9 text-center text-sm text-gray-600">
        Sudah memiliki akun? Silahkan <a href="{{route('login')}}" class="text-blue-600 font-medium">Login</a> disini.
    </p>
</div>
</div>

<!-- Right side - Background Image and Logo -->
<div class="w-full lg:w-1/2 bg-gray-800 relative">
<img src="https://images.unsplash.com/photo-1662982696492-057328dce48b?q=80&amp;w=2037&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Background" class="w-full h-full object-cover opacity-50">
<div class="absolute inset-0 flex flex-col justify-between p-8 text-white">
    <div class="flex justify-end space-x-4">
        <a href="{{route('home')}}">
            <button class="bg-gray-700 bg-opacity-50 px-4 py-2 rounded-md flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Home
            </button>
        </a>
        <a href="{{route('menu')}}">
            <button class="px-4 py-2 rounded-md flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                Menu
            </button>
        </a>
    </div>
    <div>
        <div class="flex items-center mb-2">
            <svg class="w-10 h-10 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h2 class="text-3xl font-bold">Katering Ibu</h2>
        </div>
        <p class="text-xl">Belanja Katering Anti Ribet</p>
    </div>
    <div class="text-sm">
        Butuh bantuan? Silahkan hubungi +6281214772370
    </div>
</div>
</div>
</x-guest-layout>
