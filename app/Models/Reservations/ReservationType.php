<?php

namespace App\Models\Reservations;

use App\Models\ParkingLot\Parking;
use App\Models\Vehicles\VehicleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationType extends Model
{
    use HasFactory;

    function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    function zone()
    {
        return $this->hasOne(ReservationZone::class);
    }
}
