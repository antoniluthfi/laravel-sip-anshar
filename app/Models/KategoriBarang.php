<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;
    
    protected $table = 'kategori_barang';
    protected $fillable = [
        'nama_kategori',
        'id_purchasing'
    ];

    public function purchasing()
    {
        return $this->hasOne(User::class, 'id', 'id_purchasing')->select('id', 'name');
    }
}
