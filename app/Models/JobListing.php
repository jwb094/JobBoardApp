<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applications;


class JobListing extends Model
{
    /** @use HasFactory<\Database\Factories\JobsListingsFactory> */
    use hasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'company_background_info',
        'skillset_About',
        'benefits',
        'location',
        'job_type',
        'salary_min',
        'salary_max',
        'status',
        'expires_at',
        'post_code',
        'address',
        'company_id',
        'city',
    ];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function employer()
    {
        return $this->belongsTo(JobListingsUser::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }


    public function  getLatestJobs()
    {


        return $this::with('category', 'employer')->where('status', 'open')->orderBy('created_by', 'ASC');
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function hasApplied(JobListingsUser $user, $job_id)
    {
        return $this->applications()
            ->where('user_id', $user->id)
            ->where('job_id', $job_id)
            ->exists();
    }
}
