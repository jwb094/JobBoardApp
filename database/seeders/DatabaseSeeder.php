<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\JobListing;
use App\Models\JobListingsUser;
use App\Models\SavedJobListing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $admin = JobListingsUser::factory()->admin()->create([
        //     'email' => 'admin@example.com',
        // ]);

        $employers = JobListingsUser::factory()
            ->employer()
            ->count(5)
            ->create();

        $applicants = JobListingsUser::factory()
            ->applicant()
            ->count(20)
            ->create();
    }
}
