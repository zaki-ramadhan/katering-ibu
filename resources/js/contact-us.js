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

// ! alternatif scroll ke form section biar pas ke tengah
$('a.scroll-to').on('click', function(e) {
    e.preventDefault();
    const target = $(this.getAttribute('href'));
    if(target.length) {
        $('html, body').stop().animate({ scrollTop: target.offset().top - 50 // Sesuaikan nilai offset (100) dengan kebutuhan Anda
                },600); // Durasi animasi dalam milidetik (1000 = 1 detik) } });
            }
        }
    )
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


// ! pesan / alert ulasan
$(document).ready(function() {
    $('#alert').css('top', '-50px').show().animate({ top: '30px' }, 500).delay(2000).fadeOut(500);
});
