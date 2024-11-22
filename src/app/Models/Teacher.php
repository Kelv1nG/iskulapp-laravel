<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'employed_date', 'end_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(TeacherSubject::class, 'teacher_id', 'id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(TeacherSection::class, 'teacher_id', 'id');
    }

    public function academicYears(): BelongsToMany
    {
        return $this->belongsToMany(AcademicYear::class, 'teacher_year', 'teacher_id', 'academic_year_id');
    }
}
