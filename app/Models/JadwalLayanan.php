<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLayanan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_layanans';

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];
}
