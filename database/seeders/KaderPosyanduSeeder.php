<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KaderPosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kader_posyandu')->insert([
            [
                'kader_id' => 1,
                'posyandu_id' => 1,
                'warga_id' => 1,
                'peran' => 'Ketua',
                'mulai_tugas' => '2023-01-01',
                'akhir_tugas' => null,
            ],
            [
                'kader_id' => 2,
                'posyandu_id' => 2,
                'warga_id' => 2,
                'peran' => 'Bendahara',
                'mulai_tugas' => '2023-06-01',
                'akhir_tugas' => null,
            ],
        ]);
    }
}
