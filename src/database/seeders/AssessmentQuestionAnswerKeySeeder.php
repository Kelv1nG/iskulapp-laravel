<?php

namespace Database\Seeders;

use App\Models\AssessmentQuestion;
use App\Models\AssessmentQuestionAnswer;
use Illuminate\Database\Seeder;

class AssessmentQuestionAnswerKeySeeder extends Seeder
{
    public function run(): void
    {
        self::createAnswerForQuestions();
    }

    /*
    * create possible answers given a question
    */
    private static function createAnswerForQuestions(): void
    {
        $answerRecords = self::prepareAnswerForQuestionRecords();
        foreach (array_chunk($answerRecords, 1000) as $chunk) {
            AssessmentQuestionAnswer::insert($chunk);
        }
    }

    private static function prepareAnswerForQuestionRecords(): array
    {
        $answerRecords = [];

        // prepare multiple choice
        $multipleChoiceQuestions = AssessmentQuestion::where('question_type', 'multiple_choice')->get();
        foreach ($multipleChoiceQuestions as $multipleChoiceQuestion) {
            $answerRecords[] = AssessmentQuestionAnswer::factory()->make([
                'question_id' => $multipleChoiceQuestion->id,
                'is_correct' => true,
            ])->attributesToArray();

            for ($i = 0; $i < 3; $i++) {
                $answerRecords[] = AssessmentQuestionAnswer::factory()->make([
                    'question_id' => $multipleChoiceQuestion->id,
                    'is_correct' => false,
                ])->attributesToArray();
            }
        }

        // prepare true or false
        $trueOrFalseQuestions = AssessmentQuestion::where('question_type', 'true_or_false')->get();
        foreach ($trueOrFalseQuestions as $trueOrFalseQuestion) {
            $answerRecords[] = AssessmentQuestionAnswer::factory()->make([
                'answer' => rand(0, 1) ? 'true' : 'false',
                'question_id' => $trueOrFalseQuestion->id,
                'is_correct' => true,
            ])->attributesToArray();
        }

        // prepare short answer
        $shortAnswerQuestions = AssessmentQuestion::where('question_type', 'short_answer')->get();
        foreach ($shortAnswerQuestions as $shortAnswerQuestion) {
            for ($i = 0; $i < 3; $i++) {
                $answerRecords[] = AssessmentQuestionAnswer::factory()->make([
                    'question_id' => $shortAnswerQuestion->id,
                    'is_correct' => true,
                ])->attributesToArray();
            }
        }

        return $answerRecords;
    }
}
