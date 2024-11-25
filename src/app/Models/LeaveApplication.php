<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\LeaveType;
use App\Enums\LeaveStatus;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $table = 'leave_applications';

    protected $fillable = [
        'employee_name',
        'start_date',
        'end_date',
        'leave_type',
        'reason',
        'leave_status',
    ];

    protected $dates = ['start_date', 'end_date'];

    protected $casts = [
        'leave_type' => LeaveType::class,
        'leave_status' => LeaveStatus::class,
    ];
    
}
