<?php

namespace Database\Factories;

use App\Enums\AssessmentStatus;
use App\Enums\AssessmentType;
use App\Models\SubjectYear;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assessment_type' => $this->faker->randomElement(array_column(AssessmentType::cases(), 'value')),
            'subject_year_id' => SubjectYear::factory(),
            'prepared_by' => User::factory(),
            'title' => $this->faker->unique()->sentence(3),
            'instructions' => $this->faker->unique()->sentence(5),
            'total_questions' => $this->faker->numberBetween(5, 20),
            'is_approved' => $this->faker->boolean(50),
            'duration_mins' => $this->faker->numberBetween(30, 180),
            'status' => $this->faker->randomElement(array_column(AssessmentStatus::cases(), 'value')),
        ];
    }
}
