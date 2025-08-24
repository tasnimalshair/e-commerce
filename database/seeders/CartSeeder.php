<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Cart::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < 5; $i++) {
            Cart::create([
                'user_id' => $i +1 
            ]);
        }
    }
}
