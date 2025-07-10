<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPembatalan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_pembatalan';

    protected $fillable = [
        'reservasis_id',
        'alasan',
        'status',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
