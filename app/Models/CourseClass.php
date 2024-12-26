<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'slug',
        'is_active',

    ];


    public function videoUrl()
    {
        return $this->hasOne(ClassVideo::class, 'course_classe_id' ); // Correct the model name if needed
    }

    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
