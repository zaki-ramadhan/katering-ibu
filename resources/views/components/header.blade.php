{{-- header --}}
<header class="container p-5 flex justify-between items-center font-semibold">
    <a href="{{ route('home') }}" title="Home" class="logo-group flex items-center gap-3 text-primary">
        <iconify-icon icon="game-icons:knife-fork" class="text-xl"></iconify-icon>
        <span id="mitra-name" class="text-md">Katering Ibu</span>
    </a>

    {{-- mobile screen --}}
    <div class="flex items-end justify-center gap-5">
        <div class="btn-wrapper flex gap-6">
            <button id="menu-btn" title="Menu" class="translate-y-1">
                <iconify-icon icon="lucide:menu" class="text-secondary hover:text-primary text-2xl"></iconify-icon>
            </button>
            @auth
            <div class="profile-dropdown-wrapper relative">
                <button title="Akun saya" id="profile-btn" class="text-2xl font-normal text-secondary hover:text-primary translate-y-1">
                    <iconify-icon icon="bxs:user"></iconify-icon>
                </button>
                <div class="dropdown-profile-menu hidden absolute -bottom-[7rem] right-0 z-10 bg-white rounded-xl rounded-se-none shadow-lg border-4 border-white text-primary font-medium text-sm w-max overflow-hidden duration-300">
                    <div class="helper-flex-display text-xs font-medium flex flex-col items-start ">
                        <a href="{{ route('customer.dashboard') }}" class="py-3 ps-4 pe-12 hover:bg-slate-100 rounded-lg">Akun saya</a>
                        <button id="logoutBtn" class="w-full py-3 pe-12 text-red-400 hover:bg-red-500 active:bg-red-600 hover:text-white duration-150 rounded-lg">Logout</button>
                    </div>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}">
                <button id="login-btn" class="px-5 py-3 rounded-full bg-primaryHovered hover:bg-primary-700 active:bg-primary-600 duration-150 text-white font-normal text-xs">Ayo Login!</button>
            </a>
            @endauth
        </div>
    </div>
    
    {{-- nav only display on mobile screen --}}
    <nav class="mobile-nav hidden absolute -top-[100vh] left-0 w-full h-full pt-14 z-20 transition-all duration-700 ease-in-out bg-white overflow-hidden">
        <iconify-icon icon="material-symbols:close" id="hide-menu-btn" class="absolute top-3 right-3 p-3 text-secondary hover:text-primary active:scale-75 active:text-secondary duration-100 text-2xl cursor-pointer"></iconify-icon>
        <ul class="flex flex-col gap-6 text-center font-normal text-sm text-secondary">
            <li><a href=" {{ route('home') }} " class="{{ Route::currentRouteName() == 'home' ? 'text-primary font-semibold' : 'text-secondary hover:text-primary' }}">Home</a></li>
            <li><a href=" {{ route('about-us') }} " class="{{ Route::currentRouteName() == 'about-us' ? 'text-primary font-semibold' : 'text-secondary hover:text-primary' }}" >Tentang Kami</a></li>
            <li><a href=" {{ route('service') }} " class="{{ Route::currentRouteName() == 'service' ? 'text-primary font-semibold' : 'text-secondary hover:text-primary' }}" >Pelayanan</a></li>
            <li><a href="{{ route('menu') }}" class="{{ Route::currentRouteName() == 'menu' ? 'text-primary font-semibold' : 'text-secondary hover:text-primary' }}" >Menu</a></li>
            <li><a href="{{ route('contact-us') }}" class="{{ Route::currentRouteName() == 'contact-us' ? 'text-primary font-semibold' : 'text-secondary hover:text-primary' }}" >Hubungi Kami</a></li>
        </ul>
    </nav>
</header>