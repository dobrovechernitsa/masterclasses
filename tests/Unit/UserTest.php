<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_is_instructor_returns_false_for_visitor()
    {
        $user = User::factory()->visitor()->create();
        $this->assertFalse($user->isInstructor());
    }
}
