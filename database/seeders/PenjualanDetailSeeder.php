<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $data[] = [
                    'detail_id' => ($i - 1) * 3 + $j,
                    'penjualan_id' => $i,
                    'barang_id' => rand(1, 15),
                    'harga' => rand(60000, 100000),
                    'jumlah' => rand(1, 10),
                ];
            }
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
}