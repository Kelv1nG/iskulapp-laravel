<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'question',
        'question_type',
        'points',
        'min_words',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsto(Assessment::class, 'assessment_id', 'id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentQuestionAnswer::class, 'question_id', 'id');
    }
}
