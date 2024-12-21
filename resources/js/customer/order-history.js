// Buka modal
function openModal(pesananId) {
    $('#pesananId').val(pesananId);
    $('#uploadModal').removeClass('hidden');
}

// Tutup modal
function closeModal() {
    $('#uploadModal').addClass('hidden');
}


// ! pesan / alert ulasan
$(document).ready(function() {
    $('#alert').css('top', '-50px').show().animate({ top: '30px' }, 500).delay(2000).fadeOut(500);
});

// Menampilkan preview file yang diunggah
$('#fileInput').on('change', function() {
    const file = this.files[0];
    const fileName = $('#fileName');
    const filePreview = $('#filePreview');

    if (file) {
        fileName.text(file.name);
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                filePreview.attr('src', e.target.result);
                filePreview.removeClass('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            filePreview.addClass('hidden');
        }
    }
});

