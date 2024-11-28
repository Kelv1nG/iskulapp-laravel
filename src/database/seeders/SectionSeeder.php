<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    const SECTION_NAMES = ['A', 'B'];

    public function run(): void
    {
        $sectionRecords = $this->prepareSectionRecords();
        Section::insert($sectionRecords);
    }

    private function prepareSectionRecords(): array
    {
        /// select all grade levels for alls school for all academic years
        $results = DB::select('
            SELECT
                academic_years.id AS academic_year_id,
                academic_years.school_id,
                grade_levels.id AS grade_level_id,
                grade_levels.name AS grade_level_name
            FROM academic_years
            LEFT JOIN grade_levels ON grade_levels.school_id = academic_years.school_id
        ');

        $sectionRecords = [];
        foreach ($results as $result) {
            foreach (self::SECTION_NAMES as $sectionName) {
                $sectionRecords[] = [
                    'academic_year_id' => $result->academic_year_id,
                    'grade_level_id' => $result->grade_level_id,
                    'name' => $sectionName.'-'.$result->grade_level_name,
                ];
            }
        }

        return $sectionRecords;
    }
}
