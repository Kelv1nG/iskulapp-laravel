<?php

namespace App\DataHandlers;

use App\Models\Attendance;

class AttendanceHandler extends BaseHandler
{
    public static function upsert($data): void
    {
        Attendance::upsert([$data], uniqueBy: ['id'], update: array_keys($data));
    }

    public static function update($data): void
    {
        $attendance = Attendance::findOrFail($data['id']);

        $filteredData = array_filter($data, function ($value) {
            return $value !== null;
        });

        $attendance->update($filteredData);
    }

    public static function delete($data)
    {
        Attendance::findOrFail($data['id'])->delete();
    }
}
