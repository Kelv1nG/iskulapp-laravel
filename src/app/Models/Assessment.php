<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_type',
        'prepared_by',
        'approved_by',
        'title',
        'no_of_questions',
        'is_approved',
        'start_time',
        'dead_line',
        'duration_minutes',
        'status',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(AssessmentQuestion::class, 'assessment_id', 'id');
    }

    /*
     * Get the teacher who prepared the assessment
    */
    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prepared_by', 'id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
