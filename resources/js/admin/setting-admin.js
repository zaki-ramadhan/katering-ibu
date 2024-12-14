// Function untuk menampilkan alert
const showAlert = (element, message) => {
    element.innerText = message;
    element.classList.remove('hidden');
};

// Function untuk menyembunyikan alert
const hideAlert = (element) => {
    element.classList.add('hidden');
};

const passwordInput = document.getElementById('password');
const passwordAlert = document.getElementById('passwordAlert');

const showPwBtn = $('#show-password-btn'); //icon mata ketutup
const hidePwBtn = $('#hide-password-btn');

passwordInput.addEventListener('input', function () {
    let password = passwordInput.value;

    // Validasi password panjang
    if (password.length < 8) {
        showAlert(passwordAlert, 'Password harus lebih dari 8 karakter.');
    } else {
        hideAlert(passwordAlert);
    }
});



passwordInput.addEventListener('focus', function () {
    if (passwordInput.value.length < 8) {
        showAlert(passwordAlert, 'Password harus lebih dari 8 karakter.');
    }
});

// Hide alert on blur
passwordInput.addEventListener('blur', function () {
    hideAlert(passwordAlert);

    if($(passwordInput).attr('type', 'text')) {
        $(hidePwBtn).hide();
        $(showPwBtn).show();

        $(passwordInput).attr('type', 'password');
    }
});


// show hide pw
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