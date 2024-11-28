<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AssessmentQuestionAnswer extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['question_id', 'answer', 'is_correct'];

    public function question(): HasOne
    {
        return $this->hasOne(AssessmentQuestion::class, 'question_id', 'id');
    }
}
