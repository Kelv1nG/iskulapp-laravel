<?php

namespace Database\Seeders;

use App\Models\SubjectClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectClassSeeder extends Seeder
{
    public function run(): void
    {
        $this->createSubjectClasses();
    }

    private function createSubjectClasses(): void
    {
        $subjectClassRecords = $this->prepareSubjectClassRecords();
        foreach (array_chunk($subjectClassRecords, 1000) as $chunk) {
            SubjectClass::insert($chunk);
        }
    }

    private function prepareSubjectClassRecords(): array
    {
        /// section names and subject names correspond to grade levels here
        ///  distribute the subjects for each teacher to a section with their corresponding academic years
        $results = DB::select("
            SELECT
                teacher_subjects.teacher_id,
                teacher_subjects.subject_year_id,
                subject_years.academic_year_id,
                subjects.name AS subject_name,
                sections.id AS section_id,
                sections.name AS section_name
            FROM teacher_subjects
            LEFT JOIN subject_years ON subject_years.id = teacher_subjects.subject_year_id
            LEFT JOIN subjects ON subjects.id = subject_years.subject_id
            LEFT JOIN sections ON sections.academic_year_id = subject_years.academic_year_id
            WHERE
                -- filter on grade level of subject and section name
                REGEXP_MATCH(subjects.name, 'grade_(\d+)')::TEXT = REGEXP_MATCH(sections.name, 'grade_(\d+)')::TEXT;
            ");

        $classRecords = [];
        foreach ($results as $result) {
            $classRecords[] = [
                'subject_year_id' => $result->subject_year_id,
                'section_id' => $result->section_id,
                'teacher_id' => $result->teacher_id,
            ];
        }

        return $classRecords;
    }
}
