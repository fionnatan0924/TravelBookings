<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $fillable = [
        'name',
        'destination_id',
        'rating',
        'reviews',
        'price',
        'original_price',
        'discount_text',
        'booking_text',
        'image_url',
        'is_active',
        'description',
        'schedule_info',
        'duration_minutes',
        'max_tickets_per_booking',
        'peak_season_surcharge',
        'peak_season_multiplier'
    ];

    protected $casts = [
        'rating' => 'float',
        'is_active' => 'boolean',
        'peak_season_surcharge' => 'boolean',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}