<?php

namespace Database\Seeders;

use App\Models\Ekspedisi;
use Illuminate\Database\Seeder;

class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['nama_ekspedisi' => 'JNT'],
            ['nama_ekspedisi' => 'TIKI'],
            ['nama_ekspedisi' => 'POS'],
        ];

        Ekspedisi::insert($array);
    }
}
