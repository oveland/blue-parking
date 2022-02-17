<?php

namespace App\Http\Controllers\API\Apps;

use Illuminate\Http\JsonResponse;

/**
 * Interface APIAppsInterface
 * @package App\Services\API\Apps\Contracts
 */
interface APIAppsInterface
{
    /**
     * @return JsonResponse
     */
    public function serve(): JsonResponse;
}
