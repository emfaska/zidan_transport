<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementRequest extends Model
{
    protected $fillable = [
        'user_id',
        'booking_id',
        'old_armada_id',
        'new_armada_id',
        'reason',
        'status',
        'admin_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function oldArmada()
    {
        return $this->belongsTo(Armada::class, 'old_armada_id');
    }

    public function newArmada()
    {
        return $this->belongsTo(Armada::class, 'new_armada_id');
    }
}
