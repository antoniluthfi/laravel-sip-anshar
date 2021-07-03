<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanPesanan extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_pesanan';
    protected $primaryKey = 'kode_pengiriman';
    public $incrementing = false;
    protected $guarded = [];

    public function pesananPenjualan()
    {
        return $this->hasOne(PesananPenjualan::class, 'kode_pesanan', 'kode_pesanan')->with('penjual', 'syaratPembayaran');
    }

    public function fakturPenjualan()
    {
        return $this->hasOne(FakturPenjualan::class, 'kode_pesanan', 'kode_pesanan');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select('id', 'name', 'alamat', 'nomorhp', 'id_cabang', 'hak_akses');
    }

    public function ekspedisi()
    {
        return $this->hasOne(Ekspedisi::class, 'id', 'id_ekspedisi');
    }

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'id', 'id_cabang')->select('id', 'nama_cabang');
    }
}
