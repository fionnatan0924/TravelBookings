<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttractionBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'attraction_id',
        'number_of_people',
        'total_price',
        'booking_reference',
        'status',
        'booking_date',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}