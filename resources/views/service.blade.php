@extends('layouts.app')

@section('title', 'Pelayanan Katering Ibu') 

@section('vite') 
    @vite('resources/js/service.js')
@endsection

@section('content')
    {{-- hero-section --}}
    <section id="hero-section" class="container px-4 relative text-white">
        <div class="img-overlay-group container w-full h-max overflow-hidden relative rounded-2xl">
            <img src="https://plus.unsplash.com/premium_photo-1661764559869-f6052a14b4c9?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8Y3VzdG9tZXIlMjBzZXJ2aWNlfGVufDB8fDB8fHww" alt="hero image" class="w-full h-72 lg:h-96  object-cover">
            <div class="overlay w-full h-full bg-black/30 absolute top-1/2 left-1/2 -translate-x-[25%] -translate-y-[25%]">
            </div>
        </div>
        <div class="text-input-group absolute top-1/2 left-1/2 -translate-x-[25%] -translate-y-[25%] flex flex-col items-center justify-center gap-5">
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
                <h2 class="text-md lg:hidden text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full"><span class="font-bold">Pelayanan</span> kami</h2>
                <div class="item-wrapper grid grid-cols-3 lg:grid-cols-1 gap-4 mt-5">
                    <figure class="service-item flex lg:items-center justify-start lg:gap-4 group lg:bg-tertiary-50 lg:hover:bg-tertiary lg:p-3 lg:rounded-xl flex-col lg:flex-row gap-3 active:scale-[98%] transition-transform duration-100 cursor-pointer" data-index = "delivery">
                        <img src="{{ asset('images/delivery.svg') }}" alt="service img" class="bg-slate-100 lg:group-hover:bg-white lg:w-24 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                        <figcaption class="text-sm">
                            <h2>Layanan Antar Makanan</h2>
                        </figcaption>
                    </figure>
                    <figure class="service-item flex lg:items-center justify-start lg:gap-4 group lg:bg-tertiary-50 lg:hover:bg-tertiary lg:p-3 lg:rounded-xl flex-col lg:flex-row gap-3 active:scale-[98%] transition-transform duration-100 cursor-pointer" data-index = "event">
                        <img src="{{ asset('images/event-2.svg') }}" alt="service img" class="bg-slate-100 lg:group-hover:bg-white lg:w-24 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                        <figcaption class="text-sm">
                            <h2>Paket Katering untuk Acara Khusus </h2>
                        </figcaption>
                    </figure>
                    <figure class="service-item flex lg:items-center justify-start lg:gap-4 group lg:bg-tertiary-50 lg:hover:bg-tertiary lg:p-3 lg:rounded-xl flex-col lg:flex-row gap-3 active:scale-[98%] transition-transform duration-100 cursor-pointer" data-index = "order">
                        <img src="{{ asset('images/order.svg') }}" alt="service img" class="bg-slate-100 lg:group-hover:bg-white lg:w-24 border border-slate-100 group-hover:border-slate-300 group-active:border-primary duration-150 aspect-square rounded-xl object-cover">
                        <figcaption class="text-sm">
                            <h2>Pesanan Sesuka Hati</h2>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="detail-service-wrapper w-full lg:col-span-3 p-6 bg-white flex flex-col gap-4 rounded-bl-xl rounded-br-xl">
                <h2 class="head-detail text-md text-primary ps-4 relative before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-[25%] before:bg-primary before:w-1 before:h-full">Layanan Antar Makanan</h2>
                <figure class="flex flex-col gap-3">
                    <img src="{{ asset('images/delivery.svg') }}" alt="service img" class="service-img aspect-video rounded-xl object-cover">
                    <figcaption class="detail-service leading-relaxed mt-5 text-justify text-primary indent-10">
                        Kami menyediakan layanan antar makanan yang cepat dan tepat waktu untuk memastikan hidangan Anda sampai dalam kondisi terbaik. Baik untuk acara kecil maupun besar, kami siap mengantar pesanan langsung ke tempat Anda, memastikan makanan tetap segar dan hangat.
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>
    
</main>

<section id="faq-section" class="container px-4 mt-6 lg:-mb-16 text-primary">
    <div class="faq-wrapper p-6 rounded-lg bg-white">
        <h2 class="head-faq text-sm lg:hidden text-white ps-4 mb-5 relative  bg-primary py-5 rounded-xl">Pelanggan juga bertanya hal serupa :</h2>                
        <div class="head-content hidden lg:flex text-center flex-col gap-4 mb-10 lg:mt-24">
            <h2 class="text-4xl text-primary font-semibold"><span class="text-primary text-3xl">Panduan pelanggan :</span><br>Pertanyaan dan Jawaban</h2>
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
@endsection