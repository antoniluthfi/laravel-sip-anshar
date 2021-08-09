<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(RajaOngkirSeeder::class);
        $this->call(CabangSeeder::class);
        $this->call(BarangJasaSeeder::class);
        $this->call(MerekTipeSeeder::class);
        $this->call(SandiTransaksiSeeder::class);
        $this->call(KategoriBarangSeeder::class);
        $this->call(StokBarangSeeder::class);
        $this->call(DetailStokBarangSeeder::class);
    }
}
