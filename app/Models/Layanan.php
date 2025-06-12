<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans'; 

    protected $fillable = [
        'jenis_layanan',
        'durasi',
        'biaya'
    ];

    // Relationship many-to-many dengan Fasilitas
    public function fasilitas()
    {
        return $this->belongsToMany(
            Fasilitas::class,           // Model yang akan dihubungkan
            'layanan_fasilitas',        // Nama tabel pivot/junction
            'layanans_id',               // Foreign key untuk model ini
            'fasilitas_id'              // Foreign key untuk model Fasilitas
        );
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'layanans_id');
    }

    // Accessor untuk format rupiah
    public function getBiayaFormatAttribute()
    {
        return 'Rp ' . number_format($this->biaya, 0, ',', '.');
    }
}