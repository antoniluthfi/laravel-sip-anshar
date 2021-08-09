<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangJasa;

class BarangJasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                'nama' => 'Laptop',
                'jenis' => 'Barang',
            ],
            [
                'nama' => 'Printer',
                'jenis' => 'Barang',
            ],
            [
                'nama' => 'CCTV',
                'jenis' => 'Barang'
            ],
            [
                'nama' => 'Pemasangan CCTV',
                'jenis' => 'Jasa',
            ],
            [
                'nama' => 'Instal Ulang',
                'jenis' => 'Jasa'
            ]
        ];

        BarangJasa::insert($array);
    }
}
