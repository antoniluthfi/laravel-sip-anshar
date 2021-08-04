<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArusKas extends Model
{
    use HasFactory;

    protected $table = 'arus_kas';
    protected $guarded = [];

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'id_admin');
    }

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'id', 'id_cabang');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_arus_kas', 'id')->with('penerimaan');
    }
}
