<?php

use App\Models\AssessmentQuestion;
use App\Models\AssessmentQuestionAnswer;
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
        Schema::create('assessment_student_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AssessmentQuestion::class, 'question_id');
            $table->foreignIdFor(User::class, 'student_id');
            $table->foreignIdFor(AssessmentQuestionAnswer::class, 'answer_id')->nullable(true);

            $table->text('answer_text')->nullable(true);
            $table->tinyInteger('score')->default(0);
            $table->boolean('is_checked')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_student_answers');
    }
};
