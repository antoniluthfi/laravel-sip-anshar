<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MerekTipe;

class MerekTipeSeeder extends Seeder
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
                'id_barang_jasa' => '1',
                'nama' => 'Lenovo Thinkpad T430s',
            ],
            [
                'id_barang_jasa' => '1',
                'nama' => 'Acer Swift 3',
            ],
            [
                'id_barang_jasa' => '3',
                'nama' => 'Hikvision DS-2TD1217-2/PA',
            ],
            [
                'id_barang_jasa' => '3',
                'nama' => 'Hikvision DS-2CE12DFT-F',
            ],
            [
                'id_barang_jasa' => '2',
                'nama' => 'Canon PIXMA G670',
            ],
            [
                'id_barang_jasa' => '2',
                'nama' => 'Canon PIXMA G570',
            ],
        ];

        MerekTipe::insert($array);
    }
}
