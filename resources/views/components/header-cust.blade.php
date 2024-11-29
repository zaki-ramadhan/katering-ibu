<header class="container px-6 py-3 flex justify-between items-center gap-2 font-semibold">
    {{-- mobile screen --}}
    <div class="w-full flex items-center justify-between gap-5">
        <div class="btn-title flex items-center gap-4">
            <button id="up-menu-btn" title="Menu" class="translate-y-1">
                <iconify-icon icon="lucide:menu" class="text-secondary p-2 rounded-lg hover:bg-slate-200 active:ring-1 active:ring-slate-300 text-2xl"></iconify-icon>
            </button>
            <h1 class="text-primary-600">
                @switch(Route::currentRouteName())
                    @case('customer.dashboard')
                        Dashboard
                        @break

                    @case('customer.profile')
                        Informasi pribadi
                        @break

                    @case('customer.order-history')
                        Riwayat Pesanan
                        @break

                    @default
                        Halaman Tidak Diketahui
                @endswitch
            </h1>
        </div>

        {{-- component sidebar --}}
        <x-sidebar-cust></x-sidebar-cust>

        {{-- profile on the right corner --}}
        <div class="btn-wrapper flex gap-6">
            <div class="profile-dropdown-wrapper relative">
                <div class="profile-btn flex items-center justify-center gap-2 font-normal text-xs hover:bg-slate-200 hover:shadow-lg hover:shadow-slate-300/70 text-primary p-[.4rem] pe-3 rounded-full duration-200 cursor-pointer">
                    <img src="{{asset('images/Me/jas jae.jpg')}}" alt="customer profile" class="rounded-full w-8 aspect-square object-cover object-[50%_20%]">
                    <p class="cust-name w-6 truncate duration-200">Pelanggan</p>
                    <iconify-icon icon="bxs:down-arrow" class="down-arrow-icon scale-90"></iconify-icon>
                    <iconify-icon icon="bxs:up-arrow" class="up-arrow-icon hidden scale-90"></iconify-icon>
                </div>

                {{-- dropdown after clicked profile --}}
                <div class="dropdown-logout absolute hidden -bottom-[3.7rem] right-0 z-10 bg-white rounded-xl rounded-se-none shadow-lg shadow-slate-600/10 border-4 border-white text-primary font-medium text-sm w-max overflow-hidden duration-300">
                    <div class="helper-flex-display text-xs font-medium flex flex-col items-start ">
                        <button id="logoutBtn" class="w-full flex items-center justify-center gap-2 py-3 pe-3 ps-12 font-medium text-red-400 hover:bg-red-500 active:bg-red-600 hover:text-white duration-150 rounded-lg">
                            Logout
                            <iconify-icon icon="tabler-logout" class="text-xl"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>