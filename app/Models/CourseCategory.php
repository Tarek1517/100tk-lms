<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'subtitle',
        'order_number',
        'status',
        'parent_id'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(CourseCategory::class, 'parent_id')->select(['id','parent_id','name','slug', 'image', 'subtitle']);
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'parent_id');
    }

    public function course()
    {
        return $this->hasMany(Course::class, 'category_id'); // Correct the model name if needed
    }
}
