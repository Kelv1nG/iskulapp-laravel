<?php

namespace App\Http\Controllers\Api;

use App\Constants\HttpStatus;
use App\DataHandlers\DataHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PowersyncDataController extends ApiController
{
    public function uploadData(Request $request)
    {
        try {
            $method = $request->method();
            $json = $request->json()->all();
            $table = $json['table'];
            $data = $json['data'];
            DataHandler::handle($table, $method, $data);

            return $this->response(HttpStatus::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('PowerSync data upload failed: '.$e->getMessage());

            return $this->errorResponse(
                HttpStatus::HTTP_INTERNAL_SERVER_ERROR,
                'Failed to upload data',
                $e->getMessage()
            );
        }
    }
}
