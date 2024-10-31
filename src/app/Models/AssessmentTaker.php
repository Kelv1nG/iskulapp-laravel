<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentTaker extends Model
{
    use HasFactory, HasUuids, TableName;

    protected $fillable = [
        'assessment_id',
        'subject_year_id',
        'section_id',
        'created_at',
        'updated_at',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function subjectYear(): BelongsTo
    {
        return $this->belongsTo(SubjectYear::class, 'subject_year_id', 'id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
