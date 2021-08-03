<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeknisiPJ extends Model
{
    use HasFactory;

    protected $table = 'teknisi_pj';
    protected $guarded = [];

    public function pengerjaan()
    {
        return $this->hasOne(Pengerjaan::class, 'no_pengerjaan', 'no_pengerjaan');
    }

    public function teknisi()
    {
        return $this->hasOne(User::class, 'id', 'id_teknisi')->select('id', 'name');
    }

    public function penerimaan()
    {
        return $this->hasOne(Penerimaan::class, 'no_pengerjaan', 'no_pengerjaan')->select('no_pengerjaan', 'no_service', 'id_barang_jasa', 'id_customer')->with('barangJasa', 'customer');
    }
}
