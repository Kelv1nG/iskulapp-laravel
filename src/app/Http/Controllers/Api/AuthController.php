<?php

namespace App\Http\Controllers\Api;

use App\Constants\ApiMessages\AuthMessage as API_MSG;
use App\Constants\HttpStatus as STATUS;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\User\UserWithRelatedInfoResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends ApiController
{
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
                    'user' => new UserWithRelatedInfoResource($user),
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
