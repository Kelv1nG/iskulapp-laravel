<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school = School::factory()->create([
            'name' => 'Pambasang Mataas na Paraalan ng Albay',
            'short_name' => 'PMNPNA',
        ]);

        $academicYears = [
            ['school_id' => $school->id, 'name' => '2022-2023', 'start' => Carbon::create(2022, 1, 1), 'end' => Carbon::create(2022, 6, 30)],
            ['school_id' => $school->id, 'name' => '2022-2023', 'start' => Carbon::create(2022, 7, 1), 'end' => Carbon::create(2022, 12, 31)],
            ['school_id' => $school->id, 'name' => '2023-2024', 'start' => Carbon::create(2023, 1, 1), 'end' => Carbon::create(2023, 6, 30)],
            ['school_id' => $school->id, 'name' => '2023-2024', 'start' => Carbon::create(2023, 7, 1), 'end' => Carbon::create(2023, 12, 31)],
        ];

        AcademicYear::insert($academicYears);
    }
}
