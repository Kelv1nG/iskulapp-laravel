<?php

namespace App\DataHandlers;

use App\Models\AssessmentTaker;

class AssessmentTakerHandler extends BaseHandler
{
    public static function upsert($data): void
    {
        AssessmentTaker::upsert([$data], uniqueBy: ['id'], update: array_keys($data));
    }

    public static function update($data): void
    {
        $assessmentTaker = AssessmentTaker::findOrFail($data['id']);

        $filteredData = array_filter($data, function ($value) {
            return $value !== null;
        });

        $assessmentTaker->update($filteredData);
    }

    public static function delete($data) {}
}
