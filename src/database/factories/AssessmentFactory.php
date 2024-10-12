<?php

namespace Database\Factories;

use App\Enums\AssessmentStatus;
use App\Models\AssessmentType;
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
        $startTime = $this->faker->dateTimeBetween('now', '+1 month');
        $deadLine = $this->faker->dateTimeBetween($startTime, '+2 months');

        return [
            'type_id' => AssessmentType::factory(),
            'prepared_by' => User::factory(),
            'title' => $this->faker->unique()->sentence(3),
            'total_questions' => $this->faker->numberBetween(5, 20),
            'is_approved' => $this->faker->boolean(50),
            'start_time' => $startTime,
            'dead_line' => $deadLine,
            'duration_mins' => $this->faker->numberBetween(30, 180),
            'status' => $this->faker->randomElement(array_column(AssessmentStatus::cases(), 'value')),
        ];
    }
}
