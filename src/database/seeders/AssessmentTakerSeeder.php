<?php

namespace Database\Seeders;

use App\Models\AssessmentTaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentTakerSeeder extends Seeder
{
    public function run(): void
    {
        $results = DB::select('
            SELECT
                assessments.id AS assessment_id,
                assessments.subject_year_id AS subject_year_id,
                assessments.prepared_by AS teacher_id,
                subject_classes.section_id AS section_id
            FROM assessments
            LEFT JOIN subject_classes ON
                subject_classes.subject_year_id = assessments.subject_year_id
                AND
                subject_classes.teacher_id = assessments.prepared_by
            ');

        $assessmentTakerRecords = [];

        foreach ($results as $result) {
            $assessmentTakerRecords[] = AssessmentTaker::factory()->make([
                'assessment_id' => $result->assessment_id,
                'section_id' => $result->section_id,
            ])->attributesToArray();
        }

        foreach (array_chunk($assessmentTakerRecords, 1000) as $chunk) {
            AssessmentTaker::insert($chunk);
        }
    }
}
