<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WhatsappConfig extends Model
{
    protected $fillable = ['number', 'api_key'];

    public function getDisplayNumberAttribute()
    {
        if (Str::startsWith($this->number, '62')) {
            return '0' . substr($this->number, 2);
        }

        return $this->number;
    }
}




