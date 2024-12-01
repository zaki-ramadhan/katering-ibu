$('#foto_menu').on('change', function(event) {
    var file = event.target.files[0];  // Ambil file pertama yang dipilih
    var $filePreview = $('#foto_menu-preview');
    var $fileDropText = $('#foto_menu-drop-text');

    // Cek apakah file sudah ada (dari sebelumnya) dan reset input jika ada
    if (event.target.files.length > 1) {
        alert('Hanya satu file yang diperbolehkan!');
        $(this).val('');  // Reset input
        $filePreview.addClass('hidden');
        $fileDropText.removeClass('hidden');
        return;  // Keluar dari fungsi
    }

    if (file) {
        // Cek apakah file adalah gambar
        if (file.type.match('image.*')) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $filePreview.attr('src', e.target.result);
                $filePreview.removeClass('hidden');
                $fileDropText.addClass('hidden');
            }

            reader.readAsDataURL(file);
        } else {
            alert('Silakan pilih file gambar');
            $(this).val('');  // Reset input
            $filePreview.addClass('hidden');
            $fileDropText.removeClass('hidden');
        }
    }
});

// error kalo file upload ga sesuai
$('#foto_menu').on('change', function (event) {
    var file = event.target.files[0];
    var $preview = $('#foto_menu-preview');
    var $dropText = $('#foto_menu-drop-text');
    var $errorText = $('.text-error');

    if (file) {
        // Reset error
        $errorText.addClass('hidden');

        // Validasi tipe file
        var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            $errorText.text('**Format file harus jpeg, jpg, atau png.').removeClass('hidden');
            $(this).val(''); // Reset input
            return;
        }

        // Validasi ukuran file
        var maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            $errorText.text('**Ukuran file tidak boleh melebihi 2MB.').removeClass('hidden');
            $(this).val(''); // Reset input
            return;
        }

        // Jika valid, tampilkan preview gambar
        var reader = new FileReader();
        reader.onload = function (e) {
            $preview.attr('src', e.target.result).removeClass('hidden');
            $dropText.addClass('hidden');
        };
        reader.readAsDataURL(file);
    }
});



