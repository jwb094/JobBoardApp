<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedJobListings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_listing_id',
    ];

    public function user()
    {
        return $this->belongsTo(JobListingsUsers::class);
    }

    public function jobListing()
    {
        return $this->belongsTo(JobListings::class);
    }
}
