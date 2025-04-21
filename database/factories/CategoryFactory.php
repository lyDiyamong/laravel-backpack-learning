<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $categories = [
            'Smartphones',
            'Tablets',
            'Laptops',
            'Smartwatches',
            'Accessories',
            'Audio Devices',
            'Gaming Consoles',
            'Cameras',
            'TV & Home Theater',
            'Computer Components'
        ];

        $name = $this->faker->unique()->randomElement($categories);

        return [
            'name' => $name,
            // 'image'=> 'image.png'
        ];
    }
}
