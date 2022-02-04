<?php

namespace App\Http\Controllers\ParkingLot;

use App\Http\Controllers\Controller;
use App\Models\ParkingLot\ParkingType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ParkingTypeController extends Controller
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

    public function show($filer): Collection|array
    {
        return match ($filer) {
            'all' => ParkingType::all(),
            default => ParkingType::where('id', $filer)->get(),
        };
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
