<?php

use App\Models\AcademicYear;
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
        Schema::create('subject_years', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(AcademicYear::class, 'academic_year_id');
            $table->foreignIdFor(SubjectYear::class, 'subject_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_years');
    }
};
