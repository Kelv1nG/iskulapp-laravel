<?php

namespace Database\Factories;

use App\Models\Assessment;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssessmentStudentAnswer>
 */
class AssessmentStudentAnswerFactory extends Factory
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
            'assessment_student_report_id' => AssessmentStudentReport::factory(),
            'question_id' => AssessmentQuestion::factory(),
            'student_id' => Student::factory(),
            'answer_id' => AssessmentQuestionAnswer::factory(),
            'answer_text' => $this->faker->sentence(3),
            'is_correct' =>
            'score' =>
            'is_checked' =>
        ];
    }
}
