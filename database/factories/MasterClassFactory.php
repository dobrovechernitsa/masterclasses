<?php

namespace Database\Factories;

use App\Models\MasterClass;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterClassFactory extends Factory
{
    protected $model = MasterClass::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'instructor_id' => User::factory()->instructor(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(2),
            'date' => fake()->dateTimeBetween('+1 day', '+30 days')->format('Y-m-d'),
            'time_slot' => fake()->randomElement(['9-11', '11-13', '13-15', '15-17']),
            'max_participants' => fake()->numberBetween(5, 20),
            'price' => fake()->randomFloat(2, 500, 5000),
        ];
    }
}