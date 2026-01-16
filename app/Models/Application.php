<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\> */
    use HasFactory;
    protected $fillable = [
        'job_listing_id',
        'user_id',
        'resume_path',
        'cover_letter',
        'status',
    ];

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }

    public function applicant()
    {
        return $this->belongsTo(JobListingsUser::class, 'job_listings_user_id');
    }
}
