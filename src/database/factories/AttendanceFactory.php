<?php

namespace Database\Factories;

use App\Enums\AttendanceStatus;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'checked_by' => Teacher::factory(),
            'section_id' => Section::factory(),
            'attendance_date' => $this->faker->date(),
            'time_in' => $this->faker->optional()->time(),
            'status' => $this->faker->randomElement(AttendanceStatus::cases())->value,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
