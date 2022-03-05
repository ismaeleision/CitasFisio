<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;

class cita extends Model
{
    use HasFactory;

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
