// ! scroll button to top
// Sembunyikan tombol pada awalnya
$('.btn-scroll-top').hide();

// Fungsi untuk memantau scroll
$(window).scroll(function() {
    // Mendapatkan tinggi viewport
    let vh = $(window).height();
    
    // Memeriksa apakah scroll sudah mencapai 100% dari tinggi viewport
    if ($(window).scrollTop() >= vh) {
        $('.btn-scroll-top').fadeIn(600);
    } else {
        $('.btn-scroll-top').fadeOut(600);
    }
});

// scroll ke halaman teratas
$('.btn-scroll-top').on('click',()=> {
    $('html, body').animate({ scrollTop: 0 }, 600); // Atur kecepatan scroll
    return false; // Mencegah perilaku default dari tombol
});

// ! slider (history content)
const $track = $('.slider-track'); // Track slider
const $images = $('.slider-track img'); // Semua gambar
const slideWidth = $images.first().outerWidth(); // Lebar gambar
let currentIndex = 0; // Index awal gambar
const totalSlides = $images.length; // Total jumlah gambar

// Fungsi untuk update posisi slider
function updateSlider() {
    const newTransform = `-${currentIndex * slideWidth}px`;
    $track.css('transform', `translateX(${newTransform})`);
}

// Tombol Next
$('#prevBtn').on('click', function () {

    // kalo belum min
    if (currentIndex > 0) {
        currentIndex--;
        updateSlider();
        $('#nextBtn').prop('disabled', false); // Pastikan tombol Next aktif jika diperlukan
    }

    // kalo udh min
    if (currentIndex === 0) {
        $('#nextBtn').show();
        $(this).hide();
        $(this).prop('disabled', true); // Nonaktifkan tombol Prev menggunakan this
    }
});

$('#nextBtn').on('click', function () {
    
    // kalo belum max
    if (currentIndex < totalSlides - 1) {
        currentIndex++;
        updateSlider();
        $('#prevBtn').prop('disabled', false); // Pastikan tombol Prev aktif jika diperlukan
    }
    // kalo udh max
    if (currentIndex === totalSlides - 1) {
        $('#prevBtn').show();
        $(this).hide();
        $(this).prop('disabled', true); // Nonaktifkan tombol Next menggunakan this
    }
});

// read-more btn
$('.read-more-btn').on('click', function() {
    const targetText = $('.paragraph');
    const textInBtn = $(this).find('.text');
    const arrowIcon = $(this).find('.arrow-icon');
    
    $(targetText).toggleClass('line-clamp-4');
    $(arrowIcon).toggleClass('rotate-180 translate-y-[1px]');
    
    if ($(targetText).hasClass('line-clamp-4')) {
        $(textInBtn).html('Baca selengkapnya');
    } else {
        $(textInBtn).html('Baca lebih sedikit');
    }
});

// ! animation bubblechat



// ! sweep content
const historyContentWrapper = $('#history');
const locationContentWrapper = $('#location');
const hisBtn = $('#historyBtn');
const locBtn = $('#locationBtn');

function sweepToLocation() {
    historyContentWrapper.hide();
    locationContentWrapper.show();

    setTimeout(() => {
        const position = locationContentWrapper.offset().top - 20; // Kurangi 20px (atau sesuai kebutuhan)
        $('html, body').animate({ scrollTop: position }, 800); // 500ms untuk animasi scroll
    }, 300);
}

function resweepToHistory() {
    historyContentWrapper.show();
    locationContentWrapper.hide();

    setTimeout(() => {
        const position = historyContentWrapper.offset().top - 20; // Kurangi 20px (atau sesuai kebutuhan)
        $('html, body').animate({ scrollTop: position }, 800);
    }, 300);
}



$(locBtn).on('click', function(){
   sweepToLocation();
   $(this)
   .removeClass('bg-slate-100 hover:bg-slate-200/70 hover:shadow-slate-300 active:bg-slate-100 active:shadow-slate-100')
   .addClass('active bg-primary hover:bg-primary-600 hover:shadow-slate-400 hover:border active:bg-primary active:shadow-slate-100 text-white')
   
   if($(hisBtn).hasClass('active')) {
       $(hisBtn)
       .removeClass('active bg-primary hover:bg-primary-600 hover:shadow-slate-400 hover:border active:bg-primary active:shadow-slate-100 text-white')
       .addClass('bg-slate-100 hover:bg-slate-200/70 hover:shadow')
    }
})

$(hisBtn).on('click', function(){
    resweepToHistory();
    $(this).addClass('active')
    .removeClass('bg-slate-100 hover:bg-slate-200/70 hover:shadow-slate-300 active:bg-slate-100 active:shadow-slate-100')
    .addClass('active bg-primary hover:bg-primary-600 hover:shadow-slate-400 hover:border active:bg-primary active:shadow-slate-100 text-white')
    
    if($(locBtn).hasClass('active')) {
        $(locBtn).removeClass('active')
        .removeClass('active bg-primary hover:bg-primary-600 hover:shadow-slate-400 hover:border active:bg-primary active:shadow-slate-100 text-white')
        .addClass('bg-slate-100 hover:bg-slate-200/70 hover:shadow')
    }
})