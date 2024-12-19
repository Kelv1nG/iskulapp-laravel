<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory, TableName;

    protected $fillable = ['student_id', 'checked_by', 'academic_year_id', 'time_in', 'attendance_date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
