<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentSubject extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subject_year_id'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function subjectYear(): BelongsTo
    {
        return $this->belongsTo(subjectYear::class, 'subject_year_id', 'id');
    }
}
