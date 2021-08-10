<?php

namespace Database\Seeders;

use App\Models\Ekspedisi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            RajaOngkirSeeder::class,
            CabangSeeder::class,
            BarangJasaSeeder::class,
            MerekTipeSeeder::class,
            SandiTransaksiSeeder::class,
            KategoriBarangSeeder::class,
            StokBarangSeeder::class,
            DetailStokBarangSeeder::class,
            EkspedisiSeeder::class,
        ]);
    }
}
