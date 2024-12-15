// ! pesan / alert
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
$(passwordInput).on('blur', function () {
    if($(this).attr('type', 'text')) {
        $(hidePwBtn).hide();
        $(showPwBtn).show();

        $(this).attr('type', 'password');
    }
});

$(passwordConfirmInput).on('blur', function () {
    if($(this).attr('type', 'text')) {
        $(hideConfirmPwBtn).hide();
        $(showConfirmPwBtn).show();

        $(this).attr('type', 'password');
    }
});

// switch eye btn
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

$(showConfirmPwBtn).on('click', function() {
    $(this).hide();
    $(hideConfirmPwBtn).show();

    $(passwordConfirmInput).attr('type', 'text').focus();
})

$(hideConfirmPwBtn).on('click', function() {
    $(this).hide();
    $(showConfirmPwBtn).show();

    $(passwordConfirmInput).attr('type', 'password').focus();
})