<?php

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
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
        Schema::create('assessment_question_answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Assessment::class, 'assessment_id');
            $table->foreignIdFor(AssessmentQuestion::class, 'question_id');

            $table->string('answer');
            $table->boolean('is_correct');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_question_answers');
    }
};
