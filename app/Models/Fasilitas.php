<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas'; 

    protected $fillable = [
        'nama_fasilitas',
        'deskripsi'
    ];

    // Relationship many-to-many dengan Layanan
    public function layanan()
    {
        return $this->belongsToMany(
            Layanan::class,             // Model yang akan dihubungkan
            'layanan_fasilitas',        // Nama tabel pivot/junction
            'fasilitas_id',             // Foreign key untuk model ini
            'layanan_id'                // Foreign key untuk model Layanan
        );
    }
}