<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Архитектурное моделирование',
                'Кулинария',
                'Резьба по дереву',
            ]),
            'description' => fake()->paragraph(3),
            'image' => null,
        ];
    }
}