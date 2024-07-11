<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kecamatans = [
            ['nama_kecamatan' => 'Kecamatan A', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kecamatan' => 'Kecamatan B', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kecamatan' => 'Kecamatan C', 'created_at' => now(), 'updated_at' => now()],
            // Tambahkan kecamatan lainnya di sini
        ];

        DB::table('tb_kecamatan')->insert($kecamatans);
    }
}
