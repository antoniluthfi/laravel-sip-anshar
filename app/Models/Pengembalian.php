<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_pengembalian';
    protected $guarded = [];

    public function penerimaan()
    {
        return $this->belongsTo(Penerimaan::class, 'no_service', 'no_service');
    }
}
