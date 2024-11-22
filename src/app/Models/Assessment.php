<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    use HasFactory, HasUuids, TableName;

    protected $fillable = [
        'assessment_type',
        'subject_year_id',
        'prepared_by',
        'approved_by',
        'title',
        'total_questions',
        'is_approved',
        'duration_mins',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_approved' => 'boolean',
        'total_questions' => 'integer',
        'duration_mins' => 'integer',
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
        return $this->belongsTo(Teacher::class, 'prepared_by', 'id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function assessmentTakers(): HasMany
    {
        return $this->hasMany(AssessmentTaker::class, 'assessment_id', 'id');
    }
}
