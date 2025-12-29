<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus folder lama dan buat baru agar benar-benar fresh
        Storage::disk('public')->deleteDirectory('menus');
        Storage::disk('public')->makeDirectory('menus');

        $menus = [
            [
                'nama_menu' => 'Nasi Kuning',
                'source_image' => 'nasi kuning.jpg', // Nama file di public/images
                'deskripsi' => 'nasi kuning rempah tradisional yang gurih lengkap dengan telur iris dan sambal',
                'harga' => 15000,
                'terjual' => 0,
            ],
            [
                'nama_menu' => 'Nasi Ayam',
                'source_image' => 'nasi ayam.jpg',
                'deskripsi' => 'paket nasi putih pulen dengan ayam goreng bumbu rempah dan lalapan segar',
                'harga' => 25000,
                'terjual' => 0,
            ],
            [
                'nama_menu' => 'Nasi Liwet',
                'source_image' => 'nasi liwet.jpg',
                'deskripsi' => 'nasi gurih khas Sunda beraroma daun salam dan teri medan yang otentik',
                'harga' => 25000,
                'terjual' => 0,
            ],
            [
                'nama_menu' => 'Baso Ikan',
                'source_image' => 'baso ikan.jpg',
                'deskripsi' => 'baso ikan premium bertekstur kenyal yang disajikan dalam kuah kaldu bening segar',
                'harga' => 10000,
                'terjual' => 0,
            ],
            [
                'nama_menu' => 'Nasi Bakar',
                'source_image' => 'nasi bakar.jpg',
                'deskripsi' => 'nasi bungkus daun pisang yang dibakar harum dengan isian ayam suwir pedas',
                'harga' => 7000,
                'terjual' => 0,
            ],
            [
                'nama_menu' => 'Paket Nasi Liwet Tampahan',
                'source_image' => 'paket nasi liwet tampahan.jpeg',
                'deskripsi' => 'sajian nasi liwet porsi besar di atas tampah untuk acara keluarga atau syukuran',
                'harga' => 300000,
                'terjual' => 0,
            ],
            [
                'nama_menu' => 'Paket Nasi Kuning Tampahan',
                'source_image' => 'paket nasi kuning tampahan.jpeg',
                'deskripsi' => 'tumpeng nasi kuning porsi besar yang disusun cantik di atas tampah untuk perayaan',
                'harga' => 300000,
                'terjual' => 0,
            ],
        ];

        foreach ($menus as $menuData) {
            $fotoPath = null;
            $sourcePath = public_path('images/' . $menuData['source_image']);

            // Cek apakah file sumber ada
            if (File::exists($sourcePath)) {
                $filename = $menuData['source_image'];
                $destinationPath = 'menus/' . $filename;
                
                // Copy file dari public/images ke storage/app/public/menus
                Storage::disk('public')->put($destinationPath, File::get($sourcePath));
                
                $fotoPath = $destinationPath;
            } else {
                echo "Warning: Gambar tidak ditemukan untuk " . $menuData['nama_menu'] . " di " . $sourcePath . "\n";
            }

            // Hapus key source_image agar tidak error saat create model
            unset($menuData['source_image']);
            
            // Set path foto yang baru
            $menuData['foto_menu'] = $fotoPath;

            Menu::updateOrCreate(
                ['nama_menu' => $menuData['nama_menu']], // Cek berdasarkan nama menu
                $menuData // Data yang akan diupdate/create
            );
        }
    }
}