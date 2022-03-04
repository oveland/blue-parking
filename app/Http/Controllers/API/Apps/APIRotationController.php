<?php

namespace App\Http\Controllers\API\Apps;

use App\Models\Reservations\RotationCheck;
use App\Services\Reservations\RotationService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class APIRotationController implements APIAppsInterface
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
     * @var RotationService
     */
    private $rotationService;

    public function __construct($service, RotationService $rotationService)
    {
        $this->request = request();
        $this->service = $service;

        $this->rotationService = $rotationService;
    }

    function serve(): JsonResponse
    {
        if ($this->service) {
            return match ($this->service) {
                'check-current' => $this->getCurrentCheck(),
                'check-start' => $this->startCheck(),
                'check-finish' => $this->finishCheck(),
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

    function startCheck(): JsonResponse
    {
        $response = collect(['success' => false]);

        try {
            $rotationCheck = $this->rotationService->createCheck([
                'start' => $this->request->get('date-start') ?? Carbon::now(),
                'coords' => $this->request->get('coords'),
                'parking_zone_id' => $this->request->get('parking-zone') ?? 1
            ]);

            $response->put('success', (bool)$rotationCheck);
            $response->put('rotationCheck', $rotationCheck?->toArray());

            if (!$rotationCheck) $response->put('message', 'Rotation check not created');
        } catch (Throwable $e) {
            $response->put('message', $e->getMessage());
        }

        return response()->json($response->toArray());
    }

    function getCurrentCheck(): JsonResponse
    {
        $status = $this->request->get('status') ?? 'any';
        $zone = $this->request->get('zone') ?? 'any';
        return response()->json($this->rotationService->getCurrentCheck($status, $zone));
    }

    function finishCheck(): JsonResponse
    {
        $response = collect(['success' => false, 'message' => 'Rotation check does not exists']);

        $rotationCheck = RotationCheck::find($this->request->get('id'));
        if (!$rotationCheck) return response()->json($response->toArray());

        try {
            $finishedReservations = $this->rotationService->processFinishCheck($rotationCheck, collect([
                'finish' => $this->request->get('date-finish') ?? Carbon::now(),
                'coords' => $this->request->get('coords')
            ]));

            $response->put('success', $rotationCheck->isFinished());
            $response->put('message', $rotationCheck->isFinished() ? '' : 'Rotation check not finished');
            $response->put('rotationCheck', $rotationCheck->toArray());
            $response->put('reservations', $finishedReservations->toArray());
        } catch (Throwable $e) {
            $response->put('message', $e->getMessage());
        }

        return response()->json($response->toArray());
    }
}
