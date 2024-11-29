const sidebarWrapper = $('#sidebar-admin-wrapper');
const sidebar = $('.sidebar');

// open sidebar
// Open sidebar
$('#up-menu-btn').on('click', function() {
    // Gulir halaman ke atas
    $('html, body').animate({ scrollTop: 0 }, 300); // Dengan animasi selama 300ms
    // Tambahkan overflow-hidden untuk mencegah scroll halaman
    $('body').addClass('overflow-hidden');
    // Tampilkan sidebar
    $(sidebarWrapper).removeClass('hidden').fadeIn(300);
    setTimeout(() => {
        $(sidebar).removeClass('-translate-x-full');
    }, 300);
});

// close sidebar
$('#side-menu-btn').on('click', function() {
    $(sidebar).addClass('-translate-x-full')
    $(sidebarWrapper).fadeOut(300);
});

// Tutup sidebar ketika klik di luar area sidebar
sidebarWrapper.on('click', function (e) {
    $('body').removeClass('overflow-hidden')
    // Cek jika area yang diklik adalah sidebar
    if (!$(e.target).closest(sidebar).length) {
        sidebar.addClass('-translate-x-full'); // Geser sidebar keluar
        setTimeout(() => {
            sidebarWrapper.fadeOut(300); // Sembunyikan wrapper
        }, 100); // Waktu transisi sama seperti durasi Tailwind
    }
});