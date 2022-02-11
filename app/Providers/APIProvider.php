<?php

namespace App\Providers;

use App\Services\API\Apps\APIOperatorService;
use Illuminate\Support\ServiceProvider;

class APIProvider extends ServiceProvider
{
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

        // For API apps
        $this->app->bind('api.app', function ($app, $params) {
            return match ($params['resource']) {
                'operator' => new APIOperatorService($params['service'] ?? null),
                default => abort(403),
            };
        });

        // For API Web
        $this->app->bind('api.web', function ($app, $params) {
            return abort(403);
        });

        // For API files
        $this->app->bind('api.files', function ($app, $params) {
            return abort(403);
        });
    }
}
