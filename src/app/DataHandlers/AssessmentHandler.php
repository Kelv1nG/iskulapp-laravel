<?php

namespace App\DataHandlers;

use App\Models\Assessment;

class AssessmentHandler extends BaseHandler
{
    public static function upsert($data): void
    {
        Assessment::upsert([$data], uniqueBy: ['id'], update: array_keys($data));
    }

    public static function update($data): void
    {

        $assessment = Assessment::findOrFail($data['id']);

        $filteredData = array_filter($data, function ($value) {
            return $value !== null;
        });

        $assessment->update($filteredData);
    }

    public static function delete($data) {}
}
