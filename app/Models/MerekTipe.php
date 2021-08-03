<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerekTipe extends Model
{
    use HasFactory;

    protected $table = 'merek_tipe';
    protected $guarded = [];

    public function barangJasa()
    {
        return $this->hasOne(BarangJasa::class, 'id', 'id_barang_jasa');
    }
}
