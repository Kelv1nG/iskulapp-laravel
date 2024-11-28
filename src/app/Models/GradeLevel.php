<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradeLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'name',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'section_id', 'id');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}
