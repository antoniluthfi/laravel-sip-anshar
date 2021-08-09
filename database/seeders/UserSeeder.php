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
        $array = [
            [
                'email' => 'marketing@gmail.com',
                'name' => 'Marketing',
                'hak_akses' => 'marketing',
                'nomorhp' => '087865226787',
                'alamat' => 'Landasan Ulin',
                'id_cabang' => '1',
                'password' => bcrypt('marketing'),
                'status' => 'aktif',
            ],
            [
                'email' => 'admingudang@gmail.com',
                'name' => 'Admin Gudang',
                'hak_akses' => 'admin gudang',
                'nomorhp' => '087865226784',
                'alamat' => 'Landasan Ulin',
                'id_cabang' => '4',
                'password' => bcrypt('admingudang'),
                'status' => 'aktif',
            ],
            [
                'email' => 'admintsc@gmail.com',
                'name' => 'Admin TSC',
                'hak_akses' => 'admin tsc',
                'nomorhp' => '087865226785',
                'alamat' => 'Landasan Ulin',
                'id_cabang' => '1',
                'password' => bcrypt('admintsc'),
                'status' => 'aktif',
            ],
            [
                'email' => 'teknisi@gmail.com',
                'name' => 'Teknisi',
                'hak_akses' => 'teknisi',
                'nomorhp' => '087865226786',
                'alamat' => 'Landasan Ulin',
                'id_cabang' => '1',
                'password' => bcrypt('teknisi'),
                'status' => 'aktif',
            ],
            [
                'email' => 'pelanggan1@gmail.com',
                'name' => 'Pelanggan1',
                'hak_akses' => 'user',
                'nomorhp' => '087865226788',
                'alamat' => 'Landasan Ulin',
                'id_cabang' => '1',
                'password' => bcrypt('pelanggan1'),
                'status' => 'aktif',
            ],
            [
                'email' => 'pelanggan2@gmail.com',
                'name' => 'Pelanggan2',
                'hak_akses' => 'reseller',
                'nomorhp' => '087865226789',
                'alamat' => 'Landasan Ulin',
                'id_cabang' => '1',
                'password' => bcrypt('pelanggan2'),
                'status' => 'aktif',
            ],
        ];

        User::insert($array);
    }
}