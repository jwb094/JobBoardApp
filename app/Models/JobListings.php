<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Applications;

class JobListings extends Model
{
    protected $fillable = [
        'job_listings_user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'location',
        'job_type',
        'salary_min',
        'salary_max',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function employer()
    {
        return $this->belongsTo(JobListingsUsers::class, 'job_listings_user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applications()
    {
        return $this->hasMany(Applications::class);
    }
}
