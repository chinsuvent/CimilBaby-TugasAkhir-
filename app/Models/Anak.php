<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'usia',
        'alergi'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'penggunas_id');
    }
}



