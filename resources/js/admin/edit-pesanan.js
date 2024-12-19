$('#set-today').click(function() {
    var today = new Date().toISOString().split('T')[0];
    $('#delivery_date').val(today);
});