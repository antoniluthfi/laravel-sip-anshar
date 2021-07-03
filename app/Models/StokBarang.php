<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barang';
    protected $fillable = [
        'nama_barang',
        'id_kategori',
        'berat',
        'harga_user',
        'harga_reseller',
        'paket'
    ];

    public function detailStokBarang()
    {
        return $this->hasMany(DetailStokBarang::class, 'id_barang', 'id')->with('cabang')->select('id_barang', 'stok_tersedia', 'stok_dapat_dijual', 'id_cabang');
    }

    public function paketBarang()
    {
        return $this->hasMany(PaketBarang::class, 'id_paket', 'id')->with('paket');
    }

    public function kategori()
    {
        return $this->hasOne(KategoriBarang::class, 'id', 'id_kategori')->select('id', 'nama_kategori');
    }
}
