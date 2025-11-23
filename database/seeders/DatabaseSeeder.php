<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan semua seeder di sini
        $this->call([
            WargaSeeder::class,
            PosyanduSeeder::class,
            KaderPosyanduSeeder::class,
        ]);
    }
}
