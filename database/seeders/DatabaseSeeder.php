<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WhyChooseUs;
use Illuminate\Database\Seeder;

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

        if (WhyChooseUs::count() === 0) {
            $this->call(WhyChooseUsSeeder::class);
        }
    }
}
