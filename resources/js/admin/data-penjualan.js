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