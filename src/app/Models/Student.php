<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'student_no'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function academicYears(): BelongsToMany
    {
        return $this->belongsToMany(AcademicYear::class, 'student_year', 'student_id', 'academic_year_id');
    }

    public function subjectYears(): BelongsToMany
    {
        return $this->belongsToMany(SubjectYear::class, 'student_subjects', 'student_id', 'subject_year_id');
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'student_sections', 'student_id', 'section_id');
    }

    public function currentSections(): Collection
    {
        $currentAcademicYear = $this->user->getCurrentAcademicYear();

        return $this->sections()->where('academic_year_id', $currentAcademicYear->id)->get();
    }

    public function currentSubjectYears(): Collection
    {
        $currentAcademicYear = $this->user->getCurrentAcademicYear();

        return $this->subjectYears()->where('academic_year_id', $currentAcademicYear->id)->get();
    }
}
