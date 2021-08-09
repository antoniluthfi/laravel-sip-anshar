<?php

namespace Database\Seeders;

use App\Models\Cabang;
use App\Models\DetailStokBarang;
use App\Models\StokBarang;
use Illuminate\Database\Seeder;

class DetailStokBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cabang = Cabang::all();
        $stok_barang = StokBarang::all();

        foreach($stok_barang as $stok) {
            foreach($cabang as $cab) {
                DetailStokBarang::create([
                    'id_barang' => $stok->id,
                    'id_cabang' => $cab->id,
                    'stok_tersedia' => 20,
                    'stok_dapat_dijual' => 20
                ]);
            }
        }
    }
}
