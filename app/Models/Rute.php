<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $fillable = [
        'layanan_id',
        'nama_rute',
        'lokasi_awal',
        'tujuan',
        'armada_id',
        'harga_paket',
        'harga_paket_pp',
        'harga_tol',
        'durasi_estimasi',
        'jarak_km',
        'catatan',
        'is_active',
    ];

    protected $casts = [
        'harga_paket' => 'decimal:2',
        'harga_paket_pp' => 'decimal:2',
        'harga_tol' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationship: Rute belongs to Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    // Relationship: Rute belongs to Armada
    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }

    // Relationship: Rute has many Bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
