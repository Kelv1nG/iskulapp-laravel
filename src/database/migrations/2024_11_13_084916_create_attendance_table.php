<?php

use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
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
            $table->uuid('id')->primary();
            $table->foreignIdFor(Student::class, 'student_id');
            $table->foreignIdFor(Teacher::class, 'checked_by')->nullable();
            $table->foreignIdFor(Section::class, 'section_id');
            $table->date('attendance_date');
            $table->time('time_in')->nullable();
            $table->boolean('is_absent');
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
