@section('title', 'Login Katering Ibu')

@section('vite')
    @vite(['resources/js/login.js'])
@endsection

<x-guest-layout>
    <h1 class="text-3xl font-bold mb-2">Masuk ke Akun Anda.</h1>
    <p class="text-gray-600 mb-8">Silahkan lengkapi data Anda agar bisa masuk ke Akun yang sudah Anda buat sebelumnya.</p>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full " type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="input-wrapper w-full relative">
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <div class="show-hide-btn absolute top-[.85rem] right-4 text-secondary">
                    <iconify-icon icon="fluent:eye-32-filled" id="hide-password-btn" class="hidden text-xl hover:text-primary cursor-pointer"></iconify-icon>
                    <iconify-icon icon="fluent:eye-off-32-filled" id="show-password-btn" class=" text-xl hover:text-primary cursor-pointer"></iconify-icon>
                </div>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm me-3 text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif 
            <x-primary-button class="ms-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
    <p class="mt-5 lg:mt-2 lg:translate-y-[4rem] text-center text-sm text-gray-600">
        Belum memiliki akun? Silahkan <a href="{{ route('register') }}" class="text-blue-600 font-medium">Buat Akun</a> terlebih dahulu.
    </p>
</div>
</div>

<!-- Right side - Background Image and Logo -->
<div class="w-full lg:w-1/2 bg-gray-800 relative">
<img src="https://images.unsplash.com/photo-1662982696492-057328dce48b?q=80&w=2037&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Background" class="w-full h-full object-cover opacity-50">
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
        <div class="flex items-center gap-2 mb-2">
            <img src="{{asset('images/logo_fix.png')}}" alt="logo katering ibu" class="w-10">
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
