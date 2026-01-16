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

        // 🔹 Truncate table first for SQLite safety
        // \App\Models\JobListing::truncate();
        JobListing::truncate();

        // 3️⃣ Job Listings (Employers + Categories must exist)
        $JobListing = JobListing::factory()
            ->count(1)
            ->create();
    }
}
