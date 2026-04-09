<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverWallet extends Model
{
    protected $fillable = [
        'user_id',
        'balance',
        'total_earned',
        'total_withdrawn',
    ];

    protected $casts = [
        'balance'         => 'decimal:2',
        'total_earned'    => 'decimal:2',
        'total_withdrawn' => 'decimal:2',
    ];

    // Relasi ke driver (User)
    public function driver()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke riwayat transaksi
    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'driver_id', 'user_id');
    }
}
