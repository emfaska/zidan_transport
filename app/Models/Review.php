<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'booking_id',
        'user_id',
        'driver_id',
        'rating',
        'comment',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user() // Customer who gave the review
    {
        return $this->belongsTo(User::class);
    }

    public function driver() // Driver who received the review
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
