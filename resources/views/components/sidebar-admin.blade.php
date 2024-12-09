<aside id="sidebar-admin-wrapper" class="absolute hidden top-0 left-0 w-full h-full bg-black/60 z-20 backdrop-blur-sm">
    <div class="sidebar absolute top-0 -translate-x-full w-60 py-6 px-8 h-full bg-white flex flex-col gap-6 duration-200 ease-in-out">
        <div class="logo-menuBtn flex justify-between items-center gap-3">
            <h2 class="font-bold hover:text-primary hover:no-underline text-primary">Katering Ibu</h2>
            <button id="side-menu-btn" title="Menu" class="w-10 aspect-square grid place-content-center translate-y-[1px] hover:bg-tertiary hover:text-primary text-2xl active:ring-1 rounded-lg active:ring-slate-300">
                <iconify-icon icon="lucide:menu" class=""></iconify-icon>
            </button>
        </div>

        <nav class=" flex flex-col gap-6">
            <div class="settings-nav-wrapper flex flex-col gap-3">
                <h3 class="text-sm font-semibold text-primary flex items-center gap-1">
                    {{-- <iconify-icon icon="uil:setting" class="text-lg"></iconify-icon> --}}
                    Navigasi Halaman
                </h3>
                <ul class="w-full flex flex-col font-normal text-xs">
                    <li><a href="{{ route('admin.dashboard-admin') }}" class="hover:no-underline {{ Route::currentRouteName() == 'admin.dashboard-admin' ? 'text-white hover:text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">Dashboard</a></li>
                    <li><a href="{{ route('admin.data-penjualan') }}" class="hover:no-underline {{ Route::currentRouteName() == 'admin.data-penjualan' ? 'text-white hover:text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">Data Penjualan</a></li>
                    <li><a href="{{ route('admin.data-pesanan') }}" class="hover:no-underline {{ Route::currentRouteName() == 'admin.data-pesanan' ? 'text-white hover:text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">Data Pesanan</a></li>
                    <li><a href="{{ route('admin.data-pelanggan') }}" class="hover:no-underline {{ Route::currentRouteName() == 'admin.data-pelanggan' ? 'text-white hover:text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">Data Pelanggan</a></li>
                    <li><a href="{{ route('admin.data-menu') }}" class="hover:no-underline {{ Route::currentRouteName() == 'admin.data-menu' ? 'text-white hover:text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">Data Menu</a></li>
                    <li><a href="{{ route('admin.data-ulasan') }}" class="hover:no-underline {{ Route::currentRouteName() == 'admin.data-ulasan' ? 'text-white hover:text-white font-semibold bg-primary hover:bg-primary-600 active:bg-primary' : 'text-secondary hover:text-primary hover:bg-tertiary active:bg-slate-200' }} block w-full p-3 rounded-md duration-100">Data Ulasan</a></li>
                </ul>
            </div>
        </nav>
    </div>
</aside>