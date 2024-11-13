<?php

use App\Models\Student;
use App\Models\AcademicYear; // Import the AcademicYear model
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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class); // Foreign key for Student
            $table->foreignIdFor(AcademicYear::class); // Foreign key for AcademicYear
            $table->date('attendance_date');
            $table->time('time_in')->nullable();   // Adding time_in column
            $table->time('time_out')->nullable();  // Adding time_out column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
