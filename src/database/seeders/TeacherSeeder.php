<?php

namespace Database\Seeders;

use App\Enums\AssessmentStatus;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentQuestionAnswer;
use App\Models\AssessmentTaker;
use App\Models\AssessmentType;
use App\Models\SubjectYear;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    const TEACHER_EXAMPLE_MAIL = 'madamsir@example.com';

    const TEACHER_EXAMPLE_PASSWORD = 'madamsir';

    const TEACHER_FIRST_NAME = 'Madam';

    const TEACHER_LAST_NAME = 'Sir';

    public function run(): void
    {
        $user = User::factory()->create([
            'email' => self::TEACHER_EXAMPLE_MAIL,
            'password' => Hash::make(self::TEACHER_EXAMPLE_PASSWORD),
        ]);

        UserProfile::factory()->create([
            'user_id' => $user->id,
            'first_name' => self::TEACHER_FIRST_NAME,
            'last_name' => self::TEACHER_LAST_NAME,
        ]);

        $this->generateAssessments($user->id, AssessmentType::where('name', 'assignment')->value('id'));
        $this->assignAssessmentTakers();
    }

    private function generateAssessments(int $userId, $assessmentTypeId): void
    {
        // create 2 assessment type per assessment status
        foreach (AssessmentStatus::cases() as $status) {
            Assessment::factory()->count(2)->create([
                'type_id' => $assessmentTypeId,
                'prepared_by' => $userId,
                'status' => $status->value,
            ]);
        }
        // create partial number of questions when assessment is of status 'TO BE COMPLETED'
        $toBeCompletedAssessments = Assessment::where('status', AssessmentStatus::TO_BE_COMPLETED->value)->get();
        $questionsForToBeCompletedAssessments = $toBeCompletedAssessments->flatMap(function ($assessment) {
            $count = max(0, $assessment->total_questions - 1);

            return array_fill(0, $count, ['assessment_id' => $assessment->id]);
        });
        $createdQuestions = AssessmentQuestion::factory()
            ->count($questionsForToBeCompletedAssessments->count())
            ->sequence(fn ($sequence) => $questionsForToBeCompletedAssessments[$sequence->index])
            ->create();
        $this->createAnswersForQuestions($createdQuestions);

        // create complete question set for other status values
        $completedAssessments = Assessment::where('status', '!=', AssessmentStatus::TO_BE_COMPLETED->value)->get();
        $questionsForCompletedAssessments = $completedAssessments->flatMap(function ($assessment) {
            return array_fill(0, $assessment->total_questions, ['assessment_id' => $assessment->id]);
        });

        $createdQuestionsForCompleted = AssessmentQuestion::factory()
            ->count($questionsForCompletedAssessments->count())
            ->sequence(fn ($sequence) => $questionsForCompletedAssessments[$sequence->index])
            ->create();

        $this->createAnswersForQuestions($createdQuestionsForCompleted);
    }

    private function createAnswersForQuestions($questions): void
    {
        foreach ($questions as $question) {
            switch ($question->question_type) {
                case 'multiple_choice':
                    AssessmentQuestionAnswer::factory()->create([
                        'question_id' => $question->id,
                        'is_correct' => true,
                    ]);
                    AssessmentQuestionAnswer::factory()->count(3)->create([
                        'question_id' => $question->id,
                        'is_correct' => false,
                    ]);
                    break;
                case 'true_false':
                    AssessmentQuestionAnswer::factory()->create([
                        'question_id' => $question->id,
                        'is_correct' => true,
                    ]);
                    break;
                case 'short_answer':
                    AssessmentQuestionAnswer::factory()->count(3)->create([
                        'question_id' => $question->id,
                        'is_correct' => true,
                    ]);
                    break;
                case 'essay':
                    break;
            }
        }
    }

    private function assignAssessmentTakers(): void
    {
        $assessments = Assessment::pluck('id');
        foreach ($assessments as $assessmentId) {
            AssessmentTaker::factory()->create([
                'assessment_id' => $assessmentId,
                'subject_year_id' => SubjectYear::all()->random()->id,
            ]);
        }
    }
}
