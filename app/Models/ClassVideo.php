<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassVideo extends Model
{
    use HasFactory;

    // Add course_classe_id to the fillable array
    protected $fillable = [
        'course_classe_id',
        'video_url',
    ];

    public function classes(): BelongsTo
    {
        return $this->belongsTo(CourseClass::class, 'course_classe_id');
    }
}
