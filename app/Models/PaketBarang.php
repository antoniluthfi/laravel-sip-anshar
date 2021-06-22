<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketBarang extends Model
{
    use HasFactory;

    protected $table = 'paket_barang';
    protected $primaryKey = 'id_paket';
    protected $fillable = [
        'id_paket',
        'id_barang',
    ];

    public function paket()
    {
        return $this->hasOne(StokBarang::class, 'id', 'id_paket');
    }

    public function barang()
    {
        return $this->hasMany(StokBarang::class, 'id', 'id_barang')->select('id', 'nama_barang');
    }
}
