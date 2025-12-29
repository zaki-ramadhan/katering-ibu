<?php

namespace Database\Seeders;

use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UlasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua user yang ada
        $users = User::pluck('id')->toArray();

        // Pastikan ada user di database
        if (empty($users)) {
            $this->command->info('Tidak ada user ditemukan. Harap seed User terlebih dahulu.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            Ulasan::create([
                'id_customer' => $faker->randomElement($users),
                'pesan' => $faker->sentence(10), // Buat kalimat ulasan random
            ]);
        }
    }
}
