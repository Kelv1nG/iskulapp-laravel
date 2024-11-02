<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'student_no'];

    public function academicYears(): BelongsToMany
    {
        return $this->belongsToMany(AcademicYear::class, 'student_year', 'student_id', 'academic_year_id');
    }
}
