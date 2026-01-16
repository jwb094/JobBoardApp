<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobListings;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JobsListingsFactory extends Factory
{
    protected $model = JobListings::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        //

        $jobTitles = [
            'Junior Laravel Developer',
            'Senior PHP Engineer',
            'Full Stack Developer',
            'Backend Engineer',
            'Frontend Developer',
            'DevOps Engineer',
            'Mobile App Developer',
            'QA Automation Engineer',
            'Data Analyst',
            'UI/UX Designer',
            'Product Manager',
            'Technical Support Engineer',
            'System Administrator',
            'Cloud Engineer',
        ];

        $title = $this->faker->randomElement($jobTitles);

        return [
            // Employer (must exist)
            'user_id' => User::factory()->state([
                'role' => 'employer',
            ]),

            // Category (linked automatically)
            'category_id' => Category::factory(),

            'title' => $title,
            'slug' => Str::slug($title . '-' . $this->faker->unique()->numberBetween(100, 999)),

            'description' => $this->faker->paragraphs(4, true),
            'location' => $this->faker->city(),

            'job_type' => $this->faker->randomElement([
                'full-time',
                'part-time',
                'contract',
                'remote',
            ]),

            'salary_min' => $this->faker->numberBetween(30000, 70000),
            'salary_max' => $this->faker->numberBetween(80000, 150000),

            'status' => ['open', 'close'],
            'expires_at' => now()->addDays(rand(15, 60)),
        ];
    }
}
