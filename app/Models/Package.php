<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration_days',
        'duration_nights',
        'meal_plan',
        'type',
        'emoji',
        'image_url',
        'is_featured',
        'is_active',
        'destination_id'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}