<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\School;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        $academicYearRecords = $this->prepareAcademicYearRecords();
        AcademicYear::insert($academicYearRecords);
    }

    private function prepareAcademicYearRecords(): array
    {
        $schoolIds = School::pluck('id')->toArray();

        $academicYearData = [
            ['name' => '2021 1st sem', 'start' => strtotime('2021-01-01'), 'end' => strtotime('2021-06-30')],
            ['name' => '2021 2nd sem', 'start' => strtotime('2021-07-01'), 'end' => strtotime('2021-12-31')],
            ['name' => '2022 1st sem', 'start' => strtotime('2022-01-01'), 'end' => strtotime('2022-06-30')],
            ['name' => '2022 2nd sem', 'start' => strtotime('2022-07-01'), 'end' => strtotime('2022-12-31')],
            ['name' => '2023 1st sem', 'start' => strtotime('2023-01-01'), 'end' => strtotime('2023-06-30')],
            ['name' => '2023 2nd sem', 'start' => strtotime('2023-07-01'), 'end' => strtotime('2023-12-31')],
        ];

        $academicYearRecords = [];
        foreach ($schoolIds as $schoolId) {
            foreach ($academicYearData as $data) {
                $academicYearRecords[] = [
                    'school_id' => $schoolId,
                    'name' => $data['name'],
                    'start' => date('Y-m-d', $data['start']),
                    'end' => date('Y-m-d', $data['end']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        return $academicYearRecords;
    }
}
