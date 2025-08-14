{{-- header --}}
<header class="container {{ request()->is('order-now/*') ? 'hidde p-5 px-6 lg:px-12' : ' p-5 lg:px-6' }} flex justify-between items-center font-semibold">
    <a href="{{ route('home') }}" title="Home" class="logo-group flex items-center gap-3 text-primary">
        <img src="{{ asset('images/logo_fix.png') }}" alt="logo katering ibu" class="w-12">
        <span id="mitra-name" class="text-md">Katering Ibu</span>
    </a>

    {{-- mobile screen --}}
    <div class="flex items-end lg:items-center justify-center gap-5">
        <div class="btn-wrapper flex flex-row-reverse gap-6 lg:gap-7">
            <button id="menu-btn" title="Menu" class="{{ request()->is('order-now/*') ? 'hidden' : 'block' }} lg:hidden translate-y-1">
                <iconify-icon icon="lucide:menu" class="text-secondary hover:text-primary text-2xl"></iconify-icon>
            </button>
            
            @auth
            <div class="profile-dropdown-wrapper relative">
                <button title="Akun saya" id="profile-btn" class="text-2xl font-normal text-secondary hover:text-primary">
                    <iconify-icon icon="bxs:user"></iconify-icon>
                </button>
                
                {{-- dropdown button --}}
                <div class="dropdown-profile-menu hidden absolute -bottom-[6.3rem] right-0 z-10 bg-white rounded-xl rounded-se-none shadow-lg border-4 border-slate-100 text-primary font-medium text-sm w-max overflow-hidden duration-300">
                    <div class="helper-flex-display text-xs font-medium flex flex-col items-start ">
                        <a href="{{ route('customer.dashboard') }}" class="py-3 ps-4 pe-12 hover:bg-slate-100 rounded-lg">Akun saya</a>
                        <button id="logoutBtn" class="w-full py-3 pe-12 text-red-400 hover:bg-red-500 active:bg-red-600 hover:text-white duration-150 rounded-lg">Logout</button>
                    </div>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}">
                <button id="login-btn" class="px-4 py-3 rounded-full bg-primary-700 hover:bg-primaryHovered active:bg-primary-600 duration-150 text-white font-medium text-xs lg:text-xs">Ayo Login!</button>
            </a>
            @endauth

            <div class="btn-tooltip-wrapper relative group {{ request()->is('order-now/*') ? 'block' : 'hidden' }}">

                {{-- tooltip --}}
                <div class="tooltip w-max hidden group-hover:inline group-active:bg-slate-500 duration-200 absolute -bottom-10 left-1/2 -translate-x-[25%] px-3 py-2 rounded-lg bg-primary-600 text-white text-[.7rem]">
                    Cari menu
                </div>

                {{-- btn --}}
                <a href="{{ route('menu') }}#search-menu">
                    <button id="serachToMenuPageBtn" class="px-2 text-lg text-secondary hover:text-primary">
                        <iconify-icon icon="akar-icons:search" class="translate-y-[3px]"></iconify-icon>
                    </button>
                </a>
            </div>
            
            {{-- this will display on large screen --}}
            <nav class="{{ request()->is('order-now/*') ? 'hidden' : 'block' }}">
                <ul class="hidden lg:flex lg:-mt-3 items-center justify-center {{ auth()->check() ? 'translate-y-0' : 'translate-y-3' }} gap-8 text-center font-normal text-sm text-secondary">
                    <li>
                        <a href=" {{ route('home') }} " class="{{ Route::currentRouteName() == 'home' ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}">
                            <iconify-icon icon="mingcute:home-4-fill" class="text-xl -translate-y-[1px] {{ Route::currentRouteName() == 'home' ? 'inline' : 'hidden' }}"></iconify-icon>
                            <span>
                                Home
                            </span>
                    </a></li>
                    <li>
                        <a href=" {{ route('about-us') }} " class="{{ Route::currentRouteName() == 'about-us' ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}" >
                            <iconify-icon icon="mdi:information-variant-circle" class="text-xl {{ Route::currentRouteName() == 'about-us' ? 'inline' : 'hidden' }}"></iconify-icon>
                            <span>Tentang kami</span>
                        </a></li>
                    <li>
                        <a href=" {{ route('service') }} " class="{{ Route::currentRouteName() == 'service' ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}" >
                        <iconify-icon icon="ri:service-fill" class="text-xl {{ Route::currentRouteName() == 'service' ? 'inline' : 'hidden' }}"></iconify-icon>
                        Pelayanan
                    </a></li>
                    <li>
                        <a href="{{ route('menu') }}" class="{{ (Route::currentRouteName() == 'menu' || Route::currentRouteName() == 'menu.search') ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}">
                            <iconify-icon icon="fluent:food-pizza-20-filled" class="text-2xl {{ (Route::currentRouteName() == 'menu' || Route::currentRouteName() == 'menu.search') ? 'inline' : 'hidden' }}"></iconify-icon>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact-us') }}" class="{{ Route::currentRouteName() == 'contact-us' ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}" >
                            <iconify-icon icon="tdesign:service-filled" class="text-xl {{ Route::currentRouteName() == 'contact-us' ? 'inline' : 'hidden' }}"></iconify-icon>
                            <span>
                                Hubungi Kami
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
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