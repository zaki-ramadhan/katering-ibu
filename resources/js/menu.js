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

// memunculkan tanda clear input kalo di inputnya tidak kosong
$("#search-menu").on('input',function(){
    if($(this).val().length > 0) {
        $("#clear-btn").show();
    } else {
        $("#clear-btn").hide();
    }
})


// clear btn bakalan hilang  dan menghapus value inputketika di clear
$("#clear-btn").on('click', function () {
    $(this).hide();
    $("#search-menu").val(null);
})



// Array untuk gonta-ganti placeholder
const placeholders = [
    "Cari Baso Ikan?",
    "Cari Nasi Ayam?",
    "Cari Nasi Bakar?",
    "Cari Nasi Kuning?",
    "Cari Nasi Liwet?",
    "Cari Paket Nasi Kuning Tampahan?",
    "Cari Paket Nasi Liwet Tampahan?"
];

let indexPlaceholder = 0;
let intervalId; // Menyimpan ID interval untuk menghapus interval ketika blur

const inputSearchMenu = "#search-menu";

// Fungsi untuk mengganti placeholder
function changePlaceholder() {
    $(inputSearchMenu).attr("placeholder", placeholders[indexPlaceholder]);
    indexPlaceholder = (indexPlaceholder + 1) % placeholders.length;
}

// kalo fokus baru jalanin ganti placeholdernya
$(inputSearchMenu).on('focus', function () {
    // program tambahan, search label (icon) bakal berubah warna
    $("#search-label").removeClass("text-secondary"); 
    $("#search-label").addClass("text-primary"); 
    
    const delayTime = 1000; // nilai delay buat sebelum function mulai
    
    setTimeout(() => {
        // ganti placeholder tiap 3 dtk
        intervalId = setInterval(changePlaceholder, 1500); 
        changePlaceholder(); // Ganti placeholder pertama kali
    }, delayTime);
});

// input ga fokus, berhentikan function ganti placeholder dan kembali keawal
$(inputSearchMenu).on('blur', function () {
    // program tambahan
    $("#search-label").addClass("text-secondary"); 
    $("#search-label").removeClass("text-primary"); 

    // Hentikan interval saat input kehilangan fokus
    clearInterval(intervalId);

    // Balikin placeholder ke default
    $(inputSearchMenu).attr("placeholder", "Cari menu favoritmu disini...");
});


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

// ! pindah halaman dari ordernow ke halaman menu
$(document).ready(function () {
    // Cek jika URL memiliki hash (contoh: #form-section)
    if (window.location.hash) {
        const target = $(window.location.hash); // Ambil elemen dengan ID dari hash
        if (target.length) {
            $('html, body').animate(
                { scrollTop: target.offset().top - 250}, // Scroll ke elemen target
                600 // Durasi animasi (dalam ms)
            );
        }
    }
    $('#search-menu').on('focus');
});



// ? modal tombol keranjang
$(document).ready(function() {
    // Fungsi untuk memformat angka ke Rupiah
    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).replace('IDR', 'Rp');
    }

    // Tampilkan modal saat tombol keranjang ditekan
    $('.btn-add-to-cart').on('click', function() {
        const menuId = $(this).data('menu-id'); // Ambil menu ID dari atribut data
        const menuName = $(this).data('menu-name'); // Ambil nama menu dari atribut data
        const menuPhoto = $(this).data('menu-photo'); // Ambil foto menu dari atribut data
        const menuPrice = $(this).data('menu-price'); // Ambil harga menu dari atribut data

        $('#menu_id').val(menuId); // Setel nilai menu ID di input hidden
        $('#menu_nama').text(menuName); // Tampilkan nama menu di modal
        $('#menu_foto').attr('src', menuPhoto); // Tampilkan foto menu di modal
        $('#menu_harga').text(formatRupiah(menuPrice)).data('menu-price', menuPrice); // Tampilkan harga menu di modal dan simpan data harga

        const jumlah = $('#jumlah').val(); // Ambil nilai input jumlah
        const totalHarga = jumlah * menuPrice; // Hitung total harga
        $('#total_harga').text('Total: ' + formatRupiah(totalHarga)); // Tampilkan total harga

        $('#cartModal').removeClass('hidden'); // Tampilkan modal
    });

    // Update total harga saat jumlah porsi berubah
    $('#jumlah').on('input', function() {
        const jumlah = $(this).val();
        const menuPrice = $('#menu_harga').data('menu-price'); // Ambil harga dari data yang disimpan
        const totalHarga = jumlah * menuPrice;
        $('#total_harga').text('Total: ' + formatRupiah(totalHarga));
    });

    // Tutup modal saat tombol batal ditekan
    $('.modal-close').on('click', function() {
        $('#cartModal').addClass('hidden'); // Sembunyikan modal
    });

    // Tutup modal saat klik di luar modal
    $(window).on('click', function(event) {
        if ($(event.target).is('#cartModal')) {
            $('#cartModal').addClass('hidden'); // Sembunyikan modal
        }
    });
});
