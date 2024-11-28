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
        intervalId = setInterval(changePlaceholder, 3000); 
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



// btn add to cart
$(".btn-add-to-cart").on('click', ()=> {
    alert("Menu berhasil ditambahkan ke keranjang Anda\nPergi ke halaman 'Keranjang Saya'\nuntuk melihat menu yang sudah Anda tambahkan di keranjang Anda.")
})


// scroll button to top
$('.btn-scroll-top').on('click',()=> {
    $('html, body').animate({ scrollTop: 0 }, 600); // Atur kecepatan scroll
    return false; // Mencegah perilaku default dari tombol
});