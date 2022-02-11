<?php

namespace App\Http\Controllers\API;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;

class APIController extends Controller
{
    const PLATFORM = ['app', 'web', 'files'];

    /**
     * Inbound main API
     * @param $platform
     * @param $resource
     * @param $service
     * @return mixed
     * @throws BindingResolutionException
     * @api v1.0
     *
     * @example For API Apps:   /v1/app/service?foo=bar
     * @example For API Web:    /v1/web/service?foo=bar
     * @example For API Files:  /v1/files/service?foo=bar
     */
    public function serve($platform, $resource, $service): mixed
    {
        if (collect(self::PLATFORM)->contains($platform) && $resource && $service) {
            return App::makeWith("api", compact(['platform', 'resource', 'service']))->serve();
        }

        return response()->json([
            'success' => false,
            'error' => true,
            'message' => "Platform ($platform) or Resource ($resource) or Service ($service) not specified yet"
        ]);
    }
}
