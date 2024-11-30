<?php

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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('summary')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->foreignId('posted_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('event_schedule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
