// ! pesan / alert ulasan
$(document).ready(function() {
$('#alert').css('top', '-50px').show().animate({ top: '30px' }, 500).delay(2000).fadeOut(500);
});

var initialTotal = $('#initial_total').val(); // Ambil nilai dari input hidden
var deliveryFee = 20000; // Contoh ongkir

$('#pickup_method').change(function() {
    var deliveryAddressSection = $('#delivery_address_section');
    var shippingCost = $('#shipping_cost');
    var totalCost = $('#total_cost');

    if ($(this).val() === 'delivery') {
        deliveryAddressSection.show();
        shippingCost.text('Rp. ' + deliveryFee.toLocaleString('id-ID'));
        totalCost.text('Rp. ' + (parseInt(initialTotal) + deliveryFee).toLocaleString('id-ID'));
    } else {
        deliveryAddressSection.hide();
        shippingCost.text('Rp. 0');
        totalCost.text('Rp. ' + parseInt(initialTotal).toLocaleString('id-ID'));
    }
});