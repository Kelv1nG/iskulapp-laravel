<?php

namespace Database\Seeders;

use App\Enums\AssessmentStatus;
use App\Enums\AssessmentType;
use App\Models\Assessment;
use App\Models\TeacherSubject;
use Illuminate\Database\Seeder;

class AssessmentSeeder extends Seeder
{
    public function run(): void
    {
        self::createAssessments();
    }

    /*
    * create varying assessments for different subjects for each teacher
    */
    private static function createAssessments(): void
    {
        $assessmentRecords = self::prepareAssessmentRecords();
        foreach (array_chunk($assessmentRecords, 1000) as $chunk) {
            Assessment::insert($chunk);
        }
    }

    private static function prepareAssessmentRecords()
    {
        // Create combinations for each assessment type and status
        $assessmentConfigurations = [];
        foreach (AssessmentType::cases() as $assessmentType) {
            foreach (AssessmentStatus::cases() as $status) {
                $assessmentConfigurations[] = [
                    'assessment_type' => $assessmentType,
                    'assessment_status' => $status,
                ];
            }
        }

        $teacherSubjects = TeacherSubject::all();
        $assessmentRecords = [];
        foreach ($teacherSubjects as $ts) {
            foreach ($assessmentConfigurations as $config) {
                $assessmentRecords[] = Assessment::factory()->make([
                    'assessment_type' => $config['assessment_type']->value,
                    'subject_year_id' => $ts->subject_year_id,
                    'prepared_by' => $ts->teacher_id,
                    'status' => $config['assessment_status']->value,
                ])->attributesToArray();
            }
        }

        return $assessmentRecords;
    }
}
