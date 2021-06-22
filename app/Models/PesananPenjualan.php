<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananPenjualan extends Model
{
    use HasFactory;

    protected $table = 'pesanan_penjualan';
    protected $fillable = [
        'kode_pesanan',
        'user_id',
        'id_barang',
        'kuantitas',
        'satuan',
        'diskon',
        'total_harga',
        'id_penjual',
        'stok_cabang',
        'keterangan',
        'id_syarat_pembayaran'
    ];

    public function barang()
    {
        return $this->hasOne(StokBarang::class, 'id', 'id_barang')->with('paketBarang');
    }

    public function pelanggan()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function penjual()
    {
        return $this->hasOne(User::class, 'id', 'id_penjual')->select('id', 'name', 'hak_akses');
    }

    public function pengirimanPesanan()
    {
        return $this->hasOne(PengirimanPesanan::class, 'id_pesanan_penjualan', 'id');
    }

    public function fakturPenjualan()
    {
        return $this->hasOne(FakturPenjualan::class, 'id_pesanan_penjualan', 'id')->select('no_bukti', 'id_pesanan_penjualan');
    }

    public function syaratPembayaran()
    {
        return $this->hasOne(SyaratPembayaran::class, 'id', 'id_syarat_pembayaran')->select('id', 'nama');
    }
}
