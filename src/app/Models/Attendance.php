<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'attendance_date', 'time_in', 'time_out','academic_year_id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
}
