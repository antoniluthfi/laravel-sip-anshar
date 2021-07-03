<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananPenjualan extends Model
{
    use HasFactory;

    protected $table = 'pesanan_penjualan';
    protected $primaryKey = 'kode_pesanan';
    public $incrementing = false;
    protected $guarded = [];

    public function pelanggan()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select('id', 'name', 'email', 'hak_akses');
    }

    public function penjual()
    {
        return $this->hasOne(User::class, 'id', 'id_penjual')->select('id', 'name', 'hak_akses');
    }

    public function pengirimanPesanan()
    {
        return $this->hasOne(PengirimanPesanan::class, 'kode_pesanan', 'kode_pesanan');
    }

    public function fakturPenjualan()
    {
        return $this->hasOne(FakturPenjualan::class, 'kode_pesanan', 'kode_pesanan')->select('no_faktur', 'kode_pesanan');
    }

    public function syaratPembayaran()
    {
        return $this->hasOne(SyaratPembayaran::class, 'id', 'id_syarat_pembayaran')->select('id', 'nama');
    }

    public function detailPesananPenjualan()
    {
        return $this->hasMany(DetailPesananPenjualan::class, 'kode_pesanan', 'kode_pesanan')->with('barang')->select('id', 'kode_pesanan', 'id_barang', 'kuantitas', 'total_harga');
    }

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'id', 'id_cabang')->select('id', 'nama_cabang');
    }
}
