@extends('layouts.app')

@section('title', 'Tentang Katering Ibu')

@section('vite')
    @vite('resources/js/about-us.js')
@endsection

@section('style')
    <style>
        .img-wrapper {
            background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='https://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='87' height='50.232' patternTransform='scale(2) rotate(0)'><rect x='0' y='0' width='100%' height='100%' fill='%23ffffffff'/><path d='M0 54.424l14.5-8.373c4.813 2.767 9.705 5.573 14.5 8.37l14.5-8.373V29.303M0 4.193v16.744l-14.5 8.373L0 37.68l14.5-8.374V12.562l29-16.746m43.5 58.6l-14.5-8.37v-33.49c-4.795-2.797-9.687-5.603-14.5-8.37m43.5 25.111L87 37.67c-4.795-2.797-24.187-13.973-29-16.74l-14.5 8.373-14.5-8.37v-33.489m72.5 8.365L87 4.183l-14.5-8.37M87 4.183v16.745L58 37.673v16.744m0-66.976V4.185L43.5 12.56c-4.795-2.797-24.187-13.973-29-16.74L0 4.192l-14.5-8.37m29 33.484c4.813 2.767 9.705 5.573 14.5 8.37V54.42'  stroke-linecap='square' stroke-width='1' stroke='%236d6d6dff' fill='none'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>")
        }
    </style>
@endsection

@section('content')
    {{-- hero-section --}}
    <section id="hero-section"
        class="container px-4 py-12 relative text-primary flex flex-col-reverse justify-between items-center font-light">
        <div class="text-btn-wrapper flex flex-col gap-6 pe-8 items-center text-center">
            {{-- <h2 class="font-medium text-primary-600">Punya pertanyaan terkait Katering Ibu?</h2> --}}
            <p class="label py-1.5 px-3 bg-tertiary text-secondary text-xs font-medium lg:text-sm rounded-full">Tentang Kami</p>
            <h1 class="w-[30rem] lg:w-4/5 font-bold text-5xl lg:text-6xl -mt-2">
                Ketahui informasi lengkap mengenai K<span class="font-medium italic">ate</span>ring Ibu.
            </h1>
            <p class="w-[70vw] lg:w-1/2 text-sm lg:text-base text-secondary font-normal">
                Ketahui lebih dalam tentang perjalanan kami, dari awal berdiri hingga menjadi pilihan untuk layanan katering profesional.
            </p>
            <div class="btn-wrapper flex gap-3 lg:gap-4 text-xs lg:text-sm font-medium">
                <button id="historyBtn"
                    class="active min-w-32 w-max px-6 py-4 bg-primary hover:bg-primary-600 hover:-translate-y-[3px] hover:shadow-md hover:shadow-slate-400 hover:border active:bg-primary active:translate-y-[3px] active:shadow-sm active:shadow-slate-100 duration-200 text-white rounded-full">Sejarah
                    berdiri</button>
                <button id="locationBtn"
                    class="min-w-32 w-max px-6 py-4 bg-slate-100 hover:bg-slate-200/70 hover:-translate-y-[3px] hover:shadow-md hover:shadow-slate-300 active:bg-slate-100 active:translate-y-[3px] active:shadow-sm active:shadow-slate-100 duration-200 rounded-full">Lokasi</button>
            </div>
        </div>
    </section>

    <section id="history-location-content"
        class="container px-6 py-6 rounded-lg flex flex-col gap-4 items-start justify-center">
        <div class="img-wrapper relative w-full rounded-3xl overflow-hidden">
            <div class="overlay absolute top-0 left-0 w-full h-full bg-gradient-to-t from-white to-white/90"></div>
            <img src="{{ asset('images/search-aboutus.svg') }}" alt="search about-us svg"
                class="-translate-y-7 lg:translate-x-44 -mb-[12rem] w-full max-w-[48rem]">

            {{-- s\chat bubble --}}
            <div
                class="bubblechat-e-wrapper absolute top-[3rem] md:top-[6rem] lg:top-[8rem] left-7 md:left-20 lg:left-48 animate-bounce-up-down">
                <div class="chat chat-end">
                    <div class="chat-bubble text-tertiary text-sm lg:text-lg text-wrap pe-1 pb-4">
                        <p class="translate-y-1">
                            What an incredible story!
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="bubblechat-s-wrapper absolute top-28 md:top-48 right-3 md:right-6 lg:right-7 lg:top-52 xl:right-60 animate-bounce-up-down-delay">
                <div class="chat chat-start">
                    <div
                        class="chat-bubble bg-slate-200 text-primaryHovered font-medium text-sm lg:text-lg text-wrap pe-1 pb-4">
                        <p class="translate-y-1">
                            Wait, there’s more to this?
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ! history content --}}
        <div id="history" class="content-wrapper container px-6 py-6">
            <div class="flex-helper flex flex-col justify-center gap-4">
                <h2 class="text-primary font-semibold text-2xl after:content-['👣'] after:ms-1">
                    Sejarah berdiri Katering Ibu
                </h2>
                <div class="img-wrapper relative w-full h-60 rounded-2xl overflow-hidden">
                    <!-- Track untuk gambar -->
                    <div class="slider-track flex transition-transform duration-500 ease-in-out">
                        <img src="https://images.unsplash.com/photo-1480455454781-1af590be2a58?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8Y2F0ZXJpbmd8ZW58MHx8MHx8fDA%3D"
                            alt="catering ibu" class="w-full h-full object-cover">
                        <img src="https://plus.unsplash.com/premium_photo-1687697860831-edaf70e279dd?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y2F0ZXJpbmd8ZW58MHx8MHx8fDA%3D"
                            alt="catering ibu" class="w-full h-full object-cover">
                    </div>

                    <!-- Tombol Navigasi -->
                    <div
                        class="btn-wrapper w-full absolute top-1/2 left-0 -translate-y-[25%] text-white flex justify-between px-2 box-border z-10">
                        <button id="prevBtn"
                            class="prev-btn w-10 h-auto aspect-square place-self-center hidden text-white bg-black/30 hover:bg-white hover:text-primary duration-150 active:scale-75 rounded-full"><iconify-icon
                                icon="bxs:left-arrow" class="translate-y-[2px]"></iconify-icon></button>
                        <button id="nextBtn"
                            class="next-btn w-10 h-auto aspect-square place-self-center absolute top-1/2 right-2 -translate-y-[25%] text-white bg-black/30 hover:bg-white/30 hover:text-primary duration-150 active:scale-75 rounded-full"><iconify-icon
                                icon="bxs:right-arrow" class="translate-y-[2px]"></iconify-icon></button>
                    </div>
                </div>

                <p class="paragraph text-sm font-light leading-relaxed indent-10 line-clamp-4 text-justify">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, perferendis aliquam nisi quo
                    placeat, beatae harum rem aut quibusdam molestias quisquam eius numquam, vitae aperiam! Unde, ipsum
                    deleniti atque nam neque delectus nihil tempore necessitatibus explicabo perspiciatis vel vitae ab
                    asperiores, cupiditate ipsa exercitationem veniam odio placeat eius aspernatur eum quas maxime!
                    Distinctio enim eos officia repudiandae, a nobis autem tempore illo, libero maiores neque inventore
                    perspiciatis, expedita ut quis?
                </p>
                <hr>
                <span
                    class="read-more-btn flex justify-center items-center gap-2 text-sm text-center mt-1 bg-white box-border text-blue-500 hover:text-blue-700 active:text-purple-700 cursor-pointer">
                    <p class="text">Baca selengkapnya</p> <iconify-icon icon="fe:arrow-down"
                        class="arrow-icon  translate-y-[1px] duration-150"></iconify-icon>
                </span>

            </div>
        </div>

        {{-- ! location content --}}
        <div id="location" class="content-wrapper hidden">
            <div class="flex-helper flex flex-col items-start justify-center gap-4">
                <h2 class="text-primary font-semibold text-2xl after:content-['📌'] after:ms-1">
                    Lokasi Katering Ibu
                </h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3965.5218453726347!2d108.33145882499122!3d-6.326351843663184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sPerumahan%20Margalaksana%201%2C%20Jalan%20Gunung%20Ciremai%20No.25%2C%20RT.4%2FRW.8%2C%20Margadadi%2C%20%20Indramayu!5e0!3m2!1sid!2sid!4v1732640832030!5m2!1sid!2sid"
                    width="580" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="rounded-2xl overflow-hidden"></iframe>
                <p class="paragraph text-sm font-light leading-relaxed indent-10 line-clamp-4 text-justify">
                    Katering Ibu berlokasi di Perumahan Margalaksana 1, Jalan Gunung Ciremai No.25, RT.4/RW.8, Margadadi,
                    Indramayu
                </p>
            </div>
        </div>
    </section>
@endsection
