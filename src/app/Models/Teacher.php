<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'employed_date', 'end_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subjectYears(): BelongsToMany
    {
        return $this->belongsToMany(SubjectYear::class, 'teacher_subjects', 'teacher_id', 'subject_year_id');
    }

    public function academicYears(): BelongsToMany
    {
        return $this->belongsToMany(AcademicYear::class, 'teacher_year', 'teacher_id', 'academic_year_id');
    }

    public function subjectClasses(): HasMany
    {
        return $this->hasMany(SubjectClass::class, 'teacher_id', 'id');
    }

    public function currentSubjectClasses(): Collection
    {
        $currentAcademicYear = $this->user->getCurrentAcademicYear();

        return $this->classes()
            ->where('academic_year_id', $currentAcademicYear->id)
            ->get();
    }

    public function currentSubjectYears(): Collection
    {
        $currentAcademicYear = $this->user->getCurrentAcademicYear();

        return $this->subjectYears()
            ->where('academic_year_id', $currentAcademicYear->id)
            ->get();
    }
}
