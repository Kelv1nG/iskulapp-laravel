<?php

namespace Database\Factories;

use App\Enums\QuestionType;
use App\Models\Assessment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssessmentQuestion>
 */
class AssessmentQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'id' => Str::uuid(),
            'assessment_id' => Assessment::factory(),
            'question' => $this->faker->sentence(5),
            'question_type' => $this->faker->randomElement(array_column(QuestionType::cases(), 'value')),
            'points' => 1,
            'min_words' => null,
        ];
    }
}
