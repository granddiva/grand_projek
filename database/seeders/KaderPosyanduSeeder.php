<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KaderPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $peranList = ['Ketua', 'Bendahara', 'Sekretaris', 'Anggota'];

        $data = [];

        for ($i = 1; $i <= 100; $i++) {

            $mulai = $faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d');

            $akhir = rand(1, 100) <= 30
                ? $faker->dateTimeBetween($mulai, 'now')->format('Y-m-d')
                : null;

            $data[] = [
                'kader_id'    => rand(1, 50),
                'posyandu_id' => rand(1, 20),
                'warga_id'    => rand(1, 200),
                'peran'       => $faker->randomElement($peranList),
                'mulai_tugas' => $mulai,
                'akhir_tugas' => $akhir,
            ];
        }

        DB::table('kader_posyandu')->insert($data);
    }
}
