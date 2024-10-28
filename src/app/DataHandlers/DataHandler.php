<?php

namespace App\DataHandlers;

use App\Models\Assessment;
use App\Models\AssessmentTaker;
use Exception;

class DataHandler
{
    public static function handle($table, $method, $data)
    {
        $handler = self::getHandler($table);

        return $handler::handle($method, $data);
    }

    public static function getHandler($table)
    {
        $handlers = [
            Assessment::getTableName() => AssessmentHandler::class,
            AssessmentTaker::getTableName() => AssessmentTakerHandler::class,
        ];

        if (! isset($handlers[$table])) {
            throw new Exception("No handler found for table: $table");
        }

        return $handlers[$table];
    }
}
