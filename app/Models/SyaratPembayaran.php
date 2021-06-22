<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratPembayaran extends Model
{
    use HasFactory;

    protected $table = 'syarat_pembayaran';
    protected $fillable = [
        'nama'
    ];
}
