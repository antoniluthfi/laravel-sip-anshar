<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $primaryKey = 'no_pengembalian';
    protected $guarded = [];

    public function penerimaan()
    {
        return $this->belongsTo(Penerimaan::class, 'no_service', 'no_service')->with('customer', 'barangJasa', 'pengerjaan');
    }

    public function arusKas()
    {
        return $this->belongsTo(ArusKas::class, 'id_arus_kas', 'id');
    }
}
