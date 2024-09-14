<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $kategori = [1, 2, 3, 4, 5]; // Kategori IDs

        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'barang_id' => $i,
                'kategori_id' => $kategori[array_rand($kategori)],
                'barang_kode' => 'BRG' . $i,
                'barang_nama' => 'Barang ' . $i,
                'harga_beli' => rand(10000, 50000),
                'harga_jual' => rand(60000, 100000),
            ];
        }

        DB::table('m_barang')->insert($data);
    }
}