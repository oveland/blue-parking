<?php


namespace App\Services\Reservations;


use App\Models\ParkingLot\ParkingType;
use App\Models\ParkingLot\ParkingZone;
use App\Models\Reservations\Reservation;
use App\Models\User;
use App\Models\Vehicles\Vehicle;
use App\Models\Vehicles\VehicleType;
use App\Services\AWS\RekognitionService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;
use Illuminate\Support\Collection;
use Throwable;

class ReservationService
{
    function list(): Collection|array
    {
        return Reservation::all();
    }

    function searchVehicleReservation(Vehicle $vehicle)
    {
        if (!$vehicle) return null;

        return Reservation::where('vehicle_id', $vehicle->id)->first();
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

        if ($reservation) {
            $reservation->updated_at = Carbon::now();
            $reservation->save();
            return $reservation;
        }

        $reservation = new Reservation();
        $reservation->start = $date;
        $reservation->hold_start = $date;
        $reservation->hold_end = $date;
        $reservation->hold_timeout = 60;
        $reservation->active = true;

        DB::beginTransaction();

        $reservation->vehicle()->associate($vehicle);
        $reservation->type()->associate(ParkingType::find($data->get('type')['id']));
        $reservation->zone()->associate(ParkingZone::find($data->get('zone')['id']));

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

    function finalize(Reservation $reservation, Collection|Request $data): ?Reservation
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
        $dataUser = $dataVehicle['user'];
        $nameUser = $dataUser['name'] ?? __('Internal');

        if (!$vehicle) {
            $vehicle = new Vehicle($dataVehicle);
            $user = new User($dataVehicle['user']);
            $user->name = $nameUser;

            $user->email = Carbon::now()->format('y.m.d.h.i.s.u') . '@mail.com';
            $user->password = Hash::make('12345');
        } else {
            $user = $vehicle->user;
            if ($update) $user->name = $nameUser;

            $vehicle->fill($dataVehicle);
        }

        $user->save();

        $vehicle->user()->associate($user);
        $vehicle->type()->associate(VehicleType::find($data->get('type')['vehicleType']['id']));
        $vehicle->save();

        return $vehicle;
    }

    function decodeVehiclePlate($photo): string
    {
        $rekognitionService = new RekognitionService();

        $textInPhoto = $rekognitionService->setPhoto($photo)->getText();

        $betterDetection = collect($textInPhoto)->filter(function ($data) {
            $text = str_replace(" ", "", $data['DetectedText']);

            return strlen($text) == 6 && strtoupper($text) === $text;
        })->sortByDesc('Confidence')->first();

        return str_replace(" ", "", $betterDetection['DetectedText'] ?? "");
    }
}
