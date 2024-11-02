<?php

namespace Database\Factories;

use App\Models\Assessment;
use App\Models\SubjectYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssessmentTaker>
 */
class AssessmentTakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assessment_id' => Assessment::factory(),
            'subject_year_id' => SubjectYear::factory(),
        ];
    }
}
