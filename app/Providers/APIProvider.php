<?php

namespace App\Providers;

use App\Http\Controllers\API\Apps\APIOperatorController;
use App\Http\Controllers\API\Apps\APIRotationController;
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
                'operator' => new APIOperatorController($params['service'] ?? null),
                'rotation' => new APIRotationController($params['service'] ?? null),
                default => self::NOT_FOUND_RESPONSE,
            };
        });
    }
}
