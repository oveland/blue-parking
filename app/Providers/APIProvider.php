<?php

namespace App\Providers;

use App\Http\Controllers\API\Apps\APIParkingZoneController;
use App\Http\Controllers\API\Apps\APIReservationController;
use App\Http\Controllers\API\Apps\APIRotationController;
use App\Http\Controllers\API\Apps\APIVehicleController;
use App\Services\ParkingLot\ParkingZoneService;
use App\Services\Reservations\ReservationService;
use App\Services\Reservations\RotationService;
use App\Services\Vehicles\VehicleService;
use Illuminate\Support\ServiceProvider;

class APIProvider extends ServiceProvider
{
    const NOT_FOUND_RESPONSE = [
        'success' => false,
        'message' => 'Platform resource not found'
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // For access global API
        $this->app->bind('api', function ($app, $params) {
            $platform = $params['platform'];
            return app("api.$platform", $params);
        });

        // For API Apps
        $this->app->bind('api.app', function ($app, $params) {
            return match ($params['resource']) {
                'zone' => new APIParkingZoneController($params['service'] ?? null, new ParkingZoneService()),
                'vehicle' => new APIVehicleController($params['service'] ?? null, new VehicleService()),
                'rotation' => new APIRotationController($params['service'] ?? null, new RotationService()),
                'reservation' => new APIReservationController($params['service'] ?? null, new ReservationService(new RotationService())),
                default => self::NOT_FOUND_RESPONSE,
            };
        });
    }
}
