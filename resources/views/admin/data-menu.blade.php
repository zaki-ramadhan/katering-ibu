<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Menu</title>
        
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
            <div class="head-btn-wrapper flex justify-between items-center px-3 mt-8">
                {{-- <h1 class="font-medium text-lg text-primary">Jumlah data menu saat ini : {{ $jumlahMenu }}</h1> --}}
                <a href="{{ route('admin.create-menu') }}" class="w-max text-sm rounded-lg py-3 px-6 bg-emerald-500 hover:bg-emerald-600 text-white hover:text-white">
                    <button>Tambah Menu</button>
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-lg shadow-slate-200 border rounded-2xl">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id Menu
                             </th>
                            <th scope="col" class="px-6 py-3">
                                Foto Menu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Menu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deskripsi Menu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga per porsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menu as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <!-- Menampilkan nama_menu -->
                            <td class="px-6 py-4">
                                {{ $item->id }}
                            </td>
                            <!-- Menampilkan foto_menu -->
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($item->foto_menu) }}" alt="Foto Menu" class="min-w-32 aspects-square object-cover rounded-2xl">
                            </td>

                            <!-- Menampilkan nama_menu -->
                            <td class="px-6 py-4">
                                {{ $item->nama_menu }}
                            </td>

                            <!-- Menampilkan deskripsi -->
                            <td class="px-6 py-4 min-w-60">
                                {{ Str::limit($item->deskripsi, 50) }} <!-- Menampilkan deskripsi dengan batasan 50 karakter -->
                            </td>

                            <!-- Menampilkan harga -->
                            <td class="px-6 py-4">
                                {{ number_format($item->harga, 0, ',', '.') }} <!-- Format harga dengan pemisah ribuan -->
                            </td>

                            <!-- Kolom aksi (Edit dan Hapus) -->
                            <td class="px-6 py-4 text-center flex flex-col items-end justify-end gap-2">
                                <!-- Tombol Edit -->
                                {{-- {{ route('menu.edit', $item->id) }} --}}
                                <a href="" class="font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-amber-400 hover:bg-amber-300 active:bg-amber-400">
                                    Edit
                                </a>

                                <!-- Tombol Hapus -->
                                {{-- {{ route('menu.destroy', $item->id) }} --}}
                                <form action="" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium px-3 py-2 rounded-lg w-max min-w-20 text-white bg-red-500 hover:bg-red-400 active:bg-red-500">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
