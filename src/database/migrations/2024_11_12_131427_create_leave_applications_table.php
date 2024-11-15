<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedSmallInteger('leave_type'); 
            $table->text('reason')->nullable();
            $table->unsignedSmallInteger('leave_status'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};
