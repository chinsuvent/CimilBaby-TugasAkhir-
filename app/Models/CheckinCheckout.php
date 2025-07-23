<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinCheckout extends Model
{
    protected $fillable = [
        'reservasis_id',
        'waktu_checkin',
        'waktu_checkout',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasis_id');
    }

}
