<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
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
                'nama_cabang' => 'Twincom Landasan Ulin',
                'singkatan' => 'TLNU',
                'email' => 'twincomulin@gmail.com',
                'nomorhp' => '085245114690',
                'alamat' => 'JL. A.YANI KM 25 LANDASAN ULIN'
            ],
            [
                'nama_cabang' => 'Twincom Banjarbaru',
                'singkatan' => 'TBJB',
                'email' => 'twincombjb@gmail.com',
                'nomorhp' => '085245114690',
                'alamat' => 'JL. PANGLIMA BATUR TIMUR NO.6 RT.02 RW.01',
            ],
            [
                'nama_cabang' => 'Twincom Banjarmasin',
                'singkatan' => 'TBJM',
                'email' => 'twincombjm@gmail.com',
                'nomorhp' => '082255558360',
                'alamat' => 'JL. ADYAKSA NO.4 KAYUTANGI BANJARMASIN',
            ],
            [
                'nama_cabang' => 'Twincom Distribution Center',
                'singkatan' => 'TDC',
                'email' => 'twincombranding@gmail.com',
                'nomorhp' => '0821598917099',
                'alamat' => 'KAMPUNG BARU JL. SEROJA NO.11 LANDASAN ULIN',
            ],
        ];

        Cabang::insert($array);
    }
}
