<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturPenjualan extends Model
{
    use HasFactory;

    protected $table = 'faktur_penjualan';
    protected $primaryKey = 'no_faktur';
    public $incrementing = false;
    protected $fillable = [
        'no_faktur',
        'kode_pesanan',
        'id_marketing',
        'user_id',
        'id_bank',
        'id_pembayaran',
        'metode_pembayaran',
        'nominal',
        'terhutang'
    ];

    public function pesananPenjualan()
    {
        return $this->hasOne(PesananPenjualan::class, 'kode_pesanan', 'kode_pesanan')->with('penjual');
    }

    public function marketing()
    {
        return $this->hasOne(User::class, 'id', 'id_marketing')->select('id', 'name');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select('id', 'name', 'alamat', 'nomorhp', 'hak_akses');
    }

    public function bank()
    {
        return $this->hasOne(Bank::class, 'id', 'id_bank');
    }
}
