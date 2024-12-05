<?php

use App\Models\Assessment;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessment_student_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Assessment::class, 'assessment_id');
            $table->foreignIdFor(User::class, 'student_id');

            $table->dateTime('started_at');
            $table->dateTime('finished_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_student_reports');
    }
};
