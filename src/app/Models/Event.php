<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'description',
        'school_id',
        'posted_by',
        'event_schedule',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    /**
     * Boot method to handle model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Strip HTML tags from the description before saving
        static::saving(function ($event) {
            $event->description = strip_tags($event->description);
        });
    }
}
