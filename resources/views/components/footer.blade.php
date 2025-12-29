<footer
    class="w-full relative text-white px-6 md:px-12 {{ auth()->check() ? 'py-16' : 'pb-16 pt-40 lg:pt-56' }} bg-primary {{ Route::currentRouteName() == 'contact-us' ? 'mt-2' : 'mt-28 lg:mt-52'}}">
    @guest
        <section id="ads-section"
            class="absolute -top-20 left-0 right-0 mx-auto w-[92%] md:w-[90%] lg:w-full lg:max-w-6xl px-0">
            <div
                class="ads-wrapper relative w-full lg:h-48 bg-white lg:border-t lg:border-t-slate-300 px-6 py-6 lg:py-8 rounded-lg lg:rounded-2xl flex flex-col lg:flex-row items-center justify-center text-center lg:text-left lg:justify-start text-primary shadow-xl shadow-slate-700/30 overflow-hidden">
                <img src="../../images/sign-up.svg" alt="sign up ads img"
                    class="hidden lg:block order-guide-img lg:w-80 mt-6 absolute lg:-bottom-28 lg:-left-26">
                <div class="head-button-wrapper lg:ms-60 xl:ms-80 lg:mt-4 z-10 flex flex-col gap-4 lg:gap-5 w-full">
                    <h1 class="text-sm md:text-base lg:text-xl"><span class="font-semibold">Masuk / Daftarkan Akun</span>
                        Anda terlebih dahulu untuk melakukan pemesanan.</h1>
                    <div class="button-wrapper text-xs lg:text-sm flex gap-3 items-center justify-center lg:justify-start">
                        <a href="{{ route('login') }}" class="flex-1 lg:flex-none lg:w-48">
                            <button
                                class="w-full py-3 px-8 lg:px-12 rounded-md lg:rounded-lg bg-slate-800 hover:bg-slate-900 active:bg-slate-800 text-white transition-all">Login</button>
                        </a>
                        <a href="{{ route('register') }}" class="flex-1 lg:flex-none lg:w-48">
                            <button
                                class="w-full py-3 px-8 lg:px-12 rounded-md lg:rounded-lg text-slate-800 border border-slate-800 bg-white hover:bg-slate-50 active:bg-slate-100 transition-all">Daftar</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endguest

    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
        {{-- Brand Section --}}
        <div class="flex flex-col gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo_fix.png') }}" alt="logo" class="w-12">
                <span class="font-bold text-2xl tracking-tight">Katering Ibu</span>
            </a>
            <p class="text-secondary text-sm leading-relaxed">
                Menyajikan hidangan lezat dengan cita rasa rumahan yang otentik. Kami siap melayani berbagai kebutuhan
                katering Anda dengan kualitas terbaik di Indramayu.
            </p>
            <div class="flex gap-4">
                <a href="#"
                    class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-slate-800 hover:text-white transition-all duration-300">
                    <iconify-icon icon="lucide:instagram" class="text-xl"></iconify-icon>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-slate-800 hover:text-white transition-all duration-300">
                    <iconify-icon icon="lucide:facebook" class="text-xl"></iconify-icon>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-slate-800 hover:text-white transition-all duration-300">
                    <iconify-icon icon="lucide:twitter" class="text-xl"></iconify-icon>
                </a>
            </div>
        </div>

        {{-- Navigation Section --}}
        <div>
            <h2 class="text-lg font-bold mb-6 relative inline-block">
                Navigasi
                <span class="absolute -bottom-2 left-0 w-8 h-1 bg-slate-800 rounded-full"></span>
            </h2>
            <ul class="flex flex-col gap-3 text-secondary text-sm">
                <li><a href="{{ route('home') }}"
                        class="hover:text-white transition-colors flex items-center gap-2"><iconify-icon
                            icon="lucide:chevron-right" class="text-xs"></iconify-icon> Home</a></li>
                <li><a href="{{ route('about-us') }}"
                        class="hover:text-white transition-colors flex items-center gap-2"><iconify-icon
                            icon="lucide:chevron-right" class="text-xs"></iconify-icon> Tentang Kami</a></li>
                <li><a href="{{ route('service') }}"
                        class="hover:text-white transition-colors flex items-center gap-2"><iconify-icon
                            icon="lucide:chevron-right" class="text-xs"></iconify-icon> Pelayanan</a></li>
                <li><a href="{{ route('menu') }}"
                        class="hover:text-white transition-colors flex items-center gap-2"><iconify-icon
                            icon="lucide:chevron-right" class="text-xs"></iconify-icon> Menu</a></li>
                <li><a href="{{ route('contact-us') }}"
                        class="hover:text-white transition-colors flex items-center gap-2"><iconify-icon
                            icon="lucide:chevron-right" class="text-xs"></iconify-icon> Hubungi Kami</a></li>
                @auth
                    <li><a href="{{ route('customer.keranjang') }}"
                            class="hover:text-white transition-colors flex items-center gap-2"><iconify-icon
                                icon="lucide:chevron-right" class="text-xs"></iconify-icon> Keranjang Saya</a></li>
                    <li><a href="{{ route('customer.order-history') }}"
                            class="hover:text-white transition-colors flex items-center gap-2"><iconify-icon
                                icon="lucide:chevron-right" class="text-xs"></iconify-icon> Riwayat Pesanan</a></li>
                @endauth
            </ul>
        </div>

        {{-- Menu Section --}}
        <div>
            <h2 class="text-lg font-bold mb-6 relative inline-block">
                Daftar Menu
                <span class="absolute -bottom-2 left-0 w-8 h-1 bg-slate-800 rounded-full"></span>
            </h2>
            <ul class="flex flex-col gap-3 text-secondary text-sm">
                @foreach ($menu as $item)
                    <li><a href="{{ route('order-now.show', ['order_now' => $item->id]) }}"
                            class="hover:text-white transition-colors flex items-center gap-2"><iconify-icon
                                icon="lucide:chevron-right" class="text-xs"></iconify-icon> {{ $item->nama_menu }}</a></li>
                @endforeach
            </ul>
        </div>

        {{-- Contact Section --}}
        <div>
            <h2 class="text-lg font-bold mb-6 relative inline-block">
                Kontak Kami
                <span class="absolute -bottom-2 left-0 w-8 h-1 bg-slate-800 rounded-full"></span>
            </h2>
            <ul class="flex flex-col gap-4 text-secondary text-sm">
                <li class="flex gap-3">
                    <iconify-icon icon="lucide:map-pin" class="text-xl text-slate-400 shrink-0"></iconify-icon>
                    <span>Margadadi, Indramayu, Jawa Barat</span>
                </li>
                <li class="flex gap-3">
                    <iconify-icon icon="lucide:phone" class="text-xl text-slate-400 shrink-0"></iconify-icon>
                    <span>+62 812-3456-7890</span>
                </li>
                <li class="flex gap-3">
                    <iconify-icon icon="lucide:mail" class="text-xl text-slate-400 shrink-0"></iconify-icon>
                    <span>kontak@kateringibu.com</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-16 pt-8 border-t border-white/10 text-center text-secondary text-sm">
        <p>&copy; {{ date('Y') }} Katering Ibu. All rights reserved.</p>
    </div>
</footer>