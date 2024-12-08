$('.opened-eye').on('click', function(){
    alert('opened eye')
})

$('.closed-eye').on('click', function(){
    alert('closed eye')
});

// ! pesan / alert success
$(document).ready(function() {
    $('#alert').css('top', '-50px').show().animate({ top: '30px' }, 500).delay(2000).fadeOut(500);
});