<footer class="w-full relative text-white px-12 pb-12 pt-32 bg-primary mt-28 flex flex-col text-center gap-10">
    @guest               
    <section id="ads-section" class="container px-4 absolute -top-20 left-1/2 -translate-x-1/2">
        <div class="ads-wrapper relative w-full bg-white px-6 py-8 rounded-lg flex text-primary shadow-xl shadow-slate-700/30 overflow-hidden">
            <div class="img-ads-wrapper w-max absolute -bottom-10 right-10 rotate-90 scale-150">
                <img src="{{ asset('images/pattern-ads.svg') }}" alt="pattern img" class="w-32 opacity-50">
                <div class="absolute top-0 left-0 inset-0 bg-gradient-to-tr from-white from-10% to-white/90 to-50%"></div>
            </div> 
            <div class="img-ads-wrapper w-max absolute -top-10 left-10 rotate-90 scale-150">
                <img src="{{ asset('images/pattern-ads.svg') }}" alt="pattern img" class="w-32 opacity-50">
                <div class="absolute top-0 left-0 inset-0 bg-gradient-to-b from-white from-10% to-white/90 to-20%"></div>
            </div> 
            {{-- ! ini svg belum diganti, soalnya yg svg asllinya ga kebaca --}}
            <img src="../../images/sign-up.svg" alt="sign up ads img" class="order-guide-img w-52 mt-6 absolute -bottom-16 -left-4">
            <div class="head-button-wrapper ms-32 z-10 flex flex-col gap-3">
                <h1><span class="font-semibold">Masuk / Daftarkan Akun</span> Anda terlebih dahulu untuk melakukan pemesanan.</h1>
                <div class="button-wrapper text-xs flex gap-1 items-center justify-center">
                    <a href="{{ route('login') }}">
                        <button class="py-3 px-8 rounded-md bg-blue-500 hover:bg-blue-400 active:bg-blue-500 text-white">Login</button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button class="py-3 px-8 rounded-md text-blue-500 border border-blue-500 bg-white hover:bg-slate-100 active:bg-blue-100 ">Daftar</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endguest
    <div class="navigation-link-wrapper flex flex-col gap-3">
        <h2 class="font-medium">Navigasi</h2>
        <nav>
            <ul class="text-sm text-secondary flex flex-col gap-3 hover:text-secondary/30">
                <li><a href="{{ route('home') }}" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Home</a></li>
                <li><a href=" {{ route('about-us') }}" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Tentang kami</a></li>
                <li><a href=" {{ route('service') }} " class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Pelayanan</a></li>
                <li><a href="{{ route('menu') }}" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Menu</a></li>
                <li><a href="{{ route('contact-us') }}" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Hubungi Kami</a></li>
            </ul>
        </nav>
    </div>
    <div class="menu-link-wrapper flex flex-col gap-3">
        <h2 class="font-medium">Menu - menu</h2>
        <nav>
            <ul class="text-sm text-secondary flex flex-col gap-3 hover:text-secondary/30">
                <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Baso Ikan</a></li>
                <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Nasi Ayam</a></li>
                <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Nasi Bakar</a></li>
                <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Nasi Kuning</a></li>
                <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Nasi Liwet</a></li>
                <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Paket Nasi Liwet Tampahan</a></li>
                <li><a href="" class="inline-block w-full py-1 hover:text-white hover:bg-primary duration-150">Paket Nasi Kuning Tampahan</a></li>
            </ul>
        </nav>
        <div class="detail-profile-info-wrapper">
            
        </div>
    </div>
</footer>