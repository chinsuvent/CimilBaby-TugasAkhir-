<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tua';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'name',
        'alamat',
        'no_hp',
    ];

    /**
     * Relasi ke model User
     * Setiap data orang tua dimiliki oleh satu user (anak/siswa).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); // foreign key di tabel orang_tua
    }

    // App\Models\OrangTua.php

    public function anaks()
    {
        return $this->hasMany(\App\Models\Anak::class, 'orang_tua_id');
    }

}
