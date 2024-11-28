// scroll button to top
$('.btn-scroll-top').on('click',()=> {
    $('html, body').animate({ scrollTop: 0 }, 600); // Atur kecepatan scroll
    return false; // Mencegah perilaku default dari tombol
});

// ! ini pindah halaman dari akun pelanggan ke halaman contact us
$(document).ready(function () {
    // Cek jika URL memiliki hash (contoh: #form-section)
    if (window.location.hash) {
        const target = $(window.location.hash); // Ambil elemen dengan ID dari hash
        if (target.length) {
            $('html, body').animate(
                { scrollTop: target.offset().top - 60}, // Scroll ke elemen target
                600 // Durasi animasi (dalam ms)
            );
        }
    }
});
