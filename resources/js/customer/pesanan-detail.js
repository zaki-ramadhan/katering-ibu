// ! pesan / alert ulasan
$(document).ready(function() {
$('#alert').css('top', '-50px').show().animate({ top: '30px' }, 500).delay(2000).fadeOut(500);
});


$(document).ready(function() {
    $('#payment_method').on('change', function() {
        var selectedMethod = $(this).val();
        if (selectedMethod === 'Cash') {
            $('#payment_instruction').addClass('hidden');
            $('#bank_bri_instruction').addClass('hidden');
            $('#dana_instruction').addClass('hidden');
            $('#alert-wrapper').addClass('hidden').removeClass('flex');
        } else {
            $('#payment_instruction').removeClass('hidden');
                $('#bank_bri_instruction').removeClass('hidden');
                $('#dana_instruction').removeClass('hidden');
                $('#alert-wrapper').removeClass('hidden').addClass('flex');
        }
    });

    // Inisiasi pemilihan metode pembayaran saat halaman dimuat
    $('#payment_method').trigger('change');
});



var initialTotal = $('#initial_total').val(); // Ambil nilai dari input hidden
var deliveryFee = 20000; // Contoh ongkir

$('#pickup_method').change(function() {
    var deliveryAddressSection = $('#delivery_address_section');
    var shippingCost = $('#shipping_cost');
    var totalCost = $('#total_cost');

    if ($(this).val() === 'Delivery') {
        deliveryAddressSection.show();
        shippingCost.text('Rp. ' + deliveryFee.toLocaleString('id-ID'));
        totalCost.text('Rp. ' + (parseInt(initialTotal) + deliveryFee).toLocaleString('id-ID'));
    } else {
        deliveryAddressSection.hide();
        shippingCost.text('-');
        totalCost.text('Rp. ' + parseInt(initialTotal).toLocaleString('id-ID'));
    }
});