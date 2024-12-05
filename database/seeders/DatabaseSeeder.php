<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        for ($i=1; $i <= 10; $i++) { 
            Category::create([
                'name' => "Category " . $i,
                'order' => rand(1,10),
            ]);
        }

        for ($i=1; $i <= 20; $i++) {
            Food::create([
                'name' => "Food " . $i,
                'price' => rand(1000, 10000),
                'image_path' => "",
                'category_id' => rand(1,10),
            ]);
        }
    }
}
