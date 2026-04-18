<?php

namespace App\Policies;

use App\Models\ComboBooking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComboBookingPolicy
{
    use HandlesAuthorization;

    // app/Policies/ComboBookingPolicy.php
public function view(User $user, ComboBooking $comboBooking) {
     return $user->id === $comboBooking->user_id; }
public function update(User $user, ComboBooking $comboBooking) {
     return $user->id === $comboBooking->user_id; }
}
