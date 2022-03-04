<?php

namespace App\Http\Controllers\API\Apps;

use App\Services\Vehicles\VehicleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIVehicleController implements APIAppsInterface
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
     * @var VehicleService
     */
    private $vehicleService;

    public function __construct($service, VehicleService $vehicleService)
    {
        $this->request = request();
        $this->service = $service;

        $this->vehicleService = $vehicleService;
    }

    function serve(): JsonResponse
    {
        if ($this->service) {
            return match ($this->service) {
                'decode-plate' => $this->decodePlate(),
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

    function decodePlate(): JsonResponse
    {
        $response = collect(['success' => false]);

        $photoData = $this->request->get('photo');
        $uid = $this->request->get('uid');
        $datetime = $this->request->get('datetime');

        $photo = $this->decodeImageData($photoData);
        $vehiclePlate = $this->vehicleService->decodePlate($photo, $uid, $datetime);

        $response->put('success', (bool)$vehiclePlate);
        $response->put('plate', $vehiclePlate);

        return response()->json($response);
    }

    private function decodeImageData($base64): string
    {
        $image_parts = explode(";base64,", $base64);
        if (!isset($image_parts[1])) return '';
        return base64_decode($image_parts[1]);
    }
}
