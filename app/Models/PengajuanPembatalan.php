<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPembatalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservasis_id',
        'alasan',
        'status',
        'tanggal_pengajuan',
        'tanggal_dikonfirmasi',
        'admin_id',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasis_id');
    }

}


