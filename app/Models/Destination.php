<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'starting_price',
        'color',
        'image_url'
    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function attractions()
{
    return $this->hasMany(Attraction::class);
}
}