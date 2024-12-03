<?php

namespace Database\Factories;

use App\Enums\DayOfWeek;
use App\Models\SubjectClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubjectClassSchedule>
 */
class SubjectClassScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // generate a start time between 8:00 AM and 4:00 PM
        $startTime = Carbon::createFromTime(
            $this->faker->numberBetween(8, 16),
            $this->faker->randomElement([0, 15, 30, 45]),
            0
        );

        // end time is 1.5 hours after start time
        $endTime = $startTime->copy()->addHours(1)->addMinutes(30);

        return [
            'subject_class_id' => SubjectClass::factory(),
            'day' => $this->faker->randomElement(array_column(DayOfWeek::cases(), 'value')),
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
        ];
    }
}
