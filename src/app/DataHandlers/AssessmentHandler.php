<?php

namespace App\DataHandlers;

use App\Models\Assessment;

class AssessmentHandler extends BaseHandler
{
    public static function upsert($data)
    {
        Assessment::upsert([$data], uniqueBy: ['id'], update: array_keys($data));
    }

    public static function update($data) {}

    public static function delete($data) {}
}
