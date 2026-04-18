<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model {
    protected $fillable = ['booking_id', 'type', 'full_name', 'dob', 'nationality', 'passport_number'];

    public $timestamps=false;
    
    public function booking() { 
        return $this->belongsTo(Booking::class); }
}
