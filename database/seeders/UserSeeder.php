<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'anonimgama2@gmail.com',
            'name' => 'Luthfi',
            'hak_akses' => 'teknisi',
            'nomorhp' => '087865226783',
            'alamat' => 'Landasan Ulin',
            'id_cabang' => '1',
            'password' => bcrypt('luthfi'),
            'status' => 'aktif',
        ]);
    }
}