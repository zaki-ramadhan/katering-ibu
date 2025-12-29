<aside id="sidebar-cust-wrapper" class="absolute hidden top-0 left-0 w-full h-full bg-black/60 z-20 backdrop-blur-sm">
    <div
        class="sidebar absolute top-0 -translate-x-full w-60 py-6 px-8 h-full bg-white flex flex-col gap-6 duration-200 ease-in-out">
        <div class="logo-menuBtn flex flex-row-reverse justify-end items-center gap-3">
            <a href="{{ route('home') }}" title="Home" class="font-bold text-primary">Katering Ibu</a>
            <button id="side-menu-btn" title="Menu"
                class="w-10 aspect-square grid place-content-center translate-y-[1px] hover:bg-tertiary hover:text-primary text-2xl active:ring-1 rounded-lg active:ring-slate-300">
                <iconify-icon icon="lucide:menu" class=""></iconify-icon>
            </button>
        </div>

        <nav class="flex flex-col gap-6">
            <div class="settings-nav-wrapper flex flex-col gap-3">
                <h3 class="text-base font-semibold text-primary flex items-center gap-1">Pengaturan</h3>
                <ul class="w-full flex flex-col font-normal text-sm">
                    <li>
                        <a href="{{ route('customer.dashboard') }}"
                            class="{{ Route::currentRouteName() == 'customer.dashboard' ? 'text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('customer.profile') }}"
                            class="{{ (Route::currentRouteName() == 'customer.profile' || Route::currentRouteName() == 'profile.edit') ? 'text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">Informasi
                            Pribadi</a>
                    </li>
                    <li>
                        <a href="{{ route('customer.keranjang') }}"
                            class="{{ Route::currentRouteName() == 'customer.keranjang' ? 'text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">
                            Keranjang saya
                            @php
                                $cartItemTypesCount = app(\App\Http\Controllers\OrderController::class)->getCartItemTypesCount();
                            @endphp
                            @if ($cartItemTypesCount > 0)
                                <span
                                    class="text-xs bg-slate-400 text-white px-2 py-1 rounded-full ml-2">{{ $cartItemTypesCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.order-history') }}"
                            class="{{ Route::currentRouteName() == 'customer.order-history' ? 'text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">
                            Riwayat Pesanan
                            @php
                                $orderHistoryCount = app(\App\Http\Controllers\OrderController::class)->getOrderHistory()->count();
                            @endphp
                            @if ($orderHistoryCount > 0)
                                <span
                                    class="text-xs bg-slate-400 text-white px-2 py-1 rounded-full ml-2">{{ $orderHistoryCount }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

            <div class="web-nav-wrapper flex flex-col gap-3">
                <h3 class="text-base font-semibold text-primary">Navigasi Halaman</h3>
                <ul class="flex flex-col font-normal text-sm">
                    <li><a href="{{ route('home') }}"
                            class="block w-full p-3 rounded-md hover:text-primary hover:bg-tertiary duration-200">Home</a>
                    </li>
                    <li><a href="{{ route('about-us') }}"
                            class="block w-full p-3 rounded-md hover:text-primary hover:bg-tertiary duration-200">Tentang
                            Kami</a></li>
                    <li><a href="{{ route('service') }}"
                            class="block w-full p-3 rounded-md hover:text-primary hover:bg-tertiary duration-200">Pelayanan</a>
                    </li>
                    <li><a href="{{ route('menu') }}"
                            class="block w-full p-3 rounded-md hover:text-primary hover:bg-tertiary duration-200">Menu</a>
                    </li>
                    <li><a href="{{ route('contact-us') }}"
                            class="block w-full p-3 rounded-md hover:text-primary hover:bg-tertiary duration-200">Hubungi
                            Kami</a></li>
                </ul>
            </div>
        </nav>
    </div>
</aside>