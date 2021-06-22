<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_bukti';
    protected $guarded = [];

    public function penerimaan()
    {
        return $this->hasOne(Penerimaan::class, 'no_service', 'no_service');
    }

    public function sandi_transaksi()
    {
        return $this->hasOne(SandiTransaksi::class, 'id', 'id_sandi_transaksi');
    }
}
