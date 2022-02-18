<?php

namespace App\Http\Controllers\API\Apps;

use App\Services\Reservations\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class APIReservationController implements APIAppsInterface
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var string
     */
    private $service;

    /**
     * @var ReservationService
     */
    private $reservationService;

    public function __construct($service, ReservationService $reservationService)
    {
        $this->request = request();
        $this->service = $service;

        $this->reservationService = $reservationService;
    }

    function serve(): JsonResponse
    {
        if ($this->service) {
            return match ($this->service) {
                'list' => $this->listReservations(),
                'create' => $this->createReservation(),
                default => response()->json([
                    'error' => true,
                    'message' => 'No action serve'
                ]),
            };
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No service found!'
            ]);
        }
    }

    function listReservations():JsonResponse {

        $status = $this->request->get('status');
        $zone = $this->request->get('zone');

        return response()->json($this->reservationService->list($status, $zone));
    }

    function createReservation(): JsonResponse
    {
        $response = collect(['success' => false]);

        $data = collect([
            'date' => $this->request->get('timestamp') ? Carbon::createFromTimestamp($this->request->get('timestamp')) : Carbon::now(),
            'vehicle' => [
                'plate' => $this->request->get('vehicle-plate'),
                'user' => [
                    'name' => $this->request->get('user-name'),
                ],
            ],
            'type' => [
                'id' => $this->request->get('parking-type'),
                'vehicleType' => [
                    'id' => $this->request->get('vehicle-type')
                ],
            ],
            'zone' => [
                'id' => $this->request->get('parking-zone')
            ],
            'location' => [
                'latitude' => $this->request->get('location-lat'),
                'longitude' => $this->request->get('location-lng'),
            ]
        ]);

        try {
            $reservation = $this->reservationService->create($data);

            if ($reservation) {
                $response->put('success', true);
                $response->put('reservation', $reservation->toArray());
            } else {
                $response->put('message', 'Reservation not created');
            }
        } catch (Throwable $e) {
            $response->put('message', $e->getMessage());
        }

        return response()->json($response->toArray());
    }
}