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
        Category::truncate();

        $categories = [
            ['name' => 'Technology', 'description' => 'All about the latest in tech.'],
            ['name' => 'Business', 'description' => 'Tips and news about the business world.'],
            ['name' => 'Health', 'description' => 'Health advice and wellness tips.'],
            ['name' => 'Education', 'description' => 'Learning resources and educational content.'],
            ['name' => 'Lifestyle', 'description' => 'Daily life tips and inspiration.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
