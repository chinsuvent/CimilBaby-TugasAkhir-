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
        'layanans_id',// Ini FK ke jadwal_layanans
        'tgl_masuk',
        'tgl_keluar',
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

    public function pengajuanPembatalan()
    {
        return $this->hasOne(PengajuanPembatalan::class, 'reservasis_id');
    }

    public function checkinCheckout()
    {
        return $this->hasOne(CheckinCheckout::class, 'reservasis_id');
    }


//     public function hitungDurasi()
// {
//     // Pastikan relasi layanan sudah dimuat
//     if (!$this->layanan || !$this->tgl_masuk || !$this->tgl_keluar) {
//         return null;
//     }

//     $jenis = strtolower($this->layanan->jenis_layanan);

//     // Hitung jumlah hari antara tgl_masuk dan tgl_keluar
//     $durasiHari = $this->tgl_masuk->diffInDays($this->tgl_keluar);

//     if ($jenis === 'bulanan') {
//         return '1 bulan';
//     } elseif ($jenis === 'harian') {
//         return $durasiHari . ' hari';
//     } else {
//         return $durasiHari . ' waktu';
//     }
// }


}
