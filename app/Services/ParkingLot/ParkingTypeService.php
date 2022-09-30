<?php

namespace App\Services\ParkingLot;

use App\Models\ParkingLot\ParkingType;
use Illuminate\Support\Collection;

class ParkingTypeService
{
    function list($parking = 'any'): Collection|array
    {
        return ParkingType::forParking($parking)->get();
    }
}
