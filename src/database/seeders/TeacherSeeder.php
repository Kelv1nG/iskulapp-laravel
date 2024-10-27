<?php

namespace Database\Seeders;

use App\Enums\AssessmentStatus;
use App\Enums\AssessmentType;
use App\Models\AcademicYear;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentQuestionAnswer;
use App\Models\AssessmentTaker;
use App\Models\Section;
use App\Models\SubjectYear;
use App\Models\Teacher;
use App\Models\TeacherSection;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    const TEACHER_EXAMPLE_MAIL = 'mslaravel@example.com';

    const TEACHER_EXAMPLE_PASSWORD = 'mslaravel';

    const TEACHER_FIRST_NAME = 'Lara';

    const TEACHER_LAST_NAME = 'Vel';

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

        $teacher = Teacher::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->generateTeacherYears($teacher->id);
        $this->generateTeacherSubjects($teacher->id);
        $this->generateTeacherSections($teacher);
        $this->generateAssessments($user->id, AssessmentType::ASSIGNMENT->value);
        $this->assignAssessmentTakers();
    }

    private function generateTeacherSubjects($teacherId): void
    {
        $latestAcademicYear = AcademicYear::orderBy('end', 'desc')->first();

        $latestSubjectYearIds = SubjectYear::where('academic_year_id', $latestAcademicYear->id)
            ->pluck('id')
            ->toArray();

        $records = collect($latestSubjectYearIds)->map(function ($subjectYearId) use ($teacherId) {
            return [
                'teacher_id' => $teacherId,
                'subject_year_id' => $subjectYearId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        // Bulk insert using insertOrIgnore to prevent duplicates
        DB::table('teacher_subjects')->insertOrIgnore($records);
    }

    private function generateTeacherSections($teacher): void
    {
        $latestAcademicYear = AcademicYear::orderBy('end', 'desc')->first();

        $currentSectionIds = Section::where('academic_year_id', $latestAcademicYear->id)
            ->inRandomOrder()
            ->take(3)
            ->pluck('id');

        $notCurrentSectionIds = Section::where('academic_year_id', '!=', $latestAcademicYear->id)
            ->inRandomOrder()
            ->take(2)
            ->pluck('id');

        collect($currentSectionIds)
            ->concat($notCurrentSectionIds)
            ->each(fn ($sectionId) => TeacherSection::factory()->create([
                'teacher_id' => $teacher->id,
                'section_id' => $sectionId,
            ])
            );
    }

    private function generateTeacherYears($teacherId): void
    {
        $teacher = Teacher::find($teacherId);
        $academicYearIds = AcademicYear::pluck('id');

        $teacher->academicYears()->syncWithoutDetaching($academicYearIds);
    }

    private function generateAssessments(int $userId, string $assessmentType): void
    {
        // create 2 assessment type per assessment status
        foreach (AssessmentStatus::cases() as $status) {
            Assessment::factory()->count(2)->create([
                'assessment_type' => $assessmentType,
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
