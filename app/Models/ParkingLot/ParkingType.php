<?php

namespace App\Models\ParkingLot;

use App\Models\Vehicles\VehicleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingType extends Model
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

    function zones()
    {
        return $this->hasMany(ParkingZone::class);
    }
}
