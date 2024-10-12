<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicYears = [
            ['name' => '2022-2023', 'start' => Carbon::create(2022, 1, 1), 'end' => Carbon::create(2022, 6, 30)],
            ['name' => '2022-2023', 'start' => Carbon::create(2022, 7, 1), 'end' => Carbon::create(2022, 12, 31)],
            ['name' => '2023-2024', 'start' => Carbon::create(2023, 1, 1), 'end' => Carbon::create(2023, 6, 30)],
            ['name' => '2023-2024', 'start' => Carbon::create(2023, 7, 1), 'end' => Carbon::create(2023, 12, 31)],
        ];

        AcademicYear::insert($academicYears);
    }
}
