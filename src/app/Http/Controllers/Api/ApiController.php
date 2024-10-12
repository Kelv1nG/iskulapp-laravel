<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * @param  int  $statusCode  The HTTP status code.
     * @param  string|null  $message  An optional message to include in the response.
     * @param  mixed|null  $data  Optional data to include in the response.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    public function response($statusCode, $message = null, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function listResponse($data, string $collectionClass, int $itemsPerPage = 100)
    {
        return new $collectionClass($data->simplePaginate($itemsPerPage));
    }

    /**
     * @param  int  $statusCode  The HTTP status code.
     * @param  string  $message  brief error message to include in the response.
     * @param  string|null  $details  Optional error details to include in the response.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    public function errorResponse($statusCode, $message, $details = null)
    {
        return response()->json([
            'message' => $message,
            'details' => $details,
        ], $statusCode);
    }
}
