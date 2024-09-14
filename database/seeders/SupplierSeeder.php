<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1, // Menentukan supplier_id secara manual
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'Supplier A',
                'supplier_alamat' => 'Jl. Merdeka No. 1',
            ],
            [
                'supplier_id' => 2, // Menentukan supplier_id secara manual
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'Supplier B',
                'supplier_alamat' => 'Jl. Proklamasi No. 2',
            ],
            [
                'supplier_id' => 3, // Menentukan supplier_id secara manual
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'Supplier C',
                'supplier_alamat' => 'Jl. Pahlawan No. 3',
            ]
        ];

        DB::table('m_supplier')->insert($data);
    }
}