<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\Role;
use App\Models\Section;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Seed Categories
        for ($i = 1; $i <= 10; $i++) {
            Category::create([
                'name' => "Category " . $i,
                'order' => rand(1, 10),
            ]);
        }

        // Seed Foods
        for ($i = 1; $i <= 20; $i++) {
            Food::create([
                'name' => "Food " . $i,
                'price' => rand(1000, 10000),
                'image_path' => "",
                'category_id' => rand(1, 10),
            ]);
        }

        // Seed Roles
        Role::create(['name' => "user", 'is_active' => true]);
        Role::create(['name' => "admin", 'is_active' => true]);
        Role::create(['name' => "waiter", 'is_active' => true]);
      
        User::factory(10)->create();

        // Seed Sections
        Section::create(['name' => "Finance"]);
        Section::create(['name' => "Kitchen"]);
        Section::create(['name' => "Waiter"]);

        // Seed Workers
        for ($i = 1; $i <= 15; $i++) {
            Worker::create([
                'user_id' => rand(1, 10),
                'section_id' => rand(1, 3),
                'monthly_salary_type' => ['kpi', 'fixed'][rand(0, 1)],
                'monthly_salary_amount' => rand(300, 3000),
                'bonus' => rand(0, 50),
                'hours_per_month' => rand(80, 160),
                'started_time' => now()->subHours(rand(1, 5))->format('H:i:s'),
                'ended_time' => now()->format('H:i:s'),
                'total_hours' => rand(1, 24),
            ]);
        }
    }
}
