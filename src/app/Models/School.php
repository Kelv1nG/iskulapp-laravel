<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    public function academicYears(): HasMany
    {
        return $this->hasMany(AcademicYear::class, 'school_id', 'id');
    }

    public function gradeLevels(): HasMany
    {
        return $this->hasMany(GradeLevel::class, 'school_id', 'id');
    }
}
