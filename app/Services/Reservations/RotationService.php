<?php

namespace App\Services\Reservations;

use App\Models\Reservations\Reservation;
use App\Models\Reservations\RotationCheck;
use Illuminate\Support\Collection;

class RotationService
{
    function getCheckPrevTo(RotationCheck $rotationCheck = null): ?RotationCheck
    {
        if (!$rotationCheck) return null;

        return RotationCheck::completed(true)
            ->where('id', '<', $rotationCheck->id)
            ->where('parking_zone_id', $rotationCheck->parking_zone_id)
            ->orderByDesc('finish')->first();
    }

    function getCurrentCheck($status = 'any', $zone = 'any'): ?RotationCheck
    {
        $rotationCheck = RotationCheck::current()->zoneQuery($zone)->first();

        if ($status === 'finished' && !$rotationCheck?->isFinished()) {
            return null;
        } else if ($status === 'active' && $rotationCheck?->isFinished()) {
            return null;
        }

        return $rotationCheck;
    }

    function createCheck($data): ?RotationCheck
    {
        $data = collect($data);

        $rotationCheck = new RotationCheck();
        $rotationCheck->fill($data->toArray());

        $rotationCheck->start($data->get('coords'));
        $rotationCheck->save();

        return $rotationCheck;
    }

    function processFinishCheck(RotationCheck &$rotationCheck = null, $data = null): Collection
    {
        if (!$rotationCheck) $rotationCheck = $this->getCurrentCheck('active');
        if (!$rotationCheck) return collect([]);

        $prevRotationCheck = $this->getCheckPrevTo($rotationCheck);

        $data = collect($data);
        $rotationCheck->finish = $data->get('finish');
        $rotationCheck->complete($data->get('coords'));
        $rotationCheck->save();
        $rotationCheck->refresh();

        $currentReservations = $rotationCheck->reservations;
        $prevReservations = $prevRotationCheck?->reservations;

        if ($prevReservations) {
            $terminateReservations = $prevReservations->filter(function (Reservation $prevReservation) use ($currentReservations) {
                return !$currentReservations->contains('id', $prevReservation->id);
            });

            $terminateReservations->each(function (Reservation $reservation) {
                $reservation->finalize();
                $reservation->save();
            });

            return $terminateReservations;
        }

        return collect([]);
    }
}
