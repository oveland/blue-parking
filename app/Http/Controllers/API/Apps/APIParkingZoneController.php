<?php

namespace App\Http\Controllers\API\Apps;

use App\Services\ParkingLot\ParkingZoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIParkingZoneController implements APIAppsInterface
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
     * @var ParkingZoneService
     */
    private $parkingZoneService;

    public function __construct($service, ParkingZoneService $parkingZoneService)
    {
        $this->request = request();
        $this->service = $service;

        $this->parkingZoneService = $parkingZoneService;
    }

    function serve(): JsonResponse
    {
        if ($this->service) {
            return match ($this->service) {
                'list' => $this->listZones(),
                'list-parking-lots' => $this->listParkingLots(),
                default => response()->json([
                    'success' => false,
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

    function listZones(): JsonResponse
    {
        $parking = $this->request->get('parking');

        return response()->json($this->parkingZoneService->list($parking));
    }

    function listParkingLots(): JsonResponse
    {
        $code = $this->request->get('code');

        return response()->json($this->parkingZoneService->listParkingLots($code));
    }
}
