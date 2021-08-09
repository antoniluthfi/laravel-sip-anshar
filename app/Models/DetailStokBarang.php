<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStokBarang extends Model
{
    use HasFactory;

    protected $table = 'detail_stok_barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_barang',
        'id_cabang',
        'stok_tersedia',
        'stok_dapat_dijual'
    ];

    public function barang()
    {
        return $this->belongsTo(StokBarang::class, 'id', 'id_barang');
    }

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'id', 'id_cabang')->select('id', 'nama_cabang', 'singkatan');
    }
}
