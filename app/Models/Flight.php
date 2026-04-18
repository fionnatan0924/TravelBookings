<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin',
        'destination',
        'departure_date',
        'cabin_class',
        'available_seats',
        'price',
    ];

    
public function bookings() { 
    return $this->hasMany(Booking::class, 'outbound_flight_id'); }
}