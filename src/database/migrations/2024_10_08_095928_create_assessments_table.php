<?php

use App\Enums\AssessmentStatus;
use App\Enums\AssessmentType;
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
        Schema::create('assessments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class, 'prepared_by');
            $table->foreignIdFor(User::class, 'approved_by')->nullable();

            $table->enum('assessment_type', array_column(AssessmentType::cases(), 'value'));
            $table->string('title');
            $table->tinyInteger('total_questions');
            $table->boolean('is_approved')->default(false);
            $table->dateTime('start_time');
            $table->dateTime('dead_line')->nullable();
            $table->tinyInteger('duration_mins')->nullable();
            $table->enum('status', array_column(AssessmentStatus::cases(), 'value'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
