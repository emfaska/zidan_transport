<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganProfile extends Model
{
    use HasFactory;

    protected $table = 'profil_pelanggan';

    protected $fillable = [
        'user_id',
        'foto_profil',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
