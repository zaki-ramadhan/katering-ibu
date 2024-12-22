<header class="container px-6 py-3 flex justify-between items-center gap-2 font-semibold">
    {{-- mobile screen --}}
    <div class="w-full flex items-center justify-between gap-5">
        <div class="btn-title flex items-center gap-4">
            <button id="up-menu-btn" title="Menu" class="translate-y-[3px]">
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

                    @case('customer.keranjang')
                        Keranjang saya
                        @break

                    @case('customer.order-history')
                        Riwayat Pesanan
                        @break

                    @default
                        @php
                            $url = url()->current();
                        @endphp
                        @if (str_contains($url, '/profile'))
                            Perbarui Informasi Pribadi Saya
                        @elseif (str_contains($url, '/pesanan'))
                            Pesanan saya
                        @else
                            Halaman Tidak Diketahui
                        @endif
                @endswitch
            </h1>
        </div>

        {{-- component sidebar --}}
        <x-sidebar-cust></x-sidebar-cust>

        {{-- profile on the right corner --}}
        <div class="btn-wrapper flex gap-6">
            <div class="profile-dropdown-wrapper relative">
                <div class="profile-btn flex items-center justify-center gap-2 font-normal text-xs hover:bg-slate-50 hover:shadow-lg hover:shadow-slate-200/70 text-primary p-[.4rem] pe-3 rounded-full duration-200 cursor-pointer">
                    @if(auth()->user()->foto_profile)
                    <img src="{{ asset('storage/' . auth()->user()->foto_profile) }}" alt="customer profile" class="rounded-full w-8 aspect-square object-cover object-[50%_20%]">
                    @else
                    <img src="{{ asset('images/default-pfp-cust-single.png') }}" alt="customer profile" class="rounded-full w-8 aspect-square object-cover object-[50%_20%]">
                    @endif
                    <p class="cust-name w-6 truncate duration-200">{{ auth()->user()->name }}</p>
                    <iconify-icon icon="bxs:down-arrow" class="down-arrow-icon scale-90"></iconify-icon>
                    <iconify-icon icon="bxs:up-arrow" class="up-arrow-icon hidden scale-90"></iconify-icon>
                </div>

                {{-- dropdown after clicked profile --}}
                <div class="dropdown-logout absolute hidden -bottom-[7.3rem] right-0 z-10 bg-white rounded-xl rounded-se-none shadow-lg shadow-slate-600/10 border-4 border-white text-primary font-medium text-sm w-max overflow-hidden duration-300">
                    <div class="helper-flex-display text-xs font-medium flex flex-col justify-start items-start ">
                        <button id="logoutBtn" class="w-full flex items-center justify-between gap-2 py-3 pe-3 ps-4 font-medium text-red-400 hover:bg-slate-100 active:bg-slate-50 duration-150">
                            Logout
                            <iconify-icon icon="tabler-logout" class="text-xl"></iconify-icon>
                        </button>
                        <button id="deleteAccBtn" class="w-max text-left flex items-center justify-between gap-6 py-3 pe-3 ps-4 font-medium bg-red-500 hover:bg-red-600 active:bg-red-500 text-white hover:text-white duration-150">
                            Logout dan<br>Hapus Akun
                            <iconify-icon icon="fluent:person-delete-16-filled" class="text-2xl"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>