<?php

use App\Enums\QuestionType;
use App\Models\Assessment;
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
        Schema::create('assessment_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Assessment::class, 'assessment_id');

            $table->text('question');
            $table->enum('question_type', array_column(QuestionType::cases(), 'value'));
            $table->tinyInteger('points')->default(1);
            $table->tinyInteger('min_words')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_questions');
    }
};
