<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentAttendanceSeeder extends Seeder
{
    // create attendance for every student of current academic year of each school
    // weekends are excluded
    // absent randomized at 10%, late at 20%
    public function run(): void
    {
        DB::statement(<<<'SQL'
        WITH max_acad_years AS (
            SELECT academic_years.id
            FROM academic_years
            INNER JOIN (
                SELECT school_id, MAX("end") AS max_end_date
                FROM academic_years
                GROUP BY school_id
            ) AS max_years ON max_years.school_id = academic_years.school_id AND max_years.max_end_date = academic_years."end"
        ),
        max_acad_year_students AS (
            SELECT
                student_year.student_id,
                sections.id AS section_id,
                academic_years.start AS start_date,
                academic_years."end" AS end_date
            FROM student_year
            INNER JOIN academic_years ON academic_years.id = student_year.academic_year_id
            LEFT JOIN student_sections ON student_sections.student_id = student_year.student_id
            LEFT JOIN sections ON sections.id = student_sections.section_id
            WHERE student_year.academic_year_id IN (SELECT id FROM max_acad_years)
        ),
        init_student_ts AS (
            SELECT
                student_id,
                section_id,
                generated_day AS attendance_date,
                EXTRACT(DOW FROM generated_day) IN (0, 6) AS is_weekend,
                CASE WHEN EXTRACT(DOW FROM generated_day) IN (0, 6) THEN FALSE
                    ELSE random() < 0.1
                END AS is_absent
            FROM max_acad_year_students,
            LATERAL generate_series(start_date, end_date, interval '1 day') AS generated_day
        ),
        insert_data AS (
            SELECT
                student_id,
                section_id,
                attendance_date,
                is_absent,
                CASE
                    WHEN is_weekend THEN NULL
                    WHEN is_absent THEN NULL
                    WHEN random() < 0.2 THEN '07:15:00'::time
                    ELSE '07:00:00'::time
                END AS time_in
            FROM init_student_ts
        )

        INSERT INTO attendances(
            id,
            student_id,
            section_id,
            attendance_date,
            is_absent,
            time_in
        )
        SELECT gen_random_uuid(), * FROM insert_data
    SQL);
    }
}
