$('#set-today').on('click', function() {
    var today = new Date();
    var formattedDate = today.toISOString().split('T')[0]; // Format YYYY-MM-DD
    $('#delivery_date').val(formattedDate);
});

$(function() {
    $('#delivery_date').datepicker({ dateFormat: 'yy-mm-dd' }); // Format sesuai input type="date"
});