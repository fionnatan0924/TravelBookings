<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'outbound_flight_id',
        'return_flight_id',
        'booking_reference',
        'status',
        'total_price',
        'luggage_option',
        'luggage_cost',
        'booking_date',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function outboundFlight()
    {
        return $this->belongsTo(Flight::class, 'outbound_flight_id');
    }

    public function returnFlight()
    {
        return $this->belongsTo(Flight::class, 'return_flight_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}