<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'full_name' => 'Иванов Иван Иванович',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '+7 (999) 123-45-67',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'full_name' => 'Иванов Иван Иванович',
            'role' => 'visitor',
        ]);
    }
}
