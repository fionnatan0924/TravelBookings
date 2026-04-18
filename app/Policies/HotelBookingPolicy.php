<?php

namespace App\Policies;

use App\Models\HotelBooking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HotelBookingPolicy
{
    use HandlesAuthorization;

    public function view(User $user, HotelBooking $hotelBooking)
{
    return $user->id === $hotelBooking->user_id;
}
public function update(User $user, HotelBooking $hotelBooking)
{
    return $user->id === $hotelBooking->user_id;
}
}
