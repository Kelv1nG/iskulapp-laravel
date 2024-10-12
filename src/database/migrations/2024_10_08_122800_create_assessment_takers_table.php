<?php

use App\Models\Assessment;
use App\Models\SubjectYear;
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
        Schema::create('assessment_takers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Assessment::class, 'assessment_id');
            $table->foreignIdFor(SubjectYear::class, 'subject_year_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_takers');
    }
};
