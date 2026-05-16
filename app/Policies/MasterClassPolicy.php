<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MasterClass;

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