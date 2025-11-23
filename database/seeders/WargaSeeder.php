<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            DB::table('wargas')->insert([
                'nik'            => $faker->nik(),
                'nama'           => $faker->name(),
                'jenis_kelamin'  => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat'         => $faker->address(),
                'no_hp'          => $faker->phoneNumber(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
