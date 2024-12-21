$('#paymentProofInput').on('change', function() {
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#noPaymentProof').remove();
            if ($('#existingPaymentProof').length) {
                $('#existingPaymentProof').attr('src', e.target.result);
            } else {
                $('#paymentSection').append('<div id="paymentProofContainer" class="w-96 h-auto aspect-video overflow-hidden mt-2 mb-2"><img id="existingPaymentProof" src="' + e.target.result + '" class="w-96 h-auto aspect-video object-cover rounded mb-3"></div>');
            }
        }
        reader.readAsDataURL(file);
    }
});