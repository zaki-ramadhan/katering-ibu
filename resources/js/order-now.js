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
