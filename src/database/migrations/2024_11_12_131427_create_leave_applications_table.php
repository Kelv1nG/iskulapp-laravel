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
            $table->enum('leave_type', ['Sick_Leave', 'Vacation_Leave', 'Annual_Leave', 'Maternity_Leave']);
            $table->text('reason')->nullable();
            $table->enum('leave_status', ['Pending', 'Approved', 'Rejected']);
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};
