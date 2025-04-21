<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        $brands = [
            'Apple',
            'Samsung',
            'Sony',
            'LG',
            'Google',
            'Huawei',
            'OnePlus',
            'Xiaomi',
            'Dell',
            'HP',
            'Lenovo',
            'ASUS',
            'Bose',
            'JBL',
            'Microsoft'
        ];

        $name = $this->faker->unique()->randomElement($brands);

        return [
            'name' => $name,
            // 'description' => $this->faker->paragraph(1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
