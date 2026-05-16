<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\MasterClass;

class MasterClassManagementTest extends TestCase
{
    public function test_instructor_can_create_master_class()
    {
        $instructor = User::factory()->instructor()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($instructor)->post('/instructor/master-classes', [
            'category_id' => $category->id,
            'title' => 'Тестовый мастер-класс',
            'description' => 'Описание тестового мастер-класса',
            'date' => '2026-06-15',
            'time_slot' => '9-11',
            'max_participants' => 10,
            'price' => 1500,
        ]);

        $response->assertRedirect('/instructor/cabinet');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('master_classes', [
            'title' => 'Тестовый мастер-класс',
            'instructor_id' => $instructor->id,
        ]);
    }

}