<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_masuk',
        'tgl_keluar',
        'total',
        'metode_pembayaran',
        'status'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}



