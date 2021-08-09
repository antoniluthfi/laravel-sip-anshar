<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SandiTransaksi;

class SandiTransaksiSeeder extends Seeder
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
                'nama_transaksi' => 'Pembayaran Servis',
                'jenis_transaksi' => '1',
            ],
            [
                'nama_transaksi' => 'Uang Kas Kembalian',
                'jenis_transaksi' => '1',
            ],
            [
                'nama_transaksi' => 'Biaya Iuran PLN',
                'jenis_transaksi' => '0',
            ],
            [
                'nama_transaksi' => 'Pembelian Alat Operasional Servis',
                'jenis_transaksi' => '0',
            ],
            [
                'nama_transaksi' => 'Beli Air Mineral Gelas',
                'jenis_transaksi' => '0',
            ],
            [
                'nama_transaksi' => 'Beli Pulsa HP Operasional',
                'jenis_transaksi' => '0',
            ],
            [
                'nama_transaksi' => 'Penerimaan Uang Denda',
                'jenis_transaksi' => '1',
            ],
            [
                'nama_transaksi' => 'Isi Ulang Air Minum Galon',
                'jenis_transaksi' => '0',
            ],
            [
                'nama_transaksi' => 'Penerimaan Uang Pemasangan CCTV',
                'jenis_transaksi' => '1',
            ],
            [
                'nama_transaksi' => 'Uang Transport',
                'jenis_transaksi' => '0',
            ],
        ];

        SandiTransaksi::insert($array);
    }
}
