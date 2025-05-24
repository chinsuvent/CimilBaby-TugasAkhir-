<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_orang_tua',
        'username',
        'password',
        'email',
        'no_hp',
        'alamat'
    ];
}
