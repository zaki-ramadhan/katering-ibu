// scripts.js

// Fungsi untuk menampilkan pesan ketika tombol diklik
function showAlert() {
    alert("Terima kasih telah mengunjungi Katering Ibu!");
}

// Menambahkan event listener ke tombol
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('alertButton');
    if (button) {
        button.addEventListener('click', showAlert);
    }
});
