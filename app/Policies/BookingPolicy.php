<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;

class BookingPolicy
{
    public function cancel(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }
}