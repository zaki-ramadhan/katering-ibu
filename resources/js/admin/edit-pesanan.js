$('#set-today').on('click', function() {
    let today = new Date();
    let day = String(today.getDate()).padStart(2, '0');
    let month = String(today.getMonth() + 1).padStart(2, '0'); // Januari adalah 0!
    let year = today.getFullYear();
    let formattedDate = day + '-' + month + '-' + year; // Format ke DD-MM-YYYY
    $('#delivery_date').val(formattedDate);
});


$(function() {
    $('#delivery_date').datepicker({
        dateFormat: 'dd-mm-yy' // Format sesuai DD-MM-YYYY
    });
});






// if ($('#status_payment_proof').val() === 'Accepted') {
//     $('#status option[value="Processed"]').removeClass('hidden');
//     $('#status option[value="Completed"]').removeClass('hidden');
// } else {
//     $('#status option[value="Processed"]').addClass('hidden');
//     $('#status option[value="Completed"]').addClass('hidden');
//     // Set the status to Pending or any default status
//     $('#status').val('Pending');
// }

// // select option
// $('#status_payment_proof').on('change', function() {
//     let status = $(this).val();
//     if (status == 'Accepted') {
//         $('#status option[value="Processed"]').removeClass('hidden');
//         $('#status option[value="Completed"]').removeClass('hidden');
//     } else {
//         $('#status option[value="Processed"]').addClass('hidden');
//         $('#status option[value="Completed"]').addClass('hidden');
//         // Set the status to Pending or any default status
//         $('#status').val('Pending');
//     }
// });


// Modal menampilkan bukti pembayaran
$('#paymentProofContainer').on('click', function() {
    let imageUrl = $('#existingPaymentProof').attr('src');
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
