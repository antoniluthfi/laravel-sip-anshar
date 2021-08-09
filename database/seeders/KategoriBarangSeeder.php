<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBarang;

class KategoriBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['nama_kategori' => 'Laptop'],
            ['nama_kategori' => 'CCTV'],
            ['nama_kategori' => 'Printer'],
            ['nama_kategori' => 'Aksesoris'],
            ['nama_kategori' => 'Storage'],
            ['nama_kategori' => 'PC']
        ];

        KategoriBarang::insert($array);
    }
}
