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
                    academic_years,
                    subjects,
                    subject_years,
                    teachers,
                    teacher_year,
                    teacher_subjects;
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
