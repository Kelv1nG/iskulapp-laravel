<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicYears = [
            ['name' => '2023', 'start' => 'Jan', 'end' => 'June'],
            ['name' => '2023', 'start' => 'July', 'end' => 'Dec'],
            ['name' => '2024', 'start' => 'Jan', 'end' => 'June'],
            ['name' => '2024', 'start' => 'July', 'end' => 'Dec'],
        ];

        AcademicYear::insert($academicYears);
    }
}
