<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryAndBrandSeeder extends Seeder
{
    public function run()
    {
        // Create all categories
        Category::factory(10)->create();

        // Create all brands
        Brand::factory(15)->create();
    }
}
