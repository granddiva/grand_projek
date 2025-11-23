<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $namaLaki = [
            'Budi Santoso','Agus Pratama','Dedi Supriyadi','Hari Wibowo','Imam Saputra',
            'Gilang Ramadhan','Fajar Setiawan','Rudi Hartono','Heri Susanto','Tono Raharjo',
            'Yusuf Hidayat','Adi Pratama','Joko Purwanto','Bagus Firmansyah','Arif Rahman'
        ];

        $namaPerempuan = [
            'Siti Aminah','Rina Wijaya','Dewi Lestari','Fitri Handayani','Wulan Sari',
            'Anisa Nuraini','Ratna Puspita','Lestari Sundari','Dinda Kartika','Nia Ayu Putri',
            'Putri Maharani','Ayu Rahmawati','Sari Melati','Dahlia Ramadhani','Tika Yuliana'
        ];

        $data = [];

        for ($i = 0; $i < 100; $i++) {

            // Pilih gender random
            $isMale = rand(0, 1);

            $nama = $isMale
                ? $faker->randomElement($namaLaki)
                : $faker->randomElement($namaPerempuan);

            $data[] = [
                'name'       => $nama,
                'email'      => strtolower(str_replace(' ', '.', $nama)) . rand(100,999) . '@gmail.com',
                'password'   => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($data);
    }
}
