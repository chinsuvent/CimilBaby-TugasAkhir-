<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'anaks_id',
        'penggunas_id',
        'layanans_id',
        'jadwal_layanan_id',  // Ini FK ke jadwal_layanans
        'tgl_masuk',
        'tgl_keluar',
        'total',
        'metode_pembayaran',
        'status',
    ];

    protected $casts = [
        'tgl_masuk' => 'date',
        'tgl_keluar' => 'date',
    ];

    // Relasi ke jadwal layanan (many to one)
    public function jadwalLayanan()
    {
        return $this->belongsTo(JadwalLayanan::class, 'jadwal_layanans_id');
    }

    // Relasi ke anak
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anaks_id');
    }

    // Relasi ke pengguna
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relasi ke layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanans_id');
    }

}
