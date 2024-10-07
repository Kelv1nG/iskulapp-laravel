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
                IF NOT EXISTS (
                    SELECT 1 FROM pg_publication WHERE pubname = 'powersync'
            ) THEN
                    CREATE PUBLICATION powersync FOR ALL TABLES;
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
