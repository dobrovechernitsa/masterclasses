<?php

namespace App\Policies;

use App\Models\MasterClass;
use App\Models\User;

class MasterClassPolicy
{
    public function update(User $user, MasterClass $masterClass)
    {
        return $user->id === $masterClass->instructor_id && $user->isInstructor();
    }

    public function delete(User $user, MasterClass $masterClass)
    {
        return $user->id === $masterClass->instructor_id && $user->isInstructor();
    }
}
