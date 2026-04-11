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
        'role',
        'is_active',
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

    public function driverProfile()
    {
        return $this->hasOne(DriverProfile::class, 'user_id');
    }

    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class, 'user_id');
    }

    public function pelangganProfile()
    {
        return $this->hasOne(PelangganProfile::class, 'user_id');
    }

    /**
     * Virtual attribute to get the correct profile photo based on role.
     */
    public function getFotoProfilAttribute()
    {
        if ($this->role === 'pengemudi' && $this->driverProfile) {
            return $this->driverProfile->foto_profil;
        } elseif ($this->role === 'admin' && $this->adminProfile) {
            return $this->adminProfile->foto_profil;
        } elseif ($this->role === 'pelanggan' && $this->pelangganProfile) {
            return $this->pelangganProfile->foto_profil;
        }
        return null;
    }

    /**
     * Virtual attribute to get the driver status if applicable.
     */
    public function getStatusDriverAttribute()
    {
        if ($this->role === 'pengemudi' && $this->driverProfile) {
            return $this->driverProfile->status_driver;
        }
        return null;
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