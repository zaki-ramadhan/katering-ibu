// Function untuk menampilkan alert
const showAlert = (element, message) => {
    $(element).text(message).removeClass('hidden');
};

// Function untuk menyembunyikan alert
const hideAlert = (element) => {
    $(element).addClass('hidden');
};

const passwordInput = $('#password');
const passwordAlert = $('#passwordAlert');

const showPwBtn = $('#show-password-btn'); //icon mata ketutup
const hidePwBtn = $('#hide-password-btn');

passwordInput.on('input', function () {
    let password = passwordInput.val();
    if($(this).val().length > 0) {
        $(showPwBtn).show();
        if($(this).attr('type') === 'text') {
            $(showPwBtn).hide();
            $(hidePwBtn).show();
        } else {
            $(showPwBtn).show();
        }
    } else {
        $(showPwBtn).hide();
        $(hidePwBtn).hide();
    }

    // Validasi password panjang
    if (password.length < 8) {
        showAlert(passwordAlert, 'Password harus lebih dari 8 karakter.');
    } else {
        hideAlert(passwordAlert);
    }
});

passwordInput.on('focus', function () {
    if (passwordInput.val().length < 8) {
        showAlert(passwordAlert, 'Password harus lebih dari 8 karakter.');
    }
});

// Hide alert on blur
$(passwordInput).on('blur', function () {
    hideAlert(passwordAlert);
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
