<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $data = [];
        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'nama' => 'Posyandu ' . $faker->city(),
                'alamat' => $faker->address(),
                'rt' => str_pad((string)rand(1,20), 2, '0', STR_PAD_LEFT),
                'rw' => str_pad((string)rand(1,20), 2, '0', STR_PAD_LEFT),
                'kontak' => $faker->phoneNumber(),
                'media' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('posyandu')->insert($data);
    }
}
