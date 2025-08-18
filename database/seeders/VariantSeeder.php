<?php

namespace Database\Seeders;

use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        Variant::truncate();
        Schema::enableForeignKeyConstraints();

        $sizes = ['S', 'M', 'L', 'XL'];
        $colors = ['Red', 'Blue', 'Green', 'Black'];

        for ($i = 0; $i < 10; $i++) {
            Variant::create([
                'product_id' => rand(1, 10),
                'size' => $sizes[array_rand($sizes)],
                'color' => $colors[array_rand($colors)],
                'price_override' => rand(50, 200),
                'stock_qty' => rand(1, 100),
            ]);
        }
    }
}
