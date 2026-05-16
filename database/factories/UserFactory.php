<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'full_name' => fake()->name().' '.fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password123'),
            'phone' => '8'.fake()->numerify('9#########'),
            'role' => 'visitor',
            'photo' => null,
        ];
    }

    public function instructor(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'instructor',
        ]);
    }

    public function visitor(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'visitor',
        ]);
    }
}
