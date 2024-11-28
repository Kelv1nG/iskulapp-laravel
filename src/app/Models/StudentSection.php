<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentSection extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'student_id'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
