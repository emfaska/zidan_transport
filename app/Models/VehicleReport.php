<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleReport extends Model
{
    protected $fillable = [
        'user_id',
        'armada_id',
        'booking_id',
        'category',
        'description',
        'photo',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
