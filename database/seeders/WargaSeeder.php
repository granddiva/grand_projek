<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wargas')->insert([
            [
                'nik' => '3174010101010001',
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jalan Mawar No. 1',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3174010101020002',
                'nama' => 'Siti Aminah',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jalan Melati No. 2',
                'no_hp' => '081298765432',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3174010101030003',
                'nama' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jalan Kenanga No. 3',
                'no_hp' => '081223344556',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3174010101040004',
                'nama' => 'Rina Wijaya',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jalan Anggrek No. 4',
                'no_hp' => '081212121212',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
