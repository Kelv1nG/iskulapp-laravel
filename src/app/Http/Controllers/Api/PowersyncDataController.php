<?php

namespace App\Http\Controllers\API;

use App\DataHandlers\DataHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PowersyncDataController extends Controller
{
    public function uploadData(Request $request)
    {

        $method = $request->method();

        $data = $request->json()->all();
        $table = $data['table'];
        $itemData = $data['data'];

        $result = DataHandler::handle($table, $method, $data);
    }
}
