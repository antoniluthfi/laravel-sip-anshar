<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktifitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktifitas';
    protected $fillable = [
        'user_id',
        'method',
        'halaman',
        'keterangan'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select('id', 'name');
    }
}
