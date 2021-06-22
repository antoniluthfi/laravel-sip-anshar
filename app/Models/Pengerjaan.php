<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengerjaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_pengerjaan';
    protected $guarded = [];

    public function penerimaan()
    {
        return $this->belongsTo(penerimaan::class, 'no_pengerjaan', 'no_pengerjaan');
    }

    public function detail_pengerjaan()
    {
        return $this->hasMany(DetailPengerjaan::class, 'no_pengerjaan', 'no_pengerjaan');
    }
}
