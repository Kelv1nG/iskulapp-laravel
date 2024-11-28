<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectClassSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement("
            INSERT INTO subject_classes(
                subject_year_id,
                section_id,
                teacher_id
            )
            SELECT
                teacher_subjects.subject_year_id,
                sections.id AS section_id,
                teacher_subjects.teacher_id
            FROM teacher_subjects
            LEFT JOIN subject_years ON subject_years.id = teacher_subjects.subject_year_id
            LEFT JOIN subjects ON subjects.id = subject_years.subject_id
            LEFT JOIN sections ON sections.academic_year_id = subject_years.academic_year_id
            WHERE
                -- filter on grade level of subject and section name
                REGEXP_MATCH(subjects.name, 'grade_(\d+)')::TEXT = REGEXP_MATCH(sections.name, 'grade_(\d+)')::TEXT;
        ");
    }
}
