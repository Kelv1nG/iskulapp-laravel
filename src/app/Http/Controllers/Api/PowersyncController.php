<?php

namespace App\Http\Controllers\Api;

use App\Constants\HttpStatus as STATUS;
use App\Utils\PowerSyncUtils;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

final class PowersyncController extends Controller
{
    public function getPowerSyncToken(): JsonResponse
    {
        try {
            $token = PowerSyncUtils::createJwtToken(Auth::user()->id);

            return response()->json([
                'token' => $token,
                'powersync_url' => PowerSyncUtils::$powerSyncUrl,
            ], STATUS::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getKeys(): JsonResponse
    {
        try {
            $publicKey = PowerSyncUtils::getPublicKeyJson();

            return response()->json([
                'keys' => [$publicKey],
            ], STATUS::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
