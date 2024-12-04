// memunculkan input search ketika meng-klik label search
$("#label-search-input").on("click",function()  {
    $(".input-container").fadeToggle();
    
    // Logika pengkondisian untuk tombol ketika di klik berdasarkan kelas
    if ($(this).hasClass('text-primary')) {
        $(this).removeClass('text-primary').addClass('text-secondary');
    } else {
        $(this).addClass('text-primary').removeClass('text-secondary');
    }
});


    // data yang bakal dipake sesuaui index order-number
const orderGuides = {
    1: {
        title: "01",
        detail: "Registrasi atau Buat akun Anda terlebih dahulu untuk melakukan pemesanan",
        imagesrc: "sign-up.svg"
    },
    2: {
        title: "02",
        detail: "Pilih menu mana yang akan Anda pesan, lalu buatlah pesanan.",
        imagesrc: "order.svg"
    },
    3: {
        title: "03",
        detail: "Pilih metode pengambilan pesanan yang cocok untuk Anda.",
        imagesrc: "metode-pengambilan.svg"
    },
    4: {
        title: "04",
        detail: "Jika Anda memilih metode pengambilan 'Kirim ke Lokasi Saya', masukkan alamat lokasi Anda.",
        imagesrc: "delivery.svg"
    },
    5: {
        title: "05",
        detail: "Pilih metode pembayaran.",
        imagesrc: "payment-method.svg"
    },
    6: {
        title: "06",
        detail: "Bayar dan kirim bukti bayar pesanan.",
        imagesrc: "payment.svg"
    },
    7: {
        title: "07",
        detail: "Tunggu konfirmasi dari pihak konfirmasi dari pihak Admin Katering Ibu,",
        imagesrc: "discuss-two-people.svg"
    }
}

// order number menyesuaikan dengan index mana yang di klik
$(".order-number").on('click', function() {
    // hanya menambahkan class jika elemen belum aktif
    if(!$(this).hasClass("text-primary")) {
        $(".order-number").removeClass("text-primary");
        $(this).addClass("text-primary");

        $(".main-content-order-guide").show();
        const indexOrderNumClicked = $(this).data("index");
        
        // data orderGuide akan ditampilkan sesuai index nomor brp yang akan diklik
        if(orderGuides[indexOrderNumClicked]) {
            $(".head-order-guide").text(orderGuides[indexOrderNumClicked].title);
            $(".detail-order-guide").text(orderGuides[indexOrderNumClicked].detail);

            const pathDirection = "../../images/"
            $(".order-guide-img").attr('src', `${pathDirection}${orderGuides[indexOrderNumClicked].imagesrc}`)
        }
    }
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

// scroll ke halaman teratas
$('.btn-scroll-top').on('click',()=> {
    $('html, body').animate({ scrollTop: 0 }, 600); // Atur kecepatan scroll
    return false; // Mencegah perilaku default dari tombol
});