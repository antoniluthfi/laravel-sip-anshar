<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanPesanan extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_pesanan';
    protected $primaryKey = 'id_pesanan_penjualan';
    protected $fillable = [
        'id_pesanan_penjualan',
        'kode_pengiriman',
        'id_marketing',
        'user_id',
        'tanggal_pengiriman',
        'alamat',
        'ongkir',
        'id_ekspedisi',
        'id_cabang',
        'keterangan'
    ];

    public function pesananPenjualan()
    {
        return $this->hasOne(PesananPenjualan::class, 'id', 'id_pesanan_penjualan')->with('barang', 'penjual', 'syaratPembayaran');
    }

    public function fakturPenjualan()
    {
        return $this->hasOne(FakturPenjualan::class, 'id_pesanan_penjualan', 'id_pesanan_penjualan');
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
