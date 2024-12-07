// modal popup konfirmasi hapus
const $modalAndOverlay = $('.overlay-modal-delete');
const $cardModal = $('#modal-confirm-delete');
const $closeBtn = $('.close-modal-btn');
const $cancelBtn = $('#cancelDeleteBtn');

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

$('.delete-btn').on('click', function() {
    var id = $(this).data('id');
    var deleteUrl = '/admin/data-ulasan/' + id;
    $('#delete-form').attr('action', deleteUrl);
    showModal();
});

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
});
