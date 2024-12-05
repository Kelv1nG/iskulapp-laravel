<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            DO $$
            BEGIN
                DROP PUBLICATION IF EXISTS powersync;
                CREATE PUBLICATION powersync FOR TABLE
                    assessments,
                    assessment_takers,
                    assessment_questions,
                    assessment_question_answers,
                    assessment_student_reports,
                    assessment_student_answers,
                    academic_years,
                    grade_levels,
                    sections,
                    subjects,
                    subject_classes,
                    subject_years,
                    teachers,
                    teacher_year,
                    teacher_subjects,
                    students,
                    student_year,
                    student_subjects,
                    student_sections;
            END $$;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PUBLICATION IF EXISTS powersync;');
    }
};
