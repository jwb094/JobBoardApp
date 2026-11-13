<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear categories before rebuilding the sample category set.
        Category::truncate();

        $categories = Category::factory()
            ->count(20)
            ->create();
    }
}
