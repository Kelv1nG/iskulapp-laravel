<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveApplication;
use Carbon\Carbon;
use App\Enums\LeaveType; 
use App\Enums\LeaveStatus; 

class LeaveApplicationSeeder extends Seeder
{
    public function run()
    {
        LeaveApplication::create([
            'employee_name' => 'John Doe',
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(15),
            'leave_type' => LeaveType::SICK_LEAVE, 
            'reason' => 'Family vacation',
            'status' => LeaveStatus::Pending,
        ]);
    }
}
