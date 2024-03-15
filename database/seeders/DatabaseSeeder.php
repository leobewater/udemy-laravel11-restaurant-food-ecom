<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\User;
use App\Models\WhyChooseUs;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }

        if (Slider::count() === 0) {
            Slider::factory(4)->create();
        }

        if (SectionTitle::count() === 0) {
            $this->call(WhyChooseUsTitleSeeder::class);
        }

        if (WhyChooseUs::count() === 0) {
            WhyChooseUs::factory(3)->create();
        }

        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }
    }
}
