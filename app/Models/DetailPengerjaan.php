<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengerjaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_pengerjaan';
    protected $guarded = [];

    public function pengerjaan()
    {
        return $this->belongsTo(Pengerjaan::class, 'no_pengerjaan', 'no_pengerjaan');
    }

    public function teknisi()
    {
        return $this->hasOne(User::class, 'id', 'id_teknisi');
    }
}
