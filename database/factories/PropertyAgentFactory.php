<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PropertyAgent;
use App\Models\User;

class PropertyAgentFactory extends Factory
{
    protected $model = PropertyAgent::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => User::factory(),
            'designation' => $this->faker->jobTitle(),
            'facebook' => $this->faker->url(),
            'twitter' => $this->faker->url(),
            'instagram' => $this->faker->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
