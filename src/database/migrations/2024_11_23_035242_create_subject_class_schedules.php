<?php

use App\Models\SubjectClass;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subject_class_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SubjectClass::class, 'subject_class_id');
            $table->enum('day', collect(Carbon::getDays())->values()->all());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_schedules');
    }
};
