{{-- header --}}
<header
    class="container {{ request()->is('order-now/*') ? 'hidde p-2 px-6 lg:px-12' : ' p-2 lg:px-6' }} flex justify-between items-center font-semibold sticky top-0 z-40 bg-white/80 backdrop-blur-md shadow-sm transition-all duration-300">
    <a href="{{ route('home') }}" title="Home" class="flex items-center gap-3 logo-group text-primary">
        <img src="{{ asset('images/logo_fix.png') }}" alt="logo katering ibu" class="w-12">
        <span id="mitra-name" class="text-md">Katering Ibu</span>
    </a>

    {{-- mobile screen --}}
    <div class="flex items-center justify-center gap-5 lg:items-center">
        <div class="flex flex-row-reverse gap-6 btn-wrapper lg:gap-7">
            <button id="menu-btn" title="Menu"
                class="{{ request()->is('order-now/*') ? 'hidden' : 'block' }} lg:hidden">
                <iconify-icon icon="lucide:menu" class="text-2xl text-secondary hover:text-primary"></iconify-icon>
            </button>

            @auth
                <div class="relative hidden lg:block profile-dropdown-wrapper">
                    <button title="Akun saya" id="profile-btn"
                        class="text-2xl font-normal text-secondary hover:text-primary">
                        <iconify-icon icon="bxs:user"></iconify-icon>
                    </button>

                    {{-- dropdown button --}}
                    <div
                        class="dropdown-profile-menu hidden absolute -bottom-[6.3rem] right-0 z-10 bg-white rounded-xl rounded-se-none shadow-lg border-4 border-slate-100 text-primary font-medium text-sm w-max overflow-hidden duration-300">
                        <div class="flex flex-col items-start text-xs font-medium helper-flex-display ">
                            <a href="{{ route('customer.dashboard') }}"
                                class="py-3 rounded-lg ps-4 pe-12 hover:bg-slate-100">Akun saya</a>
                            <button id="logoutBtn"
                                class="w-full py-3 text-red-400 duration-150 rounded-lg pe-12 hover:bg-red-500 active:bg-red-600 hover:text-white">Logout</button>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}">
                    <button id="login-btn"
                        class="px-4 py-3 text-xs font-medium text-white duration-150 rounded-full bg-primary-700 hover:bg-primaryHovered active:bg-primary-600 lg:text-xs">Login</button>
                </a>
            @endauth

            <div class="btn-tooltip-wrapper relative group {{ request()->is('order-now/*') ? 'block' : 'hidden' }}">

                {{-- tooltip --}}
                <div
                    class="tooltip w-max hidden group-hover:inline group-active:bg-slate-500 duration-200 absolute -bottom-10 left-1/2 -translate-x-1/2 px-3 py-2 rounded-lg bg-primary-600 text-white text-[.7rem]">
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
                <ul
                    class="hidden lg:flex items-center justify-center {{ auth()->check() ? 'translate-y-0' : 'translate-y-3' }} gap-8 text-center font-normal text-sm text-secondary">
                    <li>
                        <a href=" {{ route('home') }} "
                            class="{{ Route::currentRouteName() == 'home' ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}">
                            <iconify-icon icon="mingcute:home-4-fill"
                                class="text-xl -translate-y-[1px] {{ Route::currentRouteName() == 'home' ? 'inline' : 'hidden' }}"></iconify-icon>
                            <span>
                                Home
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href=" {{ route('about-us') }} "
                            class="{{ Route::currentRouteName() == 'about-us' ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}">
                            <iconify-icon icon="mdi:information-variant-circle"
                                class="text-xl {{ Route::currentRouteName() == 'about-us' ? 'inline' : 'hidden' }}"></iconify-icon>
                            <span>Tentang kami</span>
                        </a>
                    </li>
                    <li>
                        <a href=" {{ route('service') }} "
                            class="{{ Route::currentRouteName() == 'service' ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}">
                            <iconify-icon icon="ri:service-fill"
                                class="text-xl {{ Route::currentRouteName() == 'service' ? 'inline' : 'hidden' }}"></iconify-icon>
                            Pelayanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('menu') }}"
                            class="{{ (Route::currentRouteName() == 'menu' || Route::currentRouteName() == 'menu.search') ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}">
                            <iconify-icon icon="fluent:food-pizza-20-filled"
                                class="text-2xl {{ (Route::currentRouteName() == 'menu' || Route::currentRouteName() == 'menu.search') ? 'inline' : 'hidden' }}"></iconify-icon>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact-us') }}"
                            class="{{ Route::currentRouteName() == 'contact-us' ? 'text-primary font-semibold flex justify-center items-center gap-1' : 'text-secondary hover:text-primary flex justify-center items-center gap-2' }}">
                            <iconify-icon icon="tdesign:service-filled"
                                class="text-xl {{ Route::currentRouteName() == 'contact-us' ? 'inline' : 'hidden' }}"></iconify-icon>
                            <span>
                                Hubungi Kami
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    {{-- Mobile Dropdown Menu --}}
    <nav id="mobile-nav"
        class="absolute top-full left-0 w-full bg-white shadow-xl border-t border-slate-100 hidden flex flex-col z-50 rounded-b-2xl overflow-hidden">
        {{-- Mobile Menu Links --}}
        <div class="flex flex-col p-4 gap-2">
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 p-3 rounded-lg {{ Route::currentRouteName() == 'home' ? 'bg-primary-50 text-primary font-semibold' : 'text-secondary hover:bg-slate-50 hover:text-primary' }} transition-colors">
                <iconify-icon icon="mingcute:home-4-fill" class="text-xl"></iconify-icon>
                <span class="text-sm">Home</span>
            </a>
            <a href="{{ route('about-us') }}"
                class="flex items-center gap-3 p-3 rounded-lg {{ Route::currentRouteName() == 'about-us' ? 'bg-primary-50 text-primary font-semibold' : 'text-secondary hover:bg-slate-50 hover:text-primary' }} transition-colors">
                <iconify-icon icon="mdi:information-variant-circle" class="text-xl"></iconify-icon>
                <span class="text-sm">Tentang Kami</span>
            </a>
            <a href="{{ route('service') }}"
                class="flex items-center gap-3 p-3 rounded-lg {{ Route::currentRouteName() == 'service' ? 'bg-primary-50 text-primary font-semibold' : 'text-secondary hover:bg-slate-50 hover:text-primary' }} transition-colors">
                <iconify-icon icon="ri:service-fill" class="text-xl"></iconify-icon>
                <span class="text-sm">Pelayanan</span>
            </a>
            <a href="{{ route('menu') }}"
                class="flex items-center gap-3 p-3 rounded-lg {{ Route::currentRouteName() == 'menu' ? 'bg-primary-50 text-primary font-semibold' : 'text-secondary hover:bg-slate-50 hover:text-primary' }} transition-colors">
                <iconify-icon icon="fluent:food-pizza-20-filled" class="text-xl"></iconify-icon>
                <span class="text-sm">Menu</span>
            </a>
            <a href="{{ route('contact-us') }}"
                class="flex items-center gap-3 p-3 rounded-lg {{ Route::currentRouteName() == 'contact-us' ? 'bg-primary-50 text-primary font-semibold' : 'text-secondary hover:bg-slate-50 hover:text-primary' }} transition-colors">
                <iconify-icon icon="tdesign:service-filled" class="text-xl"></iconify-icon>
                <span class="text-sm">Hubungi Kami</span>
            </a>
        </div>

        {{-- Mobile Menu Footer (Auth) --}}
        <div class="p-4 bg-slate-50 border-t border-slate-100">
            @auth
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3 mb-2 px-2">
                        <div
                            class="w-8 h-8 rounded-full bg-primary text-white grid place-content-center text-sm font-bold uppercase shadow-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-primary text-sm line-clamp-1">{{ auth()->user()->name }}</span>
                            <span class="text-[10px] text-secondary uppercase tracking-wider">Pelanggan</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('customer.dashboard') }}"
                            class="col-span-1 py-2 rounded-lg bg-white border border-slate-200 text-center text-xs font-medium text-secondary hover:text-primary hover:border-primary transition-all shadow-sm">
                            Dashboard
                        </a>
                        <button
                            class="mobile-logout-btn col-span-1 py-2 rounded-lg bg-red-50 text-red-500 text-center text-xs font-medium hover:bg-red-100 transition-colors border border-transparent hover:border-red-200">
                            Logout
                        </button>
                    </div>
                </div>
            @else
                <div class="flex flex-col gap-3">
                    <p class="text-xs text-secondary text-center mb-1">Masuk untuk mulai memesan</p>
                    <a href="{{ route('login') }}"
                        class="w-full py-2.5 rounded-lg bg-primary text-white text-center text-sm font-medium hover:bg-primaryHovered transition-all shadow-md hover:shadow-lg">
                        Login / Daftar
                    </a>
                </div>
            @endauth
        </div>
    </nav>
</header>