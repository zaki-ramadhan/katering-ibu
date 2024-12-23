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


// let price = parseFloat($('#total-menu').data('price'));

// $('.increase-btn').on('click', function() {
//     let quantity = parseInt($('#total-menu').val());
//     $('#total-menu').val(quantity + 1);
//     updatePrice(quantity + 1, price);
// });

// $('.decrease-btn').on('click', function() {
//     let quantity = parseInt($('#total-menu').val());
//     if (quantity > 1) {
//         $('#total-menu').val(quantity - 1);
//         updatePrice(quantity - 1, price);
//     }
// });

// $('#total-menu').on('input', function() {
//     let quantity = parseInt($(this).val());
//     if (!isNaN(quantity) && quantity > 0) {
//         updatePrice(quantity, price);
//     }
// });

// function updatePrice(quantity, price) {
//     let totalPrice = quantity * price;
//     $('#total-price').text(totalPrice.toLocaleString('id-ID'));
// }

// $('#total-menu').on('input', function() {
//     let quantity = parseInt($(this).val());
//     if (!isNaN(quantity) && quantity > 0) {
//         updatePrice(quantity, price);
//     } else {
//         // Mengembalikan ke nilai awal jika kosong atau tidak valid
//         $(this).val(1);
//         updatePrice(1, price);
//     }
// });



//! tombol searching ke halaman menu
$('#searchToMenuPageBtn').on('click', function() {
    window.location.href = '/menu?search=true';
});



$(document).ready(function() {
    $('.decrease-btn').on('click', function() {
        updateTotalPrice(-1);
    });

    $('.increase-btn').on('click', function() {
        updateTotalPrice(1);
    });

    $('#jumlah-menu').on('input', function() {
        updateTotalPrice(0);
    });

    function updateTotalPrice(change) {
        var jumlahInput = $('#jumlah-menu');
        var jumlah = parseInt(jumlahInput.val()) + change;
        if (jumlah < 1) {
            jumlah = 1;
        }
        jumlahInput.val(jumlah);

        var harga = parseFloat(jumlahInput.data('price'));
        var totalPrice = jumlah * harga;

        // Perbaiki total harga tanpa tambahan "Rp."
        $('#total-price').text(totalPrice.toLocaleString('id-ID', { style: 'decimal', minimumFractionDigits: 0 }));
    }

    $('.btn-order').on('click', function() {
        var jumlah = $('#jumlah-menu').val();
        $('#jumlah-order-now').val(jumlah);
    });

    $('.btn-add-to-cart').on('click', function() {
        var jumlah = $('#jumlah-menu').val();
        $('#jumlah-add-to-cart').val(jumlah);
    });
});
