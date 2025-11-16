<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posyandu')->insert([
            [
                'posyandu_id' => 1,
                'nama' => 'Posyandu Mawar',
                'alamat' => 'Jl. Kenanga No. 10',
                'rt' => '02',
                'rw' => '04',
                'kontak' => '08123456789'
            ],
            [
                'posyandu_id' => 2,
                'nama' => 'Posyandu Melati',
                'alamat' => 'Dusun Cempaka',
                'rt' => '03',
                'rw' => '02',
                'kontak' => '08129876543'
            ],
        ]);
    }
}
