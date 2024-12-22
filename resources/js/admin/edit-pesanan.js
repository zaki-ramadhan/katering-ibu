$('#set-today').on('click', function() {
    var today = new Date();
    var day = String(today.getDate()).padStart(2, '0');
    var month = String(today.getMonth() + 1).padStart(2, '0'); // Januari adalah 0!
    var year = today.getFullYear();
    var formattedDate = day + '-' + month + '-' + year; // Format ke DD-MM-YYYY
    $('#delivery_date').val(formattedDate);
});


$(function() {
    $('#delivery_date').datepicker({
        dateFormat: 'dd-mm-yy' // Format sesuai DD-MM-YYYY
    });
});

// Modal menampilkan bukti pembayaran
$('#paymentProofContainer').on('click', function() {
    var imageUrl = $('#existingPaymentProof').attr('src');
    $('#modalImage').attr('src', imageUrl);
    $('#imageModal').removeClass('hidden').addClass('flex');
    $('body').addClass('overflow-hidden'); // Menambah kelas overflow-hidden pada body
});

// Menutup modal ketika tombol close diklik
$('#iconCloseModal, #closeModal').on('click', function() {
    $('#imageModal').removeClass('flex').addClass('hidden');
    $('body').removeClass('overflow-hidden'); // Menghapus kelas overflow-hidden pada body
});

// Menutup modal ketika area luar gambar (overlay) diklik
$('#imageModal').on('click', function(event) {
    if (event.target.id === 'imageModal') {
        $(this).removeClass('flex').addClass('hidden');
        $('body').removeClass('overflow-hidden'); // Menghapus kelas overflow-hidden pada body
    }
});
