<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Subject;
use App\Models\SubjectYear;
use Illuminate\Database\Seeder;

class SubjectYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectIds = Subject::pluck('id');
        $academicYearIds = AcademicYear::pluck('id');

        // create unique combinations of subject_id and academic_year_id
        $combinations = $subjectIds->crossJoin($academicYearIds)->shuffle()->take(5);

        foreach ($combinations as $combination) {
            SubjectYear::factory()->create([
                'subject_id' => $combination[0],
                'academic_year_id' => $combination[1],
            ]);
        }
    }
}
