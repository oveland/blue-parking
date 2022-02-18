<?php

namespace App\Services\ParkingLot;

use App\Models\ParkingLot\Operator;
use App\Models\ParkingLot\ParkingZone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ParkingZoneService
{
    function list($parking = 'any'): Collection|array
    {
        return ParkingZone::forParking($parking)->get();
    }

    function listParkingLots($code): Collection|array
    {
        return Operator::whereHas('user', function (Builder $query) use ($code) {
            return $query->where('code', $code);
        })
            ->with('parking')
            ->get()
            ->pluck('parking');
    }
}
