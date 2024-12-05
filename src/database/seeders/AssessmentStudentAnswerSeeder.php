<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentStudentAnswerSeeder extends Seeder
{
    public function run(): void
    {
        self::createMultipleChoiceAnswers();
        self::createAnswersForTrueOrFalse();
        self::createEssayOrShortAnswers();
    }

    private static function createMultipleChoiceAnswers(): void
    {
        DB::statement("
            WITH multiple_choice_answers AS (
                SELECT
                    questions.id AS question_id,
                    assessments.id AS assessment_id,
                    questions.question_type AS question_type,
                    student_reports.student_id,
                    student_reports.id AS student_report_id,
                    answers.id AS answer_id,
                    answers.is_correct
                FROM assessment_student_reports AS student_reports
                LEFT JOIN assessments
                    ON assessments.id = student_reports.assessment_id
                LEFT JOIN assessment_questions AS questions
                    ON questions.assessment_id = assessments.id
                LEFT JOIN assessment_question_answers AS answers
                    ON answers.question_id = questions.id
                WHERE questions.question_type = 'multiple_choice'
            ),

            randomized_answers AS (
                SELECT DISTINCT ON (question_id, student_id)
                    student_report_id,
                    assessment_id,
                    question_id,
                    student_id,
                    answer_id,
                    is_correct
                FROM multiple_choice_answers
                ORDER BY question_id, student_id, RANDOM()
            )

            INSERT INTO assessment_student_answers(
                id,
                assessment_student_report_id,
                assessment_id,
                question_id,
                student_id,
                answer_id,
                is_correct
            )
            SELECT gen_random_uuid(), *
            FROM randomized_answers
        ");
    }

    private static function createAnswersForTrueOrFalse(): void
    {
        DB::statement("
            WITH true_or_false_answers AS (
                SELECT
                    questions.id AS question_id,
                    assessments.id AS assessment_id,
                    questions.question_type AS question_type,
                    student_reports.student_id,
                    student_reports.id AS student_report_id,
                    answers.id AS answer_id,
                    answers.is_correct
                FROM assessment_student_reports AS student_reports
                LEFT JOIN assessments
                    ON assessments.id = student_reports.assessment_id
                LEFT JOIN assessment_questions AS questions
                    ON questions.assessment_id = assessments.id
                LEFT JOIN assessment_question_answers AS answers
                    ON answers.question_id = questions.id
				WHERE questions.question_type = 'true_or_false'
            ),

            insert_data AS (
                SELECT
                    student_report_id,
                    assessment_id,
                    question_id,
                    student_id,
                    answer_id,
                    is_correct
                FROM true_or_false_answers
            )

            INSERT INTO assessment_student_answers(
                id,
                assessment_student_report_id,
                assessment_id,
                question_id,
                student_id,
                answer_id,
                is_correct
            )
            SELECT gen_random_uuid(), *
            FROM insert_data
        ");
    }

    /*
    * 1 student per section would have incomplete assessment, i.e quiz = 4/5 items are answered
    */
    private static function createEssayOrShortAnswers(): void
    {
        DB::statement("
        WITH essay_or_short_answers AS (
            SELECT
                assessments.id AS assessment_id,
                questions.id AS question_id,
                questions.question_type AS question_type,
                student_reports.student_id,
                student_reports.id AS student_report_id
            FROM assessment_student_reports AS student_reports
            LEFT JOIN assessments
                ON assessments.id = student_reports.assessment_id
            LEFT JOIN assessment_questions AS questions
                ON questions.assessment_id = assessments.id
            WHERE questions.question_type IN ('short_answer', 'essay')
                AND student_id % 20 != 0
            ),
        insert_data AS (
            SELECT
                student_report_id,
                assessment_id,
                question_id,
                student_id
            FROM essay_or_short_answers
        )
        INSERT INTO assessment_student_answers(
            id,
            assessment_student_report_id,
            assessment_id,
            question_id,
            student_id,
            answer_text
        )
        SELECT gen_random_uuid(), insert_data.*, md5(random()::text)
        FROM insert_data
        ");
    }
}
