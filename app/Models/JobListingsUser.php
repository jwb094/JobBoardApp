<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobListingsUser  extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\JobListingsUserFactory> */
    use HasFactory;
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
        return $this->hasMany(SavedJobListing::class);
    }

    // Optional shortcut
    public function savedJobs()
    {
        return $this->belongsToMany(
            JobListing::class,
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
