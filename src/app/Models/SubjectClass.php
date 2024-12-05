<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubjectClass extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['subject_year_id', 'section_id', 'teacher_id'];

    public function subjectYear(): BelongsTo
    {
        return $this->belongsTo(SubjectYear::class, 'subject_year_id', 'id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function subjectSchedules(): HasMany
    {
        return $this->hasMany(SubjectClassSchedule::class, 'subject_class_id', 'id');
    }
}
