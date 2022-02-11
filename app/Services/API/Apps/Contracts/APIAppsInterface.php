<?php

namespace App\Services\API\Apps\Contracts;

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
