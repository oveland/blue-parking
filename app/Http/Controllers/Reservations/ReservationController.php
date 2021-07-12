<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Models\ParkingLot\ParkingType;
use App\Models\Reservations\Reservation;
use App\Models\Reservations\ReservationType;
use App\Models\User;
use App\Models\Vehicles\Vehicle;
use App\Models\Vehicles\VehicleType;
use App\Services\Reservations\ReservationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class ReservationController extends Controller
{
    private ReservationService $service;

    public function __construct(ReservationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    /**
     * @throws Throwable
     */
    public function store(Request $request): Redirector|Application|RedirectResponse
    {
        $reservation = $this->service->create($request);

        if (!$reservation) {
            $response = [
                'banner' => __('Reservation not created')
            ];
        }

        return redirect(route('dashboard'))->with([
            'banner' => 'Test error message',
            'bannerStyle' => 'error'
        ]);
    }

    public function show(Request $request): Collection|array
    {
        return Reservation::all();
    }

    public function edit(Reservation $reservation)
    {
        //
    }

    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    public function destroy(Reservation $reservation)
    {
        //
    }
}
