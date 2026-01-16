<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListingsUsers extends Model
{
    protected $fillable = [
        'user_id',
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


    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEmployer(): bool
    {
        return $this->role === 'employer';
    }

    public function isApplicant(): bool
    {
        return $this->role === 'applicant';
    }
}
