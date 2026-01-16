<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobListing;
use App\Models\Category;
use App\Models\JobListingsUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JobListingFactory extends Factory
{
    use HasFactory;
    protected $model = JobListing::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $jobTitles = [
            "Junior Laravel Developer",
            "Junior Front-End Developer",
            "Junior Back-End Developer",
            "Middle Laravel Developer",
            "Middle Front-End Developer",
            "Middle Back-End Developer",
            "Web Manager",
            "Web Specialist",
            "Senior PHP Engineer",
            "Full Stack Developer",
            "Backend Engineer",
            "Frontend Developer",
            "DevOps Engineer",
            "Mobile App Developer",
            "Data Analyst",
            "QA Automation Engineer",
            "UI/UX Designer",
            "Product Manager",
            "Technical Support Engineer",
            "System Administrator",
            "Cloud Engineer",
            "Junior PHP Developer",
            "Junior JavaScript Developer",
            "Junior React Developer",
            "Junior Vue.js Developer",
            "Junior Angular Developer",
            "Middle PHP Developer",
            "Middle JavaScript Developer",
            "Middle React Developer",
            "Middle Vue.js Developer",
            "Middle Angular Developer",
            "Senior Laravel Developer",
            "Senior Front-End Developer",
            "Senior Back-End Developer",
            "Senior Full Stack Developer",
            "Senior Java Developer",
            "Senior Python Developer",
            "Junior Python Developer",
            "Junior Java Developer",
            "Junior Node.js Developer",
            "Middle Node.js Developer",
            "Senior Node.js Developer",
            "Junior Ruby on Rails Developer",
            "Middle Ruby on Rails Developer",
            "Senior Ruby on Rails Developer",
            "Junior .NET Developer",
            "Middle .NET Developer",
            "Senior .NET Developer",
            "Junior C# Developer",
            "Middle C# Developer",
            "Senior C# Developer",
            "Junior iOS Developer",
            "Middle iOS Developer",
            "Senior iOS Developer",
            "Junior Android Developer",
            "Middle Android Developer",
            "Senior Android Developer",
            "Mobile Backend Developer",
            "Game Developer",
            "Front-End Engineer",
            "Back-End Engineer",
            "Junior DevOps Engineer",
            "Middle DevOps Engineer",
            "Senior DevOps Engineer",
            "QA Engineer",
            "Manual QA Engineer",
            "Automation QA Engineer",
            "Performance Test Engineer",
            "Security Engineer",
            "Security Analyst",
            "Network Administrator",
            "Junior Network Engineer",
            "Middle Network Engineer",
            "Senior Network Engineer",
            "Cloud Solutions Architect",
            "Junior Cloud Engineer",
            "Middle Cloud Engineer",
            "Senior Cloud Engineer",
            "Database Administrator (DBA)",
            "Junior DBA",
            "Middle DBA",
            "Senior DBA",
            "Data Scientist",
            "Junior Data Scientist",
            "Middle Data Scientist",
            "Senior Data Scientist",
            "Machine Learning Engineer",
            "AI Engineer",
            "Business Analyst",
            "Junior Business Analyst",
            "Middle Business Analyst",
            "Senior Business Analyst",
            "Project Manager",
            "Technical Project Manager",
            "Scrum Master",
            "Agile Coach",
            "UX Researcher",
            "UI Designer",
            "Visual Designer",
            "Interaction Designer",
            "Graphic Designer",
            "Motion Designer",
            "Product Owner",
            "Technical Product Manager",
            "Solutions Architect",
            "Cloud Architect",
            "IT Support Specialist",
            "IT Technician",
            "Infrastructure Engineer",
            "Systems Engineer",
            "Linux Administrator",
            "Windows Administrator",
            "Site Reliability Engineer (SRE)",
            "Embedded Systems Engineer",
            "Front-End Architect",
            "Back-End Architect",
            "Platform Engineer",
            "Integration Engineer",
            "API Developer",
            "API Engineer"
        ];

        // Pick a random employer from the DB
        $employer = JobListingsUser::where('role', 'employer')->inRandomOrder()->first();

        $title = $this->faker->unique()->randomElement($jobTitles);

        // Pick a random category from the DB
        $category = Category::inRandomOrder()->first();


        // if (!$employer || !$category) {
        //     throw new \Exception('No employer or category exists. Please seed users/categories first.');
        // }
        return [
            'user_id' => $employer->id, // fallback if no employer
            'category_id' => $category->id, // fallback if no category
            'title' => $title,
            'slug' => Str::slug($title . '-' . $this->faker->unique()->numberBetween(100, 999)),
            'description' => $this->faker->paragraphs(2, true),
            'benefits' => $this->faker->paragraphs(1, true),
            'skillset_About' => $this->faker->paragraphs(1, true),
            'location' => $this->faker->city(),
            'job_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'remote']),
            'salary_min' => $this->faker->numberBetween(30000, 70000),
            'salary_max' => $this->faker->numberBetween(80000, 150000),
            'status' => 'open',
            'expires_at' => now()->addDays(rand(15, 60)),
        ];
    }
}
