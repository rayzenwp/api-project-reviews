<?php

namespace App\Http\Controllers\API;

use App\Exceptions\Traits\ResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use ResponseTrait;

    public function show(Request $request): JsonResponse
    {
        return $this->respondWithCustomData([
            'user' => new UserResource($request->user()),
            'requestToken' => $request->user()->token()
        ], JsonResponse::HTTP_OK);
    }
}
