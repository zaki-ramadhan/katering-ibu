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
    <body class="font-inter bg-red-500 sm:bg-white">

        <x-header></x-header>
        <x-modal-logout></x-modal-logout>

        <main class="main-content-wrapper container flex flex-col gap-6">

            {{-- hero-section --}}
            <section id="hero-section" class="container px-4 relative text-white">
                <div class="img-overlay-group container w-full h-max overflow-hidden relative rounded-2xl">
                    <img src="https://plus.unsplash.com/premium_photo-1661764559869-f6052a14b4c9?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8Y3VzdG9tZXIlMjBzZXJ2aWNlfGVufDB8fDB8fHww" alt="hero image" class="w-full h-72 lg:h-96  object-cover">
                    <div class="overlay w-full h-full bg-gradient-to-t from-black/60 to-black/40 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    </div>
                </div>
                <div class="text-input-group absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center gap-5">
                    <h1 class="w-[85vw] lg:w-[50rem] text-4xl lg:text-5xl text-center leading-[1.15] lg:leading-[1.3] font-semibold">Kami menawarkan pelayanan <span class="text-[2rem] lg:text-5xl"><span class="font-semibold italic">terbaik</span> & <span class="font-semibold italic">profesional</span> untuk Anda.</span></h1>
                </div>
            </section>

            <section id="services-section" class="container px-4 text-primary">
                <div class="head-content hidden lg:flex text-center flex-col gap-4 mb-16 lg:mt-20 ">
                    <h2 class="text-4xl text-primary font-semibold">Pilihan Terbaik untuk Setiap Acara!</h2>
                    <p class="text-secondary">Layanan katering kami dirancang untuk memberikan pengalaman kuliner yang berkesan.</p>
                </div>
                <div class="helper lg:grid grid-cols-5">
                    <div class="services-wrapper w-full p-6 lg:py-0 lg:col-span-2 bg-white mt-2 rounded-tl-xl rounded-tr-xl">
                        <h2 class="text-md lg:hidden text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full"><span class="font-bold">Pelayanan</span> kami</h2>
                        <div class="item-wrapper grid grid-cols-3 lg:grid-cols-1 gap-4 mt-5">
                            <figure class="service-item flex lg:items-center justify-start lg:gap-4 group lg:bg-tertiary-50 lg:hover:bg-tertiary lg:p-3 lg:rounded-xl flex-col lg:flex-row gap-3 active:scale-95 transition-transform duration-100 cursor-pointer" data-index = "delivery">
                                <img src="{{ asset('images/delivery.svg') }}" alt="service img" class="bg-slate-100 lg:group-hover:bg-white lg:w-24 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                                <figcaption class="text-sm">
                                    <h2>Layanan Antar Makanan</h2>
                                </figcaption>
                            </figure>
                            <figure class="service-item flex lg:items-center justify-start lg:gap-4 group lg:bg-tertiary-50 lg:hover:bg-tertiary lg:p-3 lg:rounded-xl flex-col lg:flex-row gap-3 active:scale-95 transition-transform duration-100 cursor-pointer" data-index = "event">
                                <img src="{{ asset('images/event-2.svg') }}" alt="service img" class="bg-slate-100 lg:group-hover:bg-white lg:w-24 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                                <figcaption class="text-sm">
                                    <h2>Paket Katering untuk Acara Khusus </h2>
                                </figcaption>
                            </figure>
                            <figure class="service-item flex lg:items-center justify-start lg:gap-4 group lg:bg-tertiary-50 lg:hover:bg-tertiary lg:p-3 lg:rounded-xl flex-col lg:flex-row gap-3 active:scale-95 transition-transform duration-100 cursor-pointer" data-index = "order">
                                <img src="{{ asset('images/order.svg') }}" alt="service img" class="bg-slate-100 lg:group-hover:bg-white lg:w-24 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                                <figcaption class="text-sm">
                                    <h2>Pesanan Sesuka Hati</h2>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="detail-service-wrapper w-full lg:col-span-3 p-6 bg-white flex flex-col gap-4 rounded-bl-xl rounded-br-xl">
                        <h2 class="head-detail text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:bg-primary before:w-1 before:h-full">Layanan Antar Makanan</h2>
                        <figure class="flex flex-col gap-3">
                            <img src="{{ asset('images/delivery.svg') }}" alt="service img" class="service-img aspect-video rounded-xl object-cover">
                            <figcaption class="detail-service text-sm leading-relaxed mt-5 text-justify text-secondary font-light indent-10">
                                Kami menyediakan layanan antar makanan yang cepat dan tepat waktu untuk memastikan hidangan Anda sampai dalam kondisi terbaik. Baik untuk acara kecil maupun besar, kami siap mengantar pesanan langsung ke tempat Anda, memastikan makanan tetap segar dan hangat.
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </section>
            
        </main>
        <button class="btn-scroll-top group fixed right-5 bottom-5 w-12 h-auto aspect-square rounded-full bg-primary text-white text-2xl border border-tertiary grid place-content-center hover:shadow-lg hover:-translate-y-[3px] hover:bg-primary-600 active:bg-primary duration-150 z-50">
            <iconify-icon icon="mdi:arrow-top" class="group-active:-translate-y-2 duration-200"></iconify-icon>
        </button>
        
        <section id="faq-section" class="container px-4 mt-6 lg:-mb-16 text-primary">
            <div class="faq-wrapper p-6 rounded-lg bg-white">
                <h2 class="head-faq text-sm lg:hidden text-white ps-4 mb-5 relative  bg-primary py-5 rounded-xl">Pelanggan juga bertanya hal serupa :</h2>                
                <div class="head-content hidden lg:flex text-center flex-col gap-4 mb-10 lg:mt-24">
                    <h2 class="text-4xl text-primary font-semibold"><span class="text-secondary text-3xl">Panduan pelanggan :</span><br>Pertanyaan dan Jawaban</h2>
                    <p class="text-secondary">Kami menyediakan jawaban untuk mempermudah proses pemesanan dan layanan Anda.</p>
                </div>
                <div class="items flex flex-col">
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 mb-1 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Bagaimana cara saya melakukan pemesanan?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <d class="text-justify"iv class="mb-2">Ikuti langkah berikut untuk melakukan pemesanan :</d>
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
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 mb-1 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Berapa ongkos pengiriman pesanan ke lokasi saya?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <p class="text-justify">Untuk ongkos biaya pengiriman, bisa bervariasi tergantung pada seberapa jauh jarak lokasi dari tempat Katering Ibu.</p>
                        </div>
                    </div>
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 mb-1 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Pembayaran bisa melalui apa saja?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <p class="text-justify">Anda dapat melakukan pembayaran secara tunai (cash) atau melalui virtual account bank BRI dan akun DANA.</p>
                        </div>
                    </div>
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 mb-1 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Berapa banyak pesanan minimal jika saya ingin memesan?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <p class="text-justify">Untuk pemesanan, kami menetapkan jumlah minimal sebanyak 25 paket. Hal ini bertujuan agar kami dapat memberikan pelayanan terbaik dan memastikan kualitas setiap pesanan terjaga. Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
                        </div>
                    </div>
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 mb-1 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Dimana lokasi katering ibu ini?</div>
                        <div class="collapse-content text-sm flex flex-col gap-2 text-slate-500 group-focus:py-5">
                            <p class="text-justify">Lokasi katering Ibu berletak di Perumahan Margalaksana 1, Jalan Gunung Ciremai No.25, RT.4/RW.8, Margadadi, Indramayu.</p>
                            {{-- <a class="py-3 px-5 rounded-md border text-xs bg-primary hover:bg-primaryHovered active:bg-slate-600 text-white" href="https://www.google.com/maps/search/Perumahan+Margalaksana+1,+Jalan+Gunung+Ciremai+No.25,+RT.4%2FRW.8,+Margadadi,++Indramayu/@-6.3263518,108.3314588,17z/data=!3m1!4b1?entry=ttu&g_ep=EgoyMDI0MTAwNy4xIKXMDSoASAFQAw%3D%3D" target="_blank">
                                Lihat di google maps
                            </a> --}}
                        </div>
                    </div>
                    <div tabindex="0" class="collapse collapse-arrow group bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 focus:border-slate-200 mb-1 focus:my-2">
                        <div class="collapse-title text-sm font-medium group-focus:border-b">Berapa lama pesanan akan diproses?</div>
                        <div class="collapse-content text-sm text-slate-500 group-focus:py-5">
                            <p class="text-justify">Proses pengerjaan pesanan biasanya memerlukan waktu 1-2 hari kerja setelah konfirmasi pembayaran. Namun, untuk pesanan dalam jumlah besar atau dengan menu khusus, waktu pengerjaan bisa lebih lama. Kami akan selalu mengonfirmasi waktu yang dibutuhkan untuk setiap pesanan Anda. Jangan ragu untuk menghubungi kami jika ada pertanyaan lebih lanjut."</p>
                        </div>
                    </div>
                </div>
            </section>
        

        <x-footer></x-footer>
    </body>
</html>