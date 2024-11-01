<?php

namespace App\Http\Controllers\Api;

use App\Constants\HttpStatus;
use App\DataHandlers\DataHandler;
use App\DataHandlers\Exceptions\NoTableException;
use Illuminate\Http\Request;

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
        } catch (NoTableException $e) {
            return $this->errorResponse(
                HttpStatus::HTTP_BAD_REQUEST,
                'Failed to upload data',
                $e->getMessage()
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                HttpStatus::HTTP_INTERNAL_SERVER_ERROR,
                'Failed to upload data',
                $e->getMessage()
            );
        }
    }
}
