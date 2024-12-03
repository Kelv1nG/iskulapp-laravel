<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\SubjectYear;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubjectClass>
 */
class SubjectClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_year_id' => SubjectYear::factory(),
            'section_id' => Section::factory(),
            'teacher_id' => Teacher::factory(),
        ];
    }
}
