// pesan / alert
$(document).ready(function() {
    $('#alert').css('top', '-50px').show().animate({ top: '30px' }, 500).delay(2000).fadeOut(500);
});

// show hide pw
const passwordInput = $('#password');
const passwordConfirmInput = $('#password_confirmation');

const showPwBtn = $('#show-password-btn'); //icon mata ketutup
const hidePwBtn = $('#hide-password-btn');
const showConfirmPwBtn = $('#show-confirm-password-btn'); //icon mata ketutup
const hideConfirmPwBtn = $('#hide-confirm-password-btn');

// Hide alert on blur
// ? pw input
$(passwordInput).on('input', function() {
    if($(this).val().length > 0) {
        $(showPwBtn).show();
        if($(this).attr('type') === 'text') {
            $(showPwBtn).hide();
        } else {
            $(showPwBtn).show();
        }
    } else {
        $(showPwBtn).hide();
        $(hidePwBtn).hide();

        $(this).attr('type', 'password');
    }
})


$(passwordInput).on('blur', function () {
    if($(this).val().length < 1) {
        $(showPwBtn).hide();
    } else {
        if($(this).attr('type', 'text')) {
            $(hidePwBtn).hide();
            $(showPwBtn).show();
            
            $(this).attr('type', 'password');
        }
    }
});

// ? switch eye btn
$(showPwBtn).on('click', function() {
    $(this).hide();
    $(hidePwBtn).show();
    
    $(passwordInput).attr('type', 'text').focus();
})

$(hidePwBtn).on('click', function() {
    $(this).hide();
    $(showPwBtn).show();
    
    $(passwordInput).attr('type', 'password').focus();
})


// ? confirm pw input
$(passwordConfirmInput).on('input', function() {
    if($(this).val().length > 0) {
        $(showConfirmPwBtn).show();
        if($(this).attr('type') === 'text') {
            $(showConfirmPwBtn).hide();
        } else {
            $(showConfirmPwBtn).show();
        }
    } else {
        $(showConfirmPwBtn).hide();
        $(hideConfirmPwBtn).hide();

        $(this).attr('type', 'password');
    }
})


$(passwordConfirmInput).on('blur', function () {
    if($(this).val().length < 1) {
        $(showConfirmPwBtn).hide();
    } else {
        if($(this).attr('type', 'text')) {
            $(hideConfirmPwBtn).hide();
            $(showConfirmPwBtn).show();
            
            $(this).attr('type', 'password');
        }
    }
});


// ? switch eye btn confirm inputa
$(showConfirmPwBtn).on('click', function() {
    $(this).hide();
    $(hideConfirmPwBtn).show();
    
    $(passwordConfirmInput).attr('type', 'text').focus();
})

$(hidePwBtn).on('click', function() {
    $(this).hide();
    $(showConfirmPwBtn).show();
    
    $(passwordConfirmInput).attr('type', 'password').focus();
})