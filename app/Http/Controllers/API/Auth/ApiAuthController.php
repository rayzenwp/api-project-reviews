<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\Traits\ResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    use ResponseTrait;

    public function login(LoginRequest $request)
    {
        if(!auth()->attempt($request->validated())){

            return $this->respondWithCustomData(
                [
                    'errors' => ['email' => __('auth.failed')]
                ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('API Token')->accessToken;

                $response = ['token' => $token];
                return $this->respondWithCustomData($response, JsonResponse::HTTP_OK);
            } else {
                $response = ["message" => __('auth.password')];
                return $this->respondWithCustomData($response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => __('auth.logout')];

        return $this->respondWithCustomData($response, JsonResponse::HTTP_OK);
    }
}
