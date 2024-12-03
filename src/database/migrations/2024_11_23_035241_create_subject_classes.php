<?php

use App\Models\Section;
use App\Models\SubjectYear;
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
        Schema::create('subject_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SubjectYear::class, 'subject_year_id');
            $table->foreignIdFor(Section::class, 'section_id');
            $table->foreignIdFor(Teacher::class, 'teacher_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_classes');
    }
};
