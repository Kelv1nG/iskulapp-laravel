<?php

use App\Models\AcademicYear;
use App\Models\Student;
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
        Schema::create('student_year', function (Blueprint $table) {
            $table->foreignIdFor(Student::class, 'student_id');
            $table->foreignIdFor(AcademicYear::class, 'academic_year_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_year');
    }
};
