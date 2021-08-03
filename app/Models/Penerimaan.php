<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    protected $table = 'penerimaan';
    protected $primaryKey = 'no_service';
    public $incrementing = false;
    protected $guarded = [];

    public function pengerjaan()
    {
        return $this->hasOne(Pengerjaan::class, 'no_pengerjaan', 'no_pengerjaan');
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'id_admin');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'id_customer');
    }

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'id', 'id_cabang');
    }

    public function barangJasa()
    {
        return $this->hasOne(BarangJasa::class, 'id', 'id_barang_jasa');
    }

    public function barang()
    {
        return $this->hasOne(MerekTipe::class, 'id', 'id_barang');
    }
}
