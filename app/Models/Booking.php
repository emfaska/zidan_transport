<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'kode_booking',
        'user_id',
        'rute_id',
        'armada_id',
        'tipe_perjalanan',
        'tanggal_berangkat',
        'waktu_jemput',
        'titik_jemput',
        'titik_tujuan',
        'jumlah_penumpang',
        'include_tol',
        'harga_paket',
        'harga_tol',
        'total_harga',
        'status',
        'driver_id',
        'catatan_customer',
        'catatan_admin',
        'metode_pembayaran',
        'tipe_pembayaran',
        'status_pembayaran',
        'jumlah_bayar',
        'snap_token',
        'promo_id',
        'potongan_promo',
        'total_akhir',
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'waktu_jemput' => 'datetime',
        'include_tol' => 'boolean',
        'harga_paket' => 'decimal:2',
        'harga_tol' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'jumlah_bayar' => 'decimal:2',
        'status_pembayaran' => 'string',
        'potongan_promo' => 'decimal:2',
        'total_akhir' => 'decimal:2',
    ];

    // Relationship: Booking belongs to Promo
    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    // Relationship: Booking belongs to User (customer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Booking belongs to Rute
    public function rute()
    {
        return $this->belongsTo(Rute::class);
    }

    // Relationship: Booking belongs to Driver (User)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // Relationship: Booking belongs to Armada
    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }

    // Relationship: Booking has one WalletTransaction
    public function walletTransaction()
    {
        return $this->hasOne(WalletTransaction::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // Relationship: Booking has one RefundRequest
    public function refundRequest()
    {
        return $this->hasOne(RefundRequest::class);
    }

    // Relationship: Booking has many Extensions
    public function extensions()
    {
        return $this->hasMany(BookingExtension::class);
    }

    public function hasPendingExtension()
    {
        return $this->extensions()->where('status', 'pending')->exists();
    }

    // Auto-generate kode_booking on create
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            if (empty($booking->kode_booking)) {
                $booking->kode_booking = 'BOOK-' . date('Ymd') . '-' . str_pad(Booking::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
