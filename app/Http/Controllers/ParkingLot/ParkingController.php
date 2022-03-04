<?php

namespace App\Http\Controllers\ParkingLot;

use App\Http\Controllers\Controller;
use App\Models\ParkingLot\Parking;
use App\Models\ParkingLot\ParkingType;
use App\Models\ParkingLot\ParkingZone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(): Collection|array
    {
        $list = Parking::all()->sortBy('name')->values();
        $list->prepend([
            'id' => 'any',
            'name' => __('All'),
            'address' => '',
            'description' => '',
            'inStreet' => false,
        ]);

        return $list;
    }

    public function zones($parking): Collection|array
    {
        $list = ParkingZone::forParking($parking)->get()->sortBy('code')->values();
        $list->prepend([
            'id' => 'any',
            'code' => __('All'),
            'available' => true,
            'parking' => null,
            'totalReservations' => null,
        ]);

        return $list;
    }

    public function edit(ParkingType $parkingType)
    {
        //
    }

    public function update(Request $request, ParkingType $parkingType)
    {
        //
    }

    public function destroy(ParkingType $parkingType)
    {
        //
    }
}
