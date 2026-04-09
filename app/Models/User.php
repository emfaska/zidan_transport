<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'alamat',
        'alamat_domisili',
        'role',
        'is_active',
        'foto_profil',
        'nomor_sim',
        'foto_ktp',
        'foto_sim',
        'status_driver',
        'rejection_note',
    ];

    /**
     * Get the bookings for the customer.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    /**
     * Get the bookings assigned to the driver.
     */
    public function assignedBookings()
    {
        return $this->hasMany(Booking::class, 'driver_id');
    }

    /**
     * Get the driver's wallet.
     */
    public function wallet()
    {
        return $this->hasOne(DriverWallet::class, 'user_id');
    }

    /**
     * Get all wallet transactions for the driver.
     */
    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class, 'driver_id');
    }

    /**
     * Get all withdrawal requests for the driver.
     */
    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class, 'driver_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'driver_id');
    }

    /**
     * Get all refund requests made by the customer.
     */
    public function refundRequests()
    {
        return $this->hasMany(RefundRequest::class, 'user_id');
    }

    public function averageRating()
    {
        return $this->reviewsReceived()->avg('rating') ?: 0;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
}