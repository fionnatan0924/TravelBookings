<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Testimonial extends Model
{
    protected $fillable = [
        'content',
        'location',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}