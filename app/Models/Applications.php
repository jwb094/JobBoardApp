<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    protected $fillable = [
        'job_listing_id',
        'user_id',
        'resume_path',
        'cover_letter',
        'status',
    ];

    public function jobListing()
    {
        return $this->belongsTo(JobListings::class);
    }

    public function applicant()
    {
        return $this->belongsTo(JobListingsUsers::class, 'job_listings_user_id');
    }
}
