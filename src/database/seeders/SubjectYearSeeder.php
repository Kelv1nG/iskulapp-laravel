<?php

namespace Database\Seeders;

use App\Models\SubjectYear;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectYearRecords = $this->prepareSubjectYearRecords();
        SubjectYear::insert($subjectYearRecords);
    }

    /*
    * prepare each subject for every academic year for all schools
    */
    private function prepareSubjectYearRecords(): array
    {
        // combination of academic years and subjects
        $results = DB::select('
             SELECT
                academic_years.id AS academic_year_id,
                subjects.id as subject_id,
                subjects.name as subject_name,
                academic_years.name as academic_year_name
            FROM subjects
            LEFT JOIN academic_years ON academic_years.school_id = subjects.school_id
        ');

        $subjectYearRecords = [];
        foreach ($results as $result) {
            $subjectYearRecords[] = [
                'academic_year_id' => $result->academic_year_id,
                'subject_id' => $result->subject_id,
            ];
        }

        return $subjectYearRecords;
    }
}
