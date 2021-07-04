<?php

namespace App\Models\Reservations;

use App\Models\Vehicles\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    function type()
    {
        return $this->belongsTo(ReservationType::class);
    }

    function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
