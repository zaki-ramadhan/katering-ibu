{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

{{-- ! alternatif soalnya tailwindnya ga jalan --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pelayanan Katering Ibu</title>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/service.js', 'resources/js/components/modal-logout.js', 'resources/js/components/header.js'])

        <!-- Load JavaScript libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
        

        <style>
            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
                appearance: none;
            }
        </style>

    </head>
    <body class="font-inter bg-red-500 sm:bg-tertiary md:bg-primary-600">

        <x-header></x-header>
        <x-modal-logout></x-modal-logout>

        <main class="main-content-wrapper container flex flex-col gap-6">

            {{-- hero-section --}}
            <section id="hero-section" class="container px-4 relative text-white">
                <div class="img-overlay-group container w-full h-max overflow-hidden relative rounded-2xl">
                    <img src="https://plus.unsplash.com/premium_photo-1661764559869-f6052a14b4c9?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8Y3VzdG9tZXIlMjBzZXJ2aWNlfGVufDB8fDB8fHww" alt="hero image" class="w-full h-72    object-cover">
                    <div class="overlay w-full h-full bg-gradient-to-t from-black/60 to-black/40 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    </div>
                </div>
                <div class="text-input-group absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center gap-5">
                    <h1 class="w-[85vw] text-4xl text-center leading-[1.15] font-semibold">Kami menawarkan pelayanan <span class="text-[2rem]"><span class="font-semibold italic">terbaik</span> & <span class="font-semibold italic">profesional</span> untuk Anda.</span></h1>
                </div>
            </section>

            <section id="services-section" class="container px-4 text-primary">
                <div class="services-wrapper w-full p-6 bg-white mt-2 rounded-tl-xl rounded-tr-xl">
                    <h2 class="text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full"><span class="font-bold">Pelayanan</span> kami</h2>
                    <div class="item-wrapper grid grid-cols-3 gap-4 mt-5">
                        <figure class="service-item flex group flex-col gap-3 active:scale-95 transition-transform duration-100 cursor-pointer" data-index = "delivery">
                            <img src="{{ asset('images/delivery.svg') }}" alt="service img" class="bg-slate-100 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                            <figcaption class="text-sm">
                                Layanan Antar Makanan
                            </figcaption>
                        </figure>
                        <figure class="service-item flex group flex-col gap-3 active:scale-95 transition-transform duration-100 cursor-pointer" data-index = "event">
                            <img src="{{ asset('images/event-2.svg') }}" alt="service img" class="bg-slate-100 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                            <figcaption class="text-sm">
                                Paket Katering untuk Acara Khusus
                            </figcaption>
                        </figure>
                        <figure class="service-item flex group flex-col gap-3 active:scale-95 transition-transform duration-100 cursor-pointer" data-index = "order">
                            <img src="{{ asset('images/order.svg') }}" alt="service img" class="bg-slate-100 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                            <figcaption class="text-sm">
                                Pesanan Sesuka Hati
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="detail-service-wrapper w-full p-6 bg-white flex flex-col gap-4 rounded-bl-xl rounded-br-xl">
                    <h2 class="head-detail text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Layanan Antar Makanan</h2>
                    <figure class="flex flex-col gap-3">
                        <img src="{{ asset('images/delivery.svg') }}" alt="service img" class="service-img aspect-video rounded-xl object-cover">
                        <figcaption class="detail-service text-sm leading-relaxed mt-5 text-justify text-secondary font-light indent-10">
                            Kami menyediakan layanan antar makanan yang cepat dan tepat waktu untuk memastikan hidangan Anda sampai dalam kondisi terbaik. Baik untuk acara kecil maupun besar, kami siap mengantar pesanan langsung ke tempat Anda, memastikan makanan tetap segar dan hangat.
                        </figcaption>
                    </figure>
                </div>
            </section>
            
        </main>
        <button class="btn-scroll-top group fixed right-5 bottom-5 w-12 h-auto aspect-square rounded-full bg-primary text-white text-2xl border border-tertiary grid place-content-center hover:shadow-lg hover:-translate-y-[3px] hover:bg-primary-600 active:bg-primary duration-150 z-50">
            <iconify-icon icon="mdi:arrow-top" class="group-active:-translate-y-2 duration-200"></iconify-icon>
        </button>
        
        <section id="faq-section" class="container px-4 mt-6 text-primary">
            <div class="faq-wrapper p-6 rounded-lg bg-white">
                <h2 class="head-faq text-sm text-white ps-4 mb-5 relative  bg-primary py-5 rounded-xl">Pelanggan juga bertanya hal serupa :</h2>                
                <div class="items flex flex-col">
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Bagaimana cara saya melakukan pemesanan?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <div class="mb-2">Ikuti langkah berikut untuk melakukan pemesanan :</div>
                                <ol class="list-decimal list-outside text-justify">
                                    <div class="lists ps-4 flex flex-col gap-4">
                                        <li>Pastikan anda sudah membuat akun anda atau sudah login.</li>
                                        <li>Pergi ke halaman menu untuk memilih dan menentukan segala hal tentang menu yang akan dipesanan (nama menu, jumlah, metode pembayaran, metode pengambilan, dll)</li>
                                        <li>Masukkan menu ke keranjang pesanan milik Anda</li>
                                        <li>Cek kembali apakah ada yang perlu diubah dari pesanan Anda</li>
                                        <li>Jika tidak ada yang perlu diubah, selanjutnya adalah membayar pesanan Anda sesuai dengan metode pembayaran yang Anda pilih</li>
                                        <li>Simpan dan unggah bukti pembayaran dipesanan Anda yang sudah dibayar tadi.</li>
                                        <li>Tunggu pihak admin Katering Ibu mengkonfirmasi pesanan anda</li>
                                        <li>Jika sudah diterima maka, Anda sudah berhasil melakukan transaksi</li>
                                    </div>
                                </ol>
                            </div>
                        </div>
                    </div>
                        
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Berapa ongkos pengiriman pesanan ke lokasi saya?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <p>Untuk ongkos biaya pengiriman, bisa bervariasi tergantung pada seberapa jauh jarak lokasi dari tempat Katering Ibu.</p>
                        </div>
                    </div>
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Pembayaran bisa melalui apa saja?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <p>Anda dapat melakukan pembayaran melalui bank BRI atau akun DANA.</p>
                        </div>
                    </div>
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Berapa banyak pesanan minimal jika saya ingin memesan?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque laboriosam quia vitae sit fugit labore!</p>
                        </div>
                    </div>
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Dimana lokasi katering ibu ini?</div>
                        <div class="collapse-content text-sm flex flex-col gap-2 text-slate-500 group-focus:py-5">
                            <p>Lokasi katering Ibu berletak di Perumahan Margalaksana 1, Jalan Gunung Ciremai No.25, RT.4/RW.8, Margadadi, Indramayu atau Anda bisa dengan meng-klik link berikut : </p>
                            {{-- <a class="py-3 px-5 rounded-md border text-xs bg-primary hover:bg-primaryHovered active:bg-slate-600 text-white" href="https://www.google.com/maps/search/Perumahan+Margalaksana+1,+Jalan+Gunung+Ciremai+No.25,+RT.4%2FRW.8,+Margadadi,++Indramayu/@-6.3263518,108.3314588,17z/data=!3m1!4b1?entry=ttu&g_ep=EgoyMDI0MTAwNy4xIKXMDSoASAFQAw%3D%3D" target="_blank">
                                Lihat di google maps
                            </a> --}}
                        </div>
                    </div>
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Berapa lama pesanan akan diproses?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <p>tabindex="0" attribute is necessary to make the div focusable</p>
                        </div>
                    </div>
                </div>
            </section>
        

        <x-footer></x-footer>
    </body>
</html>