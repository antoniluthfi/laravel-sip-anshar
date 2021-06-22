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
            'email' => 'marketing@gmail.com',
            'name' => 'marketing',
            'hak_akses' => 'marketing',
            'nomorhp' => '082176438793',
            'alamat' => 'Landasan Ulin',
            'id_cabang' => '1',
            'password' => bcrypt('marketing123'),
            'status' => 'aktif',
        ]);
    }
}