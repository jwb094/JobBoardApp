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
        $name = $this->faker->unique()->randomElement([
            'Software Development',
            'Design',
            'Marketing',
            'Finance',
            'Human Resources',
            'Sales',
            'Customer Support',
            'Data & Analytics',
            'Product Management',
            'IT & Networking',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
