<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status',
    ];

    protected $dates = ['start_date', 'end_date'];
}