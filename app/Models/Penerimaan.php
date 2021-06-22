<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_service';
    protected $guarded = [];

    public function pengerjaan()
    {
        return $this->hasOne(Pengerjaan::class, 'no_pengerjaan', 'no_pengerjaan');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'id_customer');
    }

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'id', 'id_cabang');
    }

    public function barang()
    {
        return $this->hasOne(StokBarang::class, 'id', 'id_barang');
    }
}
