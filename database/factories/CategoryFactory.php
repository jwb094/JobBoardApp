<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            "Software Development",
            "Design",
            "Marketing",
            "Finance",
            "Human Resources",
            "Sales",
            "Customer Support",
            "Data & Analytics",
            "Product Management",
            "IT & Networking",
            "Web Development",
            "Mobile Development",
            "Frontend Development",
            "Backend Development",
            "Full Stack Development",
            "DevOps",
            "Cloud Computing",
            "Cybersecurity",
            "Database Management",
            "Business Analysis",
            "Project Management",
            "Agile & Scrum",
            "UI/UX Design",
            "Graphic Design",
            "Visual Design",
            "Interaction Design",
            "Motion Design",
            "Content Marketing",
            "Digital Marketing",
            "Social Media Marketing",
            "SEO & SEM",
            "Email Marketing",
            "Product Marketing",
            "Brand Management",
            "Public Relations",
            "Customer Success",
            "Technical Support",
            "Operations",
            "Logistics",
            "Procurement",
            "Supply Chain",
            "Quality Assurance",
            "Testing & QA",
            "Performance Testing",
            "Security & Compliance",
            "Risk Management",
            "Accounting",
            "Financial Planning",
            "Investment Analysis",
            "Audit & Compliance",
            "Payroll",
            "Recruitment",
            "Talent Acquisition",
            "Training & Development",
            "Employee Engagement",
            "Legal & Compliance",
            "Corporate Strategy",
            "Business Development",
            "Sales Operations",
            "Inside Sales",
            "Field Sales",
            "Account Management",
            "Customer Experience",
            "Data Science",
            "Machine Learning",
            "Artificial Intelligence",
            "Business Intelligence",
            "Big Data",
            "Analytics & Reporting",
            "Research & Development",
            "Innovation",
            "Product Design",
            "Hardware Engineering",
            "Embedded Systems",
            "Network Administration",
            "Systems Administration",
            "IT Support",
            "Site Reliability Engineering",
            "Game Development",
            "Animation & VFX",
            "Video Production",
            "Photography",
            "Copywriting",
            "Technical Writing",
            "Instructional Design",
            "Event Management",
            "Corporate Communications",
            "Customer Insights",
            "Market Research",
            "E-commerce",
            "Retail Management",
            "Hospitality & Tourism",
            "Healthcare Administration",
            "Education & Training",
            "Environmental & Sustainability",
            "Government & Public Sector",
            "Non-Profit Management",
            "Consulting",
            "Entrepreneurship"
        ];
        $name = $this->faker->unique()->randomElement($names);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
