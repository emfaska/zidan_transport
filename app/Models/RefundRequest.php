<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    protected $fillable = [
        'booking_id',
        'user_id',
        'bank_name',
        'account_number',
        'account_name',
        'amount',
        'status',
        'reason',
        'admin_note',
        'bukti_penerimaan',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
