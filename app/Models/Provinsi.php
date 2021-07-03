<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nama_provinsi'
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class, 'id', 'id_provinsi');
    }
}
