<?php

namespace App\Services\API\Apps;

use App\Services\API\Apps\Contracts\APIAppsInterface;
use App\Services\Reservations\ReservationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
                'sample' => response()->json([
                    'error' => false,
                    'message' => 'Sample response'
                ]),
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
}
