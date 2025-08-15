<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();
        
        $products = [
            // Technology
            [
                'name' => 'Wireless Bluetooth Headphones',
                'slug' => Str::slug('Wireless Bluetooth Headphones'),
                'description' => 'High-quality headphones with noise cancellation and long battery life.',
                'price' => 120.00,
                'image' => 'products/headphones.jpg',
                'stock' => 15,
                'category_id' => 1, // Technology
                'seller_id' => 5,
            ],
            [
                'name' => 'Smart Home Assistant',
                'slug' => Str::slug('Smart Home Assistant'),
                'description' => 'Voice-controlled smart assistant to manage your home devices.',
                'price' => 89.99,
                'image' => 'products/smart-assistant.jpg',
                'stock' => 20,
                'category_id' => 1,
                'seller_id' => 6,
            ],

            // Business
            [
                'name' => 'Professional Business Planner',
                'slug' => Str::slug('Professional Business Planner'),
                'description' => 'Organize your work schedule and business goals efficiently.',
                'price' => 25.00,
                'image' => 'products/business-planner.jpg',
                'stock' => 50,
                'category_id' => 2, // Business
                'seller_id' => 5,
            ],
            [
                'name' => 'Ergonomic Office Chair',
                'slug' => Str::slug('Ergonomic Office Chair'),
                'description' => 'Comfortable chair with adjustable height and lumbar support.',
                'price' => 250.00,
                'image' => 'products/office-chair.jpg',
                'stock' => 8,
                'category_id' => 2,
                'seller_id' => 2,
            ],

            // Health
            [
                'name' => 'Smart Fitness Watch',
                'slug' => Str::slug('Smart Fitness Watch'),
                'description' => 'Track your steps, heart rate, and workouts with style.',
                'price' => 85.50,
                'image' => 'products/fitness-watch.jpg',
                'stock' => 20,
                'category_id' => 3, // Health
                'seller_id' => 6,
            ],
            [
                'name' => 'Yoga Mat Non-Slip',
                'slug' => Str::slug('Yoga Mat Non-Slip'),
                'description' => 'Durable, non-slip yoga mat perfect for all fitness levels.',
                'price' => 30.00,
                'image' => 'products/yoga-mat.jpg',
                'stock' => 25,
                'category_id' => 3,
                'seller_id' => 5,
            ],

            // Education
            [
                'name' => 'Beginner Programming Book',
                'slug' => Str::slug('Beginner Programming Book'),
                'description' => 'Learn programming basics with practical examples.',
                'price' => 40.00,
                'image' => 'products/programming-book.jpg',
                'stock' => 35,
                'category_id' => 4, // Education
                'seller_id' => 2,
            ],
            [
                'name' => 'Online Course: Digital Marketing',
                'slug' => Str::slug('Online Course: Digital Marketing'),
                'description' => 'Comprehensive guide to grow your business online.',
                'price' => 199.99,
                'image' => 'products/digital-marketing-course.jpg',
                'stock' => 100,
                'category_id' => 4,
                'seller_id' => 6,
            ],

            // Lifestyle
            [
                'name' => 'Aromatherapy Essential Oils Set',
                'slug' => Str::slug('Aromatherapy Essential Oils Set'),
                'description' => 'Relax and refresh with natural essential oils.',
                'price' => 45.00,
                'image' => 'products/essential-oils.jpg',
                'stock' => 40,
                'category_id' => 5, // Lifestyle
                'seller_id' => 5,
            ],
            [
                'name' => 'Stainless Steel Water Bottle',
                'slug' => Str::slug('Stainless Steel Water Bottle'),
                'description' => 'Keeps drinks cold for 24 hours and hot for 12 hours.',
                'price' => 18.00,
                'image' => 'products/water-bottle.jpg',
                'stock' => 50,
                'category_id' => 5,
                'seller_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
