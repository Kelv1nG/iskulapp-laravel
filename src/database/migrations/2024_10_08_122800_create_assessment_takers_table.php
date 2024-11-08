<?php

use App\Models\Assessment;
use App\Models\Section;
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
            $table->uuid('id')->primary();
            $table->foreignIdFor(Assessment::class, 'assessment_id');
            $table->foreignIdFor(Section::class, 'section_id');
            $table->dateTime('start_time');
            $table->dateTime('dead_line')->nullable();
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
