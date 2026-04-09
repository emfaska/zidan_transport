<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'potongan_persen',
        'kode_promo',
        'gambar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'potongan_persen' => 'integer',
    ];
}
