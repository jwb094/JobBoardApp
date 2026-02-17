<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\> */
    use HasFactory;
    protected $fillable = [
        'job_id',
        'user_id',
        'resume_path',
        'cover_letter',
        'status',
    ];

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(related: JobListing::class, 'job_id');
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(JobListingsUser::class, 'user_id');
    }
}
