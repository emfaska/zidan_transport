<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanArmada extends Model
{
    protected $fillable = [
        'driver_id',
        'armada_id',
        'booking_id',
        'tipe_laporan',
        'deskripsi',
        'foto_bukti',
        'request_penggantian',
        'status',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
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
