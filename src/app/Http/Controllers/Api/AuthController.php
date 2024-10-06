<?php

namespace App\Http\Controllers\Api;

use App\Constants\ApiMessages\AuthMessage as API_MSG;
use App\Constants\HttpStatus as STATUS;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserWithProfileResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function __construct() {}

    public function user(?User $user = null): UserResource
    {
        return new UserResource($user ?? auth()->user());
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            $user = Auth::user();
            optional($user->userProfile);
            $tokenResult = $user->createToken('UserToken');
            $accessToken = $tokenResult->accessToken;
            $expiry = $tokenResult->token->expires_at;

            return $this->response(
                statusCode: STATUS::HTTP_OK,
                message: API_MSG::AUTHENTICATION_SUCCESS,
                data: [
                    'user' => new UserWithProfileResource($user),
                    'access_token' => $accessToken,
                    'token_expiry' => $expiry,
                ]
            );
        } else {
            return $this->errorResponse(
                statusCode: STATUS::HTTP_UNAUTHORIZED,
                message: API_MSG::INVALID_CREDENTIALS
            );
        }
    }

    public function logout()
    {
        if (! auth()->user()) {
            return $this->errorResponse(
                statusCode: STATUS::HTTP_UNAUTHORIZED,
                message: API_MSG::NO_USER_ASSOCIATED,
            );
        }

        auth()->user()->token()->revoke();

        return $this->response(
            statusCode: STATUS::HTTP_OK,
            message: API_MSG::LOGOUT_SUCCESS,
        );
    }
}
