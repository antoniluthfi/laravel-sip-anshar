<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangJasa extends Model
{
    use HasFactory;

    protected $table = 'barang_jasa';
    protected $guarded = [];
}
