<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use App\Models\PropertyType;
use App\Models\PropertyAgent;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['active', 'pending', 'rejected']), // ✅ Qo‘shildi
            'property_type_id' => PropertyType::factory(),
            'property_agent_id' => PropertyAgent::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 50000, 500000),
            'location' => $this->faker->address,
            'is_for_rent' => $this->faker->boolean(),
            'is_for_sale' => $this->faker->boolean(),
        ];
    }
}
