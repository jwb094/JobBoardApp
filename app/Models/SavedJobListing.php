<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_listing_id',
    ];

    public function user()
    {
        return $this->belongsTo(JobListingsUser::class);
    }

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }
}
