<?php

namespace App\Services\API\Apps;

use App\Services\API\Apps\Contracts\APIAppsInterface;
use App\Services\Reservations\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class APIOperatorService implements APIAppsInterface
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

    public function __construct($service)
    {
        $this->request = request();
        $this->service = $service;

        $this->reservationService = new ReservationService();
    }

    function serve(): JsonResponse
    {
        if ($this->service) {
            return match ($this->service) {
                'create-reservation' => $this->createReservation(),
                'decode-vehicle-plate' => $this->decodeVehiclePlate(),
                default => response()->json([
                    'error' => true,
                    'message' => 'Invalid action serve'
                ]),
            };
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No service found!'
            ]);
        }
    }

    function decodeVehiclePlate(): JsonResponse
    {
        $response = collect(['success' => false]);

        $photoData = $this->decodeImageData($this->request->get('photo'));

        // TODO: Integrate AWS Rekognition
        $response->put('success', (bool)$photoData);
        $response->put('plate', 'GLV041');

        return response()->json($response);
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

    private function decodeImageData($base64): string
    {
        $image_parts = explode(";base64,", $base64);
        return base64_decode($image_parts[1]);
    }
}
