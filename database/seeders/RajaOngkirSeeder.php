<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\Provinsi;
use App\Models\Kota;

class RajaOngkirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinsi) {
            Provinsi::create([
                'id' => $provinsi['province_id'],
                'nama_provinsi' => $provinsi['province']
            ]);

            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinsi['province_id'])->get();
            foreach ($daftarKota as $kota) {
                Kota::create([
                    'id' => $kota['city_id'],
                    'id_provinsi' => $kota['province_id'],
                    'nama_kota' => $kota['city_name']
                ]);
            }
        }
    }
}
