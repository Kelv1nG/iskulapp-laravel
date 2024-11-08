<?php

namespace Database\Factories;

use App\Models\Assessment;
use App\Models\Section;
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
        $startTime = $this->faker->dateTimeBetween('now', '+1 month');
        $deadLine = $this->faker->dateTimeBetween($startTime, '+2 months');

        return [
            'assessment_id' => Assessment::factory(),
            'section_id' => Section::factory(),
            'start_time' => $startTime,
            'dead_line' => $deadLine,
        ];
    }
}
