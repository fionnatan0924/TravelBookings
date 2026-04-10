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
}