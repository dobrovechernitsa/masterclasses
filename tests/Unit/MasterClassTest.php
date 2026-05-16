<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Category;
use App\Models\MasterClass;
use App\Models\User;
use Tests\TestCase;

class MasterClassTest extends TestCase
{
    public function test_available_spots_calculation()
    {
        $category = Category::factory()->create();
        $instructor = User::factory()->instructor()->create();

        $masterClass = MasterClass::factory()->create([
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
            'max_participants' => 10,
        ]);

        $this->assertEquals(10, $masterClass->available_spots);

        $user = User::factory()->visitor()->create();
        Booking::factory()->create([
            'master_class_id' => $masterClass->id,
            'user_id' => $user->id,
            'status' => 'confirmed',
        ]);

        $this->assertEquals(9, $masterClass->fresh()->available_spots);
    }
}
