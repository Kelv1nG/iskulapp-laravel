<?php

namespace Database\Factories;

use App\Models\AssessmentQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssessmentQuestionAnswer>
 */
class AssessmentQuestionAnswerFactory extends Factory
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
            'question_id' => AssessmentQuestion::factory(),
            'answer' => $this->faker->text(),
            'is_correct' => $this->faker->boolean(),
        ];
    }
}
