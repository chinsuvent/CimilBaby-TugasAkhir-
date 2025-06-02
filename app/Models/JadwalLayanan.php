<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLayanan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_layanans';

    protected $fillable = [
        'anaks_id',
        'reservasis_id',
        'layanans_id'
    ];

    
    // Relasi ke reservasi (one to many)
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anaks_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanans_id');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'jadwal_layanans_id');
    }



}
