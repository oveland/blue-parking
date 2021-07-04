<?php

namespace App\Models\Reservations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationZone extends Model
{
    use HasFactory;

    function type()
    {
        return $this->belongsTo(ReservationType::class);
    }
}
