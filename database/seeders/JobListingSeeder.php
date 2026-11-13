<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\JobListing;
use App\Models\JobListingsUser;
use App\Models\SavedJobListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Rebuild the sample listings; employers and categories must already exist.
        JobListing::truncate();

        $JobListing = JobListing::factory()
            ->count(60)
            ->create();
    }
}
