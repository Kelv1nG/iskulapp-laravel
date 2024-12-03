<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentStudentReportSeeder extends Seeder
{
    public function run(): void
    {
        /// get 2 most recent academic years for each school (4 since there are 2 terms)
        /// half of the students in the section didnt submit their assessments (bad bad students)
        /// ^ above is to just simulate students with no entries in assessment
        DB::statement('
            WITH ranked_academic_years AS (
                SELECT
                    *,
                    ROW_NUMBER() OVER (PARTITION BY school_id ORDER BY "end" DESC) AS row_num
                FROM academic_years
            ),
            recent_academic_years AS (
                SELECT
                    id AS academic_year_id
                FROM ranked_academic_years
                WHERE row_num <= 4
            ),
            insert_data AS (
                SELECT DISTINCT
                    students.id AS student_id,
                    assessment_takers.assessment_id,
                    NOW() AS started_at,
                    NOW() + INTERVAL \'30 minutes\' AS finished_at
                FROM students
                LEFT JOIN student_sections ON student_sections.student_id = students.id
                LEFT JOIN sections ON sections.id = student_sections.section_id
                LEFT JOIN assessment_takers ON assessment_takers.section_id = sections.id
                LEFT JOIN academic_years ON academic_years.id = sections.academic_year_id
                INNER JOIN recent_academic_years ON recent_academic_years.academic_year_id = academic_years.id
                WHERE students.id % 2 = 0
            )

            INSERT INTO assessment_student_reports
            (student_id, assessment_id, started_at, finished_at)
            SELECT *
            FROM insert_data
        ');

    }
}
