// // Chart.js untuk menampilkan tren penjualan
// const ctx = document.getElementById('salesChart').getContext('2d');
// const salesChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
//         datasets: [{
//             label: 'Penjualan',
//             data: [120, 150, 180, 220, 300, 250, 320], // Data contoh, gantikan dengan data aktual
//             borderColor: 'rgba(75, 192, 192, 1)',
//             backgroundColor: 'rgba(75, 192, 192, 0.2)',
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

document.addEventListener('DOMContentLoaded', function() {
    var today = new Date();
    
    // Format waktu saat ini
    var dailyTime = today.toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
    
    // Minggu ini
    var weeklyTime = `Minggu ini (${today.toLocaleDateString('id-ID', { year: 'numeric', month: 'long' })})`;

    // Bulan ini
    var monthlyTime = `Bulan ini (${today.toLocaleDateString('id-ID', { year: 'numeric', month: 'long' })})`;

    // Set waktu ke elemen HTML
    document.getElementById('daily-time').textContent = dailyTime;
    document.getElementById('weekly-time').textContent = weeklyTime;
    document.getElementById('monthly-time').textContent = monthlyTime;
});





document.getElementById('print-button').addEventListener('click', function () {
    // const element = document.getElementById('header-admin');
    const element2 = document.getElementById('highlight-stats');
    // element.style.display = 'none'; // Sembunyikan elemen sebelum mencetak
    element2.style.display = 'none'; // Sembunyikan elemen sebelum mencetak
    this.style.display = 'none'; // Sembunyikan elemen sebelum mencetak
    document.getElementById('daily-time').style.display ='none';
    document.getElementById('weekly-time').style.display ='none';
    document.getElementById('monthly-time').style.display ='none';
    
    window.print();
    
    window.location.reload();
    // window.onafterprint = function () {
    //     // element.style.display = ''; // Sembunyikan elemen sebelum mencetak
    //     // element2.style.display = 'block'; // Sembunyikan elemen sebelum mencetak

    //     // button.style.display = 'block'; // Sembunyikan elemen sebelum mencetak
    // };
});