<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\MasterClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->visitor(),
            'master_class_id' => MasterClass::factory(),
            'status' => fake()->randomElement(['confirmed', 'cancelled', 'pending']),
        ];
    }

    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }
}