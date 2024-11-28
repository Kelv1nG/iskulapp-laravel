<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    const BASE_SUBJECTS = [
        'math',
        'physcial_education',
        'religion',
        'english',
        'music',
        'sex_education',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectRecords = $this->prepareSubjectRecords();
        Subject::insert($subjectRecords);
    }

    /*
    * create subjects for each grade level i.e math-grade_1, math-grade_2
    */
    private function prepareSubjectRecords(): array
    {
        $results = DB::select('
            SELECT
                gl.id AS grade_level_id,
                gl.name AS grade_level_name,
                schools.id AS school_id,
                schools.short_name AS school_short_name
            FROM grade_levels AS gl
            LEFT JOIN schools ON schools.id = gl.school_id
        ');

        $subjectRecords = [];
        foreach ($results as $result) {
            foreach (self::BASE_SUBJECTS as $subject) {
                $subjectRecords[] = [
                    'name' => "{$subject}-{$result->grade_level_name}-{$result->school_short_name}",
                    'school_id' => $result->school_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        return $subjectRecords;
    }
}
