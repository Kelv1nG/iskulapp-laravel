<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $latestAcademicYear = AcademicYear::orderBy('end', 'desc')->first();

        // Array of section names to use
        $sectionNames = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

        foreach ($sectionNames as $name) {
            Section::create([
                'academic_year_id' => $latestAcademicYear->id,
                'advisor_id' => null,
                'name' => "Section $name",
            ]);
        }

        // Get other academic years
        $otherAcademicYears = AcademicYear::where('id', '!=', $latestAcademicYear->id)
            ->inRandomOrder()
            ->get();

        // Create 7 random sections distributed among other academic years
        $otherAcademicYears
            ->take(7)
            ->each(function ($academicYear, $index) use ($sectionNames) {
                Section::create([
                    'academic_year_id' => $academicYear->id,
                    'advisor_id' => null,
                    'name' => 'Section '.$sectionNames[$index + 3],
                ]);
            });
    }
}
