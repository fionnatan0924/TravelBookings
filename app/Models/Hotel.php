<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
protected $fillable = [
    'name', 'city', 'address', 'price_per_night', 'stars', 'amenities', 'image'
];
    
     public function comboBookings() { 
         return $this->hasMany(ComboBooking::class); }

public function hotelBookings()
{
    return $this->hasMany(HotelBooking::class);
}
}
