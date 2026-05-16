<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_is_instructor_returns_false_for_visitor()
    {
        $user = User::factory()->visitor()->create();
        $this->assertFalse($user->isInstructor());
    }
}