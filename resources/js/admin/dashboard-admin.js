
// ! pesan / alert ulasan
$(document).ready(function() {
    $('#alert').css('top', '-50px').show().animate({ top: '30px' }, 500).delay(2000).fadeOut(500);
});

$(document).ready(function() {
    $('#statusDropdown').change(function() {
        const status = $(this).val();
        $.ajax({
            url: '{{ route("admin.filter-pesanan") }}',
            type: 'GET',
            data: { status: status },
            success: function(response) {
                $('#pesananList').html(response);
            }
        });
    });
});
