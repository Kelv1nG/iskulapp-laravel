<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectClassSchedule extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['subject_class_id', 'day', 'start_time', 'end_time'];

    public function subjectClass(): BelongsTo
    {
        return $this->belongsTo(SubjectClass::class, 'subject_class_id', 'id');
    }
}
