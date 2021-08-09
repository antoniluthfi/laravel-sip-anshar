<?php

namespace Database\Seeders;

use App\Models\StokBarang;
use Illuminate\Database\Seeder;

class StokBarangSeeder extends Seeder
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
                'nama_barang' => 'Logitech Bluetooth Multi-Device Keyboard K480',
                'id_kategori' => '4',
                'berat' => '820',
                'harga_user' => 729000,
                'harga_reseller' => 629000,
                'paket' => '0'
            ],
            [
                'nama_barang' => 'Logitech K400 Plus Wireless Touch Keyboard',
                'id_kategori' => '4',
                'berat' => '390',
                'harga_user' => 669000,
                'harga_reseller' => 569000,
                'paket' => '0'
            ],
            [
                'nama_barang' => 'Asus VivoBook Ultra 14 K413',
                'id_kategori' => '1',
                'berat' => 1400,
                'harga_user' => 11499000,
                'harga_reseller' => 11000000,
                'paket' => '0'
            ],
            [
                'nama_barang' => 'SanDisk PLUS Solid State Drive, SDSSDA-240G, 240GB',
                'id_kategori' => '5',
                'berat' => 500,
                'harga_user' => 588600,
                'harga_reseller' => 540000,
                'paket' => '0'
            ]
        ];

        StokBarang::insert($array);
    }
}
