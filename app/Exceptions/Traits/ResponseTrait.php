<?php

namespace App\Exceptions\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{
    protected string $resourceItem;
    protected string $resourceCollection;

    protected function respondWithCustomData($data, $status = 200): JsonResponse
    {
        return new JsonResponse([
            'data' => $data,
        ], $status);
    }

    protected function respondWithNoContent(): JsonResponse
    {
        return new JsonResponse([
            'data' => null,
        ], Response::HTTP_NO_CONTENT);
    }
}
