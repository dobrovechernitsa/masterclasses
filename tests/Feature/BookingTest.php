<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\MasterClass;
use App\Models\Category;
use App\Models\Booking;

class BookingTest extends TestCase
{
    public function test_guest_cannot_see_booking_button()
    {
        $category = Category::factory()->create();
        $instructor = User::factory()->instructor()->create();
        $masterClass = MasterClass::factory()->create([
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
        ]);

        $response = $this->get('/categories/' . $category->id);
        $response->assertDontSee('записаться');
    }

    public function test_authenticated_user_can_see_booking_button()
    {
        $user = User::factory()->visitor()->create();
        $category = Category::factory()->create();
        $masterClass = MasterClass::factory()->create([
            'category_id' => $category->id,
            'max_participants' => 10,
        ]);

        $response = $this->actingAs($user)->get('/categories/' . $category->id);
        $response->assertSee('записаться');
    }

    public function test_user_can_book_master_class()
    {
        $user = User::factory()->visitor()->create();
        $category = Category::factory()->create();
        $instructor = User::factory()->instructor()->create();
        $masterClass = MasterClass::factory()->create([
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
            'max_participants' => 10,
        ]);

        $response = $this->actingAs($user)->post('/booking/' . $masterClass->id);

        $response->assertRedirect('/categories/' . $category->id);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'master_class_id' => $masterClass->id,
            'status' => 'confirmed',
        ]);
    }

}