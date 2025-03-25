<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PropertyType;

class PropertyTypeFactory extends Factory
{
    protected $model = PropertyType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(), // Tasodifiy tur nomi
            'icon' => $this->faker->imageUrl(50, 50, 'abstract', true, 'icon'), // Tasodifiy ikon URL
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
