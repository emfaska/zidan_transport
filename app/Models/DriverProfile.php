<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverProfile extends Model
{
    use HasFactory;

    protected $table = 'profil_pengemudi';

    protected $fillable = [
        'user_id',
        'foto_profil',
        'nomor_sim',
        'foto_ktp',
        'foto_sim',
        'alamat_domisili',
        'status_driver',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
