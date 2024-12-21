$('#paymentProofInput').on('change', function() {
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#paymentProofPreview').attr('src', e.target.result).removeClass('hidden');
        }
        reader.readAsDataURL(file);
    }
});