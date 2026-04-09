<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('layanans')->insert([
            [
                'nama_layanan' => 'Dalam Kota',
                'deskripsi' => 'Layanan transportasi dalam kota untuk kebutuhan sehari-hari',
                'icon' => 'bi-building',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Luar Kota',
                'deskripsi' => 'Layanan transportasi antar kota untuk perjalanan jarak jauh',
                'icon' => 'bi-signpost-2',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Pernikahan',
                'deskripsi' => 'Layanan khusus untuk acara pernikahan dengan armada mewah',
                'icon' => 'bi-heart',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Ziarah',
                'deskripsi' => 'Paket perjalanan ziarah ke makam wali atau tempat bersejarah',
                'icon' => 'bi-moon-stars',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Wisata',
                'deskripsi' => 'Paket wisata dengan guide berpengalaman',
                'icon' => 'bi-camera',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
