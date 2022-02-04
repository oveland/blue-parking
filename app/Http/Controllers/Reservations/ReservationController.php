<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservations\Reservation;
use App\Services\Reservations\ReservationService;
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
    public function store(ReservationRequest $request): Redirector|Application|RedirectResponse|null
    {
        $reservation = $this->service->create($request);

        if (!$reservation) return null;

        return redirect(route('dashboard'));
    }

    public function show(Request $request): Collection|array
    {
        return Reservation::all();
    }

    public function edit(Reservation $reservation)
    {

    }

    /**
     * @throws Throwable
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $reservation = $this->service->update($reservation, $request);

        if (!$reservation) return null;

        return redirect(route('dashboard'));
    }

    public function destroy(Reservation $reservation): Redirector|Application|RedirectResponse
    {
        $reservation->forceDelete();
        return redirect(route('dashboard'));
    }
}
