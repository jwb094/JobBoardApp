<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListingsUsers extends Model
{
    protected $fillable = [
        'user_id',
        'job_listing_id',
        "first_name",
        "last_name",
        "email",
        "password",
        "role"
    ];


    public function savedJobListings()
    {
        return $this->hasMany(SavedJobListings::class);
    }

    // Optional shortcut
    public function savedJobs()
    {
        return $this->belongsToMany(
            JobListings::class,
            'saved_job_listings'
        );
    }
}
