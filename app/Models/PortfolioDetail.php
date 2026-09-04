<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioDetail extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
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
}
