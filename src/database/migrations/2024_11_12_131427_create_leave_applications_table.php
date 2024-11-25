<?php

use App\Enums\LeaveType;
use App\Enums\LeaveStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason')->nullable();
            $table->enum('leave_type', array_column(LeaveType::cases(), 'value'));
            $table->enum('leave_status', array_column(LeaveStatus::cases(), 'value'))
                  ->default(LeaveStatus::PENDING->value); 
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};
