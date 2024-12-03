<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('
            INSERT INTO subject_years
            (academic_year_id, subject_id)
            SELECT
                academic_years.id AS academic_year_id,
                subjects.id as subject_id
            FROM subjects
            LEFT JOIN academic_years ON academic_years.school_id = subjects.school_id
        ');
    }
}
