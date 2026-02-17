<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    //
    protected $fillable = [
        'company_name',
        "company_tel",
        "company_size",
    ];



    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }
}
