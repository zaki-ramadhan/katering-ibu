// read more btn
$(".read-more-btn").on("click", function(){
    const dArrowIcon = (".down-arrow-icon");
    const menuDesc = (".menu-description");
    const innerTextRMBtn = (".text-rm-btn");

    $(this).toggleClass('text-secondary text-primary');
    $(menuDesc).toggleClass('line-clamp-4');
    $(dArrowIcon).toggleClass('rotate-180 opened');        

    $(innerTextRMBtn).text(!$(dArrowIcon).hasClass('opened') ? 'Lihat Lebih Sedikit' : 'Lihat Selengkapnya');

})

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

// scroll button to top
$('.btn-scroll-top').on('click',()=> {
    $('html, body').animate({ scrollTop: 0 }, 600); // Atur kecepatan scroll
    return false; // Mencegah perilaku default dari tombol
});

// Increment total menu
$('.increase-btn').on('click', function() {
    // Ambil nilai saat ini dari input
    let inputValue = parseInt($('#total-menu').val()) || 0; // Jika kosong, set 0
    // Tambahkan 1 ke nilai input
    inputValue++;
    // Set nilai baru ke input
    $('#total-menu').val(inputValue);
});

// Decrement total menu
$('.decrease-btn').on('click', function() {
    // Ambil nilai saat ini dari input
    let inputValue = parseInt($('#total-menu').val()) || 0; // Jika kosong, set 0
    // Kurangi 1 dari nilai input, tetapi pastikan tidak negatif
    inputValue = inputValue > 1 ? inputValue - 1 : 1;
    // Set nilai baru ke input
    $('#total-menu').val(inputValue);
});


//! tombol searching ke halaman menu
$('#searchToMenuPageBtn').on('click', function() {
    window.location.href = '/menu?search=true';
});

