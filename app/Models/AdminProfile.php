<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;

    protected $table = 'profil_admin';

    protected $fillable = [
        'user_id',
        'foto_profil',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
