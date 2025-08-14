<footer class="w-full relative text-white px-12 {{ auth()->check() ? 'py-12' : 'pb-12 pt-32 lg:pt-48' }} bg-primary {{ Route::currentRouteName() == 'contact-us' ? 'mt-2' : 'mt-28 lg:mt-52'}} flex flex-col text-center gap-10">
    @guest               
    <section id="ads-section" class="container px-4 absolute -top-20 left-1/2 -translate-x-[25%]">
        <div class="ads-wrapper relative w-full lg:h-48 bg-white lg:border-t lg:border-t-slate-300 px-6 py-8 rounded-lg lg:rounded-2xl flex text-primary shadow-xl shadow-slate-700/30 overflow-hidden">
            <img src="../../images/sign-up.svg" alt="sign up ads img" class="order-guide-img w-52 lg:w-80 mt-6 absolute -bottom-16 lg:-bottom-28 -left-4 lg:-left-26">
            <div class="head-button-wrapper ms-32 lg:ms-60 xl:ms-80 lg:mt-4 z-10 flex flex-col gap-3 lg:gap-5">
                <h1 class="lg:text-xl"><span class="font-semibold">Masuk / Daftarkan Akun</span> Anda terlebih dahulu untuk melakukan pemesanan.</h1>
                <div class="button-wrapper text-xs lg:text-sm flex gap-1 lg:gap-3 items-center justify-center">
                    <a href="{{ route('login') }}">
                        <button class="py-3 px-8 lg:px-12 rounded-md lg:rounded-lg bg-blue-500 hover:bg-blue-600 active:bg-blue-500 text-white">Login</button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button class="py-3 px-8 lg:px-12 rounded-md lg:rounded-lg text-blue-500 border border-blue-500 bg-white hover:bg-slate-100 active:bg-blue-100 ">Daftar</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endguest
    <div class="navigation-link-wrapper flex flex-col gap-3">
        <h2 class="font-medium">Navigasi Halaman</h2>
        <nav>
            <ul class="text-sm text-secondary flex flex-col gap-4 hover:text-secondary/30">
                <li><a href="{{ route('home') }}" class="inline-block w-full hover:text-white hover:bg-primary duration-150">Home</a></li>
                <li><a href=" {{ route('about-us') }}" class="inline-block w-full hover:text-white hover:bg-primary duration-150">Tentang kami</a></li>
                <li><a href=" {{ route('service') }} " class="inline-block w-full hover:text-white hover:bg-primary duration-150">Pelayanan</a></li>
                <li><a href="{{ route('menu') }}" class="inline-block w-full hover:text-white hover:bg-primary duration-150">Menu</a></li>
                <li><a href="{{ route('contact-us') }}" class="inline-block w-full hover:text-white hover:bg-primary duration-150">Hubungi Kami</a></li>
            </ul>
        </nav>
    </div>
    <div class="menu-link-wrapper flex flex-col gap-3">
        <h2 class="font-medium">Menu - menu</h2>
        <nav>
            <ul class="text-sm text-secondary flex flex-col gap-4 hover:text-secondary/30">
                @foreach ($menu as $item)
                    <li><a href="{{ route('order-now.show', ['order_now' => $item->id]) }}" class="inline-block w-full hover:text-white hover:bg-primary duration-150">{{ $item->nama_menu }}</a></li>
                @endforeach
            </ul>            
        </nav>
        <div class="detail-profile-info-wrapper">
            
        </div>
    </div>
</footer>