<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComboBooking extends Model
{
    protected $fillable = [
        'user_id',
        'flight_id',
        'hotel_id',
        'check_in_date',
        'check_out_date',
        'guests',
        'total_price',
        'booking_reference',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // Add this relationship
    public function passengers()
    {
        return $this->hasMany(ComboPassenger::class, 'combo_booking_id');
    }
}