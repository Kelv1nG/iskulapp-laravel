<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::create($this->faker->year, $this->faker->month, 1);

        return [
            'name' => $startDate->year,
            'start' => $startDate->toDateString(),
            'end' => $startDate->copy()->addMonths(9)->toDateString(),
        ];
    }
}
