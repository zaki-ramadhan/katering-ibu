<?php
// Data array (Contoh data)
$data = [
    [
        "created_date" => "2024-11-29",
        "name" => "John Doe",
        "menus" => ["Nasi Goreng", "Ayam Bakar"],
        "portions" => [2, 1],
        "total_price" => 500000,
        "pickup_method" => "Kirim",
        "address" => "Jl. Merdeka No. 10, Jakarta",
        "payment_method" => "Transfer",
        "status" => "Menunggu"
    ],
    [
        "created_date" => "2024-11-28",
        "name" => "Jane Smith",
        "menus" => ["Sate Ayam", "Gado-Gado"],
        "portions" => [3, 2],
        "total_price" => 350000,
        "pickup_method" => "Ambil",
        "address" => "-",
        "payment_method" => "Cash",
        "status" => "Selesai"
    ],
    [
        "created_date" => "2024-11-27",
        "name" => "James Brown",
        "menus" => ["Mie Goreng", "Soto Ayam"],
        "portions" => [1, 1],
        "total_price" => 200000,
        "pickup_method" => "Kirim",
        "address" => "Jl. Sudirman No. 20, Bandung",
        "payment_method" => "Transfer",
        "status" => "Dalam Antrian"
    ],
    [
        "created_date" => "2024-11-26",
        "name" => "Emily Davis",
        "menus" => ["Burger", "Kentucky Fried Chicken"],
        "portions" => [1, 2],
        "total_price" => 400000,
        "pickup_method" => "Ambil",
        "address" => "-",
        "payment_method" => "Cash",
        "status" => "Diproses"
    ],
    [
        "created_date" => "2024-11-25",
        "name" => "Michael Johnson",
        "menus" => ["Pizza", "Pasta"],
        "portions" => [2, 1],
        "total_price" => 600000,
        "pickup_method" => "Kirim",
        "address" => "Jl. Kuningan No. 15, Jakarta",
        "payment_method" => "Transfer",
        "status" => "Selesai"
    ],
    [
        "created_date" => "2024-11-24",
        "name" => "Sarah Lee",
        "menus" => ["Nasi Goreng", "Mie Ayam"],
        "portions" => [1, 1],
        "total_price" => 250000,
        "pickup_method" => "Kirim",
        "address" => "Jl. Sumeru No. 12, Yogyakarta",
        "payment_method" => "Transfer",
        "status" => "Menunggu"
    ],
    [
        "created_date" => "2024-11-23",
        "name" => "David Kim",
        "menus" => ["Sushi", "Ramen"],
        "portions" => [2, 1],
        "total_price" => 450000,
        "pickup_method" => "Ambil",
        "address" => "-",
        "payment_method" => "Cash",
        "status" => "Diproses"
    ],
    [
        "created_date" => "2024-11-22",
        "name" => "Anna White",
        "menus" => ["Tacos", "Burritos"],
        "portions" => [2, 3],
        "total_price" => 350000,
        "pickup_method" => "Kirim",
        "address" => "Jl. Raya No. 18, Bali",
        "payment_method" => "Transfer",
        "status" => "Selesai"
    ],
    [
        "created_date" => "2024-11-21",
        "name" => "Chris Green",
        "menus" => ["Kebab", "Falafel"],
        "portions" => [1, 2],
        "total_price" => 300000,
        "pickup_method" => "Ambil",
        "address" => "-",
        "payment_method" => "Cash",
        "status" => "Dalam Antrian"
    ],
    [
        "created_date" => "2024-11-20",
        "name" => "Laura Black",
        "menus" => ["Curry", "Rice"],
        "portions" => [1, 1],
        "total_price" => 220000,
        "pickup_method" => "Kirim",
        "address" => "Jl. Anggrek No. 22, Jakarta",
        "payment_method" => "Transfer",
        "status" => "Sedang Dalam Pengiriman"
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard Admin</title>
        
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css" />

        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit-icons.min.js"></script>
        
        {{-- scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/dashboard-admin.js', 'resources/js/components/modal-logout.js', 'resources/js/components/sidebar-admin.js', 'resources/js/components/header-admin.js'])

        <!-- Load JavaScript libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
        

        <style>
            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
                appearance: none;
            }
            .cover {
                background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='80' height='80' patternTransform='scale(2) rotate(0)'><rect x='0' y='0' width='100%' height='100%' fill='%23334155ff'/><path d='M0 0v40h40V0H0zm40 40v40h40V40H40zM4 4h32v32H4V4zm4 4v24h24V8H8zm4 4h16v16H12V12zm4.043 3.988v8.004h8.004v-8.004h-8.004zM44 44h32v32H44V44zm4 4v24h24V48H48zm4 4h16v16H52V52zm4.043 3.984v8.006h8.004v-8.006h-8.004z'  stroke-width='1' stroke='none' fill='%23cbd5e1ff'/><path d='M44 4v32h32V4H44zm4 4h24v24H48V8zm4 4v16h16V12H52zm4 4h8v8h-8v-8zM4 44v32h32V44H4zm4 4h24v24H8V48zm4 4v16h16V52H12zm4 4h8v8h-8v-8z'  stroke-width='1' stroke='none' fill='%2394a3b8ff'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>")
            }

            /* menghilangkan scrolll bar */
            .items-wrapper {
                scrollbar-width: none; /* Menjadikan scrollbar lebih kecil */
                scrollbar-color: #888 #f1f1f1; /* Warna scrollbar dan track */
            }

            
        </style>

    </head>
    <body class="font-inter bg-red-500 sm:bg-tertiary md:bg-primary-600">

        <x-header-admin></x-header-admin>
        <x-modal-logout></x-modal-logout>

        <main id="main-section" class="container px-8 flex flex-col gap-6 pb-16">
            <div class="relative overflow-x-auto shadow-lg shadow-slate-200 border rounded-2xl">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Tanggal memesan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Menu yang Dipesan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Porsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Harga
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Metode Pengambilan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Metode Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $order)
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $order['created_date'] }}    
                                </th>
                                <td class="px-6 py-4">
                                    {{ implode(', ', $order['menus']) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ implode(', ', $order['portions']) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($order['total_price'], 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $order['pickup_method'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order['pickup_method'] == 'Kirim' ? $order['address'] : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order['payment_method'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order['status'] }}
                                </td>
                                <td class="px-6 py-4 text-center flex flex-col items-end justify-end gap-2">
                                    <a href="#" class="font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-amber-400  hover:bg-amber-300 active:bg-amber-400">Edit</a>
                                    <a href="#" class="font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-red-500 hover:bg-red-400 active:bg-red-500">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
