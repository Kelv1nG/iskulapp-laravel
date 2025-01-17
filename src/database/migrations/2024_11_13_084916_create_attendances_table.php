<?php

use App\Enums\AttendanceStatus;
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
            $table->foreignIdFor(Teacher::class, 'checked_by');
            $table->foreignIdFor(Section::class, 'section_id');
            $table->date('attendance_date');
            $table->time('time_in')->nullable();
            $table->enum('status', array_column(AttendanceStatus::cases(), 'value'));
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
