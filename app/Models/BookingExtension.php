<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingExtension extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'new_return_date',
        'reason',
        'additional_price',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'new_return_date' => 'date',
        'additional_price' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
