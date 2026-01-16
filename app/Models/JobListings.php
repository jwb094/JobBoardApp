<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applications;


class JobListings extends Model
{
    /** @use HasFactory<\Database\Factories\JobsListingsFactory> */
    use hasFactory;
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


    public function  getLatestJobs()
    {


        return $this->where('status', 'open');;
    }



    public function filterSearch($query, $request)
    {
        // DB::enableQueryLog();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        // dd(DB::getQueryLog());
        return $query->paginate(10);
    }
}
