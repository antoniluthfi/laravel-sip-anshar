<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengerjaan extends Model
{
    use HasFactory;

    protected $table = 'pengerjaan';
    protected $primaryKey = 'no_pengerjaan';
    protected $guarded = [];

    public function penerimaan()
    {
        return $this->belongsTo(Penerimaan::class, 'no_pengerjaan', 'no_pengerjaan')->select('no_pengerjaan', 'no_service', 'id_customer', 'id_barang_jasa')->with('customer', 'barangJasa');
    }

    public function detail_pengerjaan()
    {
        return $this->hasMany(DetailPengerjaan::class, 'no_pengerjaan', 'no_pengerjaan');
    }
}
