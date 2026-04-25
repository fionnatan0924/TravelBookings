<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Testimonial extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'content',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}