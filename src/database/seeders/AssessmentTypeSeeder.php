<?php

namespace Database\Seeders;

use App\Models\AssessmentType;
use Illuminate\Database\Seeder;

class AssessmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assessmentTypes = [
            ['name' => 'quiz'],
            ['name' => 'exam'],
            ['name' => 'assignment'],
        ];

        AssessmentType::insert($assessmentTypes);
    }
}
