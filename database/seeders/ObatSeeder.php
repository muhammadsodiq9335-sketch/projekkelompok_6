<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    public function run()
    {
        $obat = [
            [
                'nama_obat' => 'Paracetamol 500mg',
                'kode_obat' => 'OBT001',
                'jenis' => 'Tablet',
                'stok' => 1000,
                'harga' => 5000,
                'satuan' => 'Strip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Amoxicillin 500mg',
                'kode_obat' => 'OBT002',
                'jenis' => 'Kapsul',
                'stok' => 500,
                'harga' => 15000,
                'satuan' => 'Strip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Vitamin C 500mg',
                'kode_obat' => 'OBT003',
                'jenis' => 'Tablet',
                'stok' => 2000,
                'harga' => 2000,
                'satuan' => 'Strip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'OBH Combi',
                'kode_obat' => 'OBT004',
                'jenis' => 'Sirup',
                'stok' => 100,
                'harga' => 25000,
                'satuan' => 'Botol',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Betadine',
                'kode_obat' => 'OBT005',
                'jenis' => 'Cair',
                'stok' => 50,
                'harga' => 35000,
                'satuan' => 'Botol',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'nama_obat' => 'Antangin',
                'kode_obat' => 'OBT006',
                'jenis' => 'Cair',
                'stok' => 500,
                'harga' => 4000,
                'satuan' => 'Sachet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'nama_obat' => 'Bodrex',
                'kode_obat' => 'OBT007',
                'jenis' => 'Tablet',
                'stok' => 1000,
                'harga' => 3000,
                'satuan' => 'Strip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('obat')->insert($obat);
    }
}
