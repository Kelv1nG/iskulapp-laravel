<?php

namespace Database\Seeders;

use App\Enums\AssessmentStatus;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use Illuminate\Database\Seeder;

class AssessmentQuestionSeeder extends Seeder
{
    public function run(): void
    {
        self::createQuestions();
    }

    private static function createQuestions(): void
    {
        $questionRecords = self::prepareQuestions();
        foreach (array_chunk($questionRecords, 1000) as $chunk) {
            AssessmentQuestion::insert($chunk);
        }
    }

    /*
    * create questions for each assessment
    */
    private static function prepareQuestions(): array
    {
        $questionRecords = [];

        $toBeCompletedAssessments = Assessment::where('status', AssessmentStatus::TO_BE_COMPLETED->value)->get();
        foreach ($toBeCompletedAssessments as $assessment) {
            $count = max(0, $assessment->total_questions - 1);

            $questionRecords = array_merge($questionRecords,
                AssessmentQuestion::factory()
                    ->count($count)
                    ->make(['assessment_id' => $assessment->id])
                    ->toArray()
            );
        }

        $completedAssessments = Assessment::where('status', '!=', AssessmentStatus::TO_BE_COMPLETED->value)->get();
        foreach ($completedAssessments as $assessment) {
            $questionRecords = array_merge($questionRecords,
                AssessmentQuestion::factory()
                    ->count($assessment->total_questions)
                    ->make(['assessment_id' => $assessment->id])
                    ->toArray()
            );
        }

        return $questionRecords;
    }
}
