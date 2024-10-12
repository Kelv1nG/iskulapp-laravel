<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentTaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'subject_year_id',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function subjectYear(): BelongsTo
    {
        return $this->belongsTo(SubjectYear::class, 'subject_year_id', 'id');
    }
}
