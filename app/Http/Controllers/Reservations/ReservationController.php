<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservations\Reservation;
use App\Services\Reservations\ReservationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ReservationController extends Controller
{
    private ReservationService $service;

    public function __construct(ReservationService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws Throwable
     */
    public function open(ReservationRequest $request): Application|RedirectResponse|null
    {
        $reservation = $this->service->create($request);

        if (!$reservation) return null;

        return redirect(route('dashboard'));
    }

    public function show(): Collection|array
    {
        return $this->service->list();
    }

    /**
     * @throws Throwable
     */
    public function update(ReservationRequest $request, Reservation $reservation): RedirectResponse|Application|null
    {
        $reservation = $this->service->update($reservation, $request);

        if (!$reservation) return null;

        return redirect(route('dashboard'));
    }

    public function finalize(ReservationRequest $request, Reservation $reservation): RedirectResponse|Application|null
    {
        $reservation = $this->service->finalize($reservation);

        if (!$reservation) return null;

        return redirect(route('dashboard'));
    }

    public function destroy(Reservation $reservation): Application|RedirectResponse
    {
        $reservation->forceDelete();
        return redirect(route('dashboard'));
    }
}
