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
        DB::unprepared("
            DO $$
            BEGIN
                IF EXISTS (
                    SELECT 1 FROM pg_publication WHERE pubname = 'powersync'
                ) THEN
                    ALTER PUBLICATION powersync SET TABLE
                        assessments,
                        assessment_takers,
                        academic_years,
                        subjects,
                        subject_years;
                ELSE
                    CREATE PUBLICATION powersync FOR TABLE
                        assessments,
                        assessment_takers,
                        academic_years,
                        subjects,
                        subject_years;
                END IF;
            END $$;
        ");
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
