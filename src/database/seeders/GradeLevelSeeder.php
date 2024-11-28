<?php

namespace Database\Seeders;

use App\Models\GradeLevel;
use App\Models\School;
use Illuminate\Database\Seeder;

class GradeLevelSeeder extends Seeder
{
    const GRADE_LEVEL_NAMES = ['grade_1', 'grade_2', 'grade_3', 'grade_4', 'grade_5', 'grade_6', 'grade_7', 'grade_8', 'grade_9', 'grade_10'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gradeLevelRecords = $this->prepareGradeLevelRecords();
        GradeLevel::insert($gradeLevelRecords);
    }

    private function prepareGradeLevelRecords(): array
    {
        $schoolIds = School::pluck('id')->toArray();

        $gradeLevelRecords = [];
        foreach ($schoolIds as $schoolId) {
            foreach (self::GRADE_LEVEL_NAMES as $gradeLevelName) {
                $gradeLevelRecords[] = [
                    'school_id' => $schoolId,
                    'name' => $gradeLevelName,
                ];
            }
        }

        return $gradeLevelRecords;
    }
}
