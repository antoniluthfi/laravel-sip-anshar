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
        'kategori',
        'harga_user',
        'harga_reseller',
        'bjb',
        'bjm',
        'lnu',
        'tdc',
        'total_pack',
        'paket'
    ];

    public function paketBarang()
    {
        return $this->hasMany(PaketBarang::class, 'id_paket', 'id')->with('paket');
    }
}
