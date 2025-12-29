<header class="container px-6 py-3 flex justify-between items-center gap-2 font-semibold">
    {{-- mobile screen --}}
    <div class="w-full flex items-center justify-between gap-4">
        <div class="btn-title flex items-center gap-2 md:gap-4">
            <button id="up-menu-btn" title="Menu" class="flex items-center justify-center">
                <iconify-icon icon="lucide:menu" class="text-secondary p-2 rounded-lg hover:bg-slate-200 active:ring-1 active:ring-slate-300 text-2xl md:text-3xl"></iconify-icon>
            </button>
            <h1 class="text-primary-600 font-bold text-lg md:text-xl">
                @switch(Route::currentRouteName())
                    @case('admin.dashboard-admin')
                        Dashboard
                        @break

                    @case('admin.data-penjualan')
                        Data Penjualan
                        @break

                    @case('admin.data-pesanan')
                        Data Pesanan
                        @break

                    @case('admin.data-pelanggan')
                        Data Pelanggan
                        @break

                    @case('admin.data-menu')
                        Data Menu
                        @break

                    @case('admin.data-ulasan')
                        Data Ulasan
                        @break

                    @default
                        
                @endswitch
            </h1>
        </div>

    {{-- component sidebar --}}
        <x-sidebar-admin></x-sidebar-admin>

        {{-- profile on the right corner --}}
        <div class="btn-wrapper flex items-center gap-4">
            <div class="profile-dropdown-wrapper relative">
                <div class="profile-btn flex items-center justify-center gap-2 font-semibold text-sm hover:bg-white hover:shadow-md text-primary p-1.5 pe-4 rounded-full duration-200 cursor-pointer border border-transparent hover:border-slate-100">
                    <img src="{{asset('images/admin.png')}}" alt="customer profile" class="rounded-full w-8 h-8 aspect-square object-cover">
                    <p class="admin-name truncate hidden sm:block">Administrator</p>
                    <iconify-icon icon="bxs:down-arrow" class="down-arrow-icon scale-75"></iconify-icon>
                    <iconify-icon icon="bxs:up-arrow" class="up-arrow-icon hidden scale-75"></iconify-icon>
                </div>

                {{-- dropdown after clicked profile --}}
                <div class="dropdown-logout absolute hidden -bottom-[3.7rem] right-0 z-10 bg-white rounded-xl rounded-se-none shadow-lg shadow-slate-600/10 border-4 border-white text-primary font-medium text-sm w-max overflow-hidden duration-300">
                    <div class="helper-flex-display text-xs font-medium flex flex-col items-start ">
                        <button id="logoutBtn" class="w-full flex items-center justify-center gap-2 py-3 pe-3 ps-16 font-medium text-red-400 hover:bg-red-500 active:bg-red-600 hover:text-white duration-150 rounded-lg">
                            Logout
                            <iconify-icon icon="tabler-logout" class="text-xl"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>