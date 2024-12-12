// modal popup konfirmasi delete account
const $modalAndOverlayDeleteAccount = $('.overlay-modal-delete-account');
const $cardModalDeleteAccount = $('#modal-confirm-delete-account');
const $openDeleteAccountModalBtn = $('#deleteAccBtn');
const $closeBtnDeleteAccount = $('.close-modal-btn');
const $cancelBtnDeleteAccount = $('#cancelDeleteAccountBtn');

function showModalDeleteAccount() {
    // Scroll ke atas dengan animasi
    $('html, body').animate({ scrollTop: 0 }, 300, function() {
        $modalAndOverlayDeleteAccount.addClass('grid').removeClass('hidden').fadeIn(300);
        $('body').addClass('overflow-y-hidden');

        // Tambahkan delay untuk animasi card modal
        setTimeout(() => {
            $cardModalDeleteAccount
                .removeClass('opacity-0 translate-y-[10rem]') // Hilangkan efek hidden
                .addClass('opacity-100 translate-y-0 duration-700 ease-in-out'); // Tambahkan animasi smooth
        }, 100);
    });
}


$openDeleteAccountModalBtn.on('click', showModalDeleteAccount);

function closeModalDeleteAccount() {
    $modalAndOverlayDeleteAccount.fadeOut(300);
    $('body').removeClass('overflow-y-hidden');
    $cardModalDeleteAccount.addClass('translate-y-[10rem]').removeClass('translate-y-0');
}

$closeBtnDeleteAccount.on('click', closeModalDeleteAccount);
$cancelBtnDeleteAccount.on('click', closeModalDeleteAccount);

// Menutup modal jika klik di luar area modal
$modalAndOverlayDeleteAccount.on('click', function (event) {
    if (!$(event.target).closest($cardModalDeleteAccount).length) {
        closeModalDeleteAccount();
    }
});
