<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    protected $fillable = [
        'nama',
        'jenis',
        'bbm',
        'kapasitas',
        'tahun',
        'plat_nomor',
        'status',
        'foto',
        'spesifikasi',
    ];

    // Relationship: Armada has many Rutes
    public function rutes()
    {
        return $this->hasMany(Rute::class);
    }

    public function reports()
    {
        return $this->hasMany(VehicleReport::class);
    }

    public function replacementRequests()
    {
        return $this->hasMany(ReplacementRequest::class, 'old_armada_id');
    }
}
