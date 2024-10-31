<?php

namespace App\DataHandlers;

use App\Models\AssessmentTaker;

class AssessmentTakerHandler extends BaseHandler
{
    public static function upsert($data)
    {
        AssessmentTaker::upsert([$data], uniqueBy: ['id'], update: array_keys($data));
    }

    public static function update($data) {}

    public static function delete($data) {}
}
