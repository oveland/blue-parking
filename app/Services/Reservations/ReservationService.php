<?php


namespace App\Services\Reservations;


use App\Models\ParkingLot\ParkingType;
use App\Models\ParkingLot\ParkingZone;
use App\Models\Reservations\Reservation;
use App\Models\User;
use App\Models\Vehicles\Vehicle;
use App\Models\Vehicles\VehicleType;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;
use Ramsey\Collection\Collection;
use Throwable;

class ReservationService
{
    /**
     * @throws Throwable
     */
    function create(Collection|Request $data): ?Reservation
    {
        Log::info("Creating reservation ", $data->toArray());

        $reservation = new Reservation();
        $reservation->start = Carbon::now();
        $reservation->hold_start = Carbon::now();
        $reservation->hold_end = Carbon::now();
        $reservation->hold_timeout = 60;
        $reservation->active = true;

        DB::beginTransaction();

        $reservation->vehicle()->associate($this->validateVehicle($data));
        $reservation->type()->associate(ParkingType::find($data->get('parkingType')['id']));
        $reservation->zone()->associate(ParkingZone::find($data->get('zone')['id']));

        if ($reservation->save()) {
            DB::commit();
            return $reservation;
        }

        DB::rollBack();
        return null;
    }

    private function validateVehicle(Collection|Request $data): Vehicle
    {
        $vehicle = Vehicle::where('plate', $data->get('vehicle')['plate'])->first();

        if (!$vehicle) {
            $dataVehicle = $data->get('vehicle');
            $vehicle = new Vehicle($dataVehicle);

            $user = new User($dataVehicle['user']);
            $user->email = Carbon::now()->format('y.m.d.h.i.s.u') . '@mail.com';
            $user->password = Hash::make('12345');
            $user->save();

            $vehicle->user()->associate($user);
            $vehicle->type()->associate(VehicleType::find($data->get('parkingType')['vehicleType']['id']));
            $vehicle->save();
        }

        return $vehicle;
    }
}
