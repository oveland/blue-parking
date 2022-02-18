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
use Illuminate\Support\Collection;
use Throwable;

class ReservationService
{
    /**
     * @var RotationService
     */
    private $rotationCheckService;

    public function __construct(RotationService $rotationCheckService)
    {
        $this->rotationCheckService = $rotationCheckService;
    }

    function list($status = 'any', $zone = 'any'): Collection|array
    {
        return Reservation::statusQuery($status)->zoneQuery($zone)->orderBy('start')->get();
    }

    function searchVehicleReservation(Vehicle $vehicle = null): ?Reservation
    {
        if (!$vehicle) return null;

        return Reservation::where('vehicle_id', $vehicle->id)->statusQuery('active')->first();
    }

    /**
     * @throws Throwable
     */
    function create(Collection|Request $data): ?Reservation
    {
        Log::info("Creating reservation ", $data->toArray());

        $date = $data->get('date') ?? Carbon::now();

        $vehicle = $this->validateVehicle($data);
        $reservation = $this->searchVehicleReservation($vehicle);
        $parkingZone = ParkingZone::find($data->get('zone')['id']);

        $currentRotationCheck = $this->rotationCheckService->getCurrentCheck('active', $parkingZone->id);
        $prevRotationCheck = $this->rotationCheckService->getCheckPrevTo($currentRotationCheck);

        if ($reservation &&
            ($reservation->rotationCheck?->id == $currentRotationCheck?->id || $reservation->rotationCheck?->id == $prevRotationCheck?->id) &&
            ($reservation->parking_zone_id == $prevRotationCheck?->parking_zone_id)
        ) {
            $reservation->updated_at = Carbon::now();
            $reservation->rotationCheck()->associate($currentRotationCheck);
            $reservation->save();

            return $reservation;
        }

        $reservation = new Reservation();
        $reservation->rotationCheck()->associate($currentRotationCheck);

        $reservation->start = $date;
        $reservation->hold_start = $date;
        $reservation->hold_end = $date;
        $reservation->hold_timeout = 60;
        $reservation->active = true;

        DB::beginTransaction();

        $reservation->vehicle()->associate($vehicle);
        $reservation->type()->associate(ParkingType::find($data->get('type')['id']));
        $reservation->zone()->associate($parkingZone);

        if ($reservation->save()) {
            DB::commit();
            return $reservation;
        }

        DB::rollBack();
        return null;
    }

    /**
     * @throws Throwable
     */
    function update(Reservation $reservation, Collection|Request $data): ?Reservation
    {
        Log::info("Updating reservation ", $data->toArray());

        DB::beginTransaction();

        $reservation->vehicle()->associate($this->validateVehicle($data, true));
        $reservation->type()->associate(ParkingType::find($data->get('type')['id']));
        $reservation->zone()->associate(ParkingZone::find($data->get('zone')['id']));

        if ($reservation->save()) {
            DB::commit();
            return $reservation;
        }

        DB::rollBack();
        return null;
    }

    function finalize(Reservation $reservation): ?Reservation
    {
        Log::info("Finalizing reservation: " . $reservation->id);

        $reservation->finalize();

        if ($reservation->save()) {
            return $reservation;
        }

        return null;
    }

    private function validateVehicle(Collection|Request $data, $update = false): Vehicle
    {
        $vehicle = Vehicle::where('plate', $data->get('vehicle')['plate'])->first();

        $dataVehicle = $data->get('vehicle');
        $nameUser = $dataVehicle['user']['name'] ?? null;

        if (!$vehicle) {
            $vehicle = new Vehicle($dataVehicle);

            if ($nameUser) {
                $user = new User($dataVehicle['user']);
                $user->name = $nameUser;
                $user->email = Carbon::now()->format('y.m.d.h.i.s.u') . '@mail.com';
                $user->password = Hash::make('12345');
                $user->role = 3;
            }
        } else {
            $user = $vehicle->user;
            if ($update && $user) $user->name = $nameUser;

            $vehicle->fill($dataVehicle);
        }

        if ($nameUser) {
            $user->save();
            $vehicle->user()->associate($user);
        } elseif (isset($user)) {
            $user->delete();
        }

        $vehicle->type()->associate(VehicleType::find($data->get('type')['vehicleType']['id']));
        $vehicle->save();

        return $vehicle;
    }
}
