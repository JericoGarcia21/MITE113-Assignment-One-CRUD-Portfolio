<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'course_id',
        'full_name',
        'professional_title',
        'email',
        'phone',
        'address',
        'bio',
        'skills',
        'project_url',
        'github_url',
        'linkedin_url',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
