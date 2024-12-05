// dropdown link logout
const $profileBtn = $('#profile-btn');
const $logoutBtn = $('#logoutBtn');
const $dropdown = $('.dropdown-profile-menu');

$profileBtn.on('click', function (e) {
    e.stopPropagation(); // Mencegah klik pada tombol memicu event `document`
    $dropdown.toggle(); // Tampilkan atau sembunyikan dropdown

    $('html, body').animate({ scrollTop: 0 }, 300); // Dengan animasi selama 300ms

});

// Tutup dropdown jika klik di mana saja di luar dropdown atau tombol
$(document).on('click', function () {
    $dropdown.hide(); // Sembunyikan dropdown
});

// Mencegah klik di dalam dropdown memicu penutupan
$dropdown.on('click', function (e) {
    e.stopPropagation();
});

$logoutBtn.on('click', function(){
    $dropdown.hide();
})


// modal popup konfirmasi logout
const $modalAndOverlay = $('.overlay-modal');
const $cardModal = $('#modal-confirm-logout');
const $closeBtn = $('.close-modal-btn');
const $cancelBtn = $('#cancelLogoutBtn');

function showModal() {
    $modalAndOverlay.addClass('grid').removeClass('hidden').fadeIn(300);
    $('body').addClass('overflow-y-hidden');

    // Tambahkan delay untuk animasi card modal
    setTimeout(() => {
        $cardModal
            .removeClass('opacity-0 translate-y-[10rem]') // Hilangkan efek hidden
            .addClass('opacity-100 translate-y-0 duration-700 ease-in-out'); // Tambahkan animasi smooth
    }, 100); 
}

$logoutBtn.on('click', showModal);

function closeModal() {
    $modalAndOverlay.fadeOut(300);
    $('body').removeClass('overflow-y-hidden');
    $cardModal.addClass('translate-y-[10rem]').removeClass('translate-y-0');
}

$closeBtn.on('click', closeModal);
$cancelBtn.on('click', closeModal);

// Menutup modal jika klik di luar area modal
$modalAndOverlay.on('click', function (event) {
    if (!$(event.target).closest($cardModal).length) {
        closeModal();
    }
})