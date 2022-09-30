<?php

namespace App\Http\Controllers\API\Apps;

use App\Services\ParkingLot\ParkingTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIParkingTypeController implements APIAppsInterface
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
     * @var ParkingTypeService
     */
    private $parkingTypeService;

    public function __construct($service, ParkingTypeService $parkingTypeService)
    {
        $this->request = request();
        $this->service = $service;

        $this->parkingTypeService = $parkingTypeService;
    }

    function serve(): JsonResponse
    {
        if ($this->service) {
            return match ($this->service) {
                'list' => $this->list(),
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

    function list(): JsonResponse
    {
        $parking = $this->request->get('parking');

        return response()->json($this->parkingTypeService->list($parking));
    }
}
