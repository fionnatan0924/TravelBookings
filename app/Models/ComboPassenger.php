<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComboPassenger extends Model
{
    protected $fillable = [
        'combo_booking_id',
        'type',
        'full_name',
        'dob',
        'nationality',
        'passport_number'
    ];

    public function comboBooking()
    {
        return $this->belongsTo(ComboBooking::class);
    }
}