<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesananPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan_penjualan';
    protected $guarded = [];

    public function pesananPenjualan()
    {
        return $this->belongsTo(PesananPenjualan::class, 'kode_pesanan', 'kode_pesanan');
    }

    public function barang()
    {
        return $this->hasOne(StokBarang::class, 'id', 'id_barang')->select('id', 'nama_barang', 'id_kategori', 'harga_user', 'harga_reseller');
    }
}
