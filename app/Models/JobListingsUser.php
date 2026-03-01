<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobListingsUser  extends Authenticatable
{
    //protected $table = 'job_listing_users';

    /** @use HasFactory<\Database\Factories\JobListingsUserFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        "first_name",
        "last_name",
        "email",
        "password",
        "password_hash",
        "role",
        "company_id"
    ];

    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }
    public function savedJobListings()
    {
        return $this->hasMany(SavedJob::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
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
