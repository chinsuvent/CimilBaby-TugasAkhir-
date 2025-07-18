<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    // App\Models\Anak.php

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'orang_tua_id');
    }




public function hitungUsia()
{
    if (!$this->tanggal_lahir) {
        return null;
    }

    $tanggalLahir = Carbon::parse($this->tanggal_lahir);
    $sekarang = Carbon::now();

    $tahun = intval($tanggalLahir->diffInYears($sekarang));
    $bulan = intval($tanggalLahir->copy()->addYears($tahun)->diffInMonths($sekarang));

    if ($tahun > 0 && $bulan > 0) {
        return "{$tahun} tahun {$bulan} bulan";
    } elseif ($tahun > 0) {
        return "{$tahun} tahun";
    } elseif ($bulan > 0) {
        return "{$bulan} bulan";
    } else {
        return "Kurang dari 1 bulan";
    }
}

}



