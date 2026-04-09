<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArmadaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('armadas')->insert([
            [
                'nama' => 'Toyota HiAce Premium',
                'jenis' => 'Minibus',
                'kapasitas' => 14,
                'tahun' => 2023,
                'plat_nomor' => 'AG 7012 AB',
                'status' => 'tersedia',
                'foto' => null,
                'spesifikasi' => 'AC Central, Reclining Seats, Audio System, Bagasi Luas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Toyota Innova Reborn',
                'jenis' => 'MPV Premium',
                'kapasitas' => 7,
                'tahun' => 2022,
                'plat_nomor' => 'AG 8055 CD',
                'status' => 'tersedia',
                'foto' => null,
                'spesifikasi' => 'AC Double Blower, Captain Seat, Premium Audio, Smooth Ride',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Isuzu Elf Long Giga',
                'jenis' => 'Minibus',
                'kapasitas' => 19,
                'tahun' => 2024,
                'plat_nomor' => 'AG 9088 EF',
                'status' => 'tersedia',
                'foto' => null,
                'spesifikasi' => 'Full AC, Karaoke Audio, 19 Seats, Bagasi Ekstra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Toyota Avanza Veloz',
                'jenis' => 'MPV',
                'kapasitas' => 6,
                'tahun' => 2023,
                'plat_nomor' => 'AG 1122 GH',
                'status' => 'tersedia',
                'foto' => null,
                'spesifikasi' => 'AC, Radio/USB, Irit BBM, Bagasi Luas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Toyota Alphard',
                'jenis' => 'MPV Luxury',
                'kapasitas' => 6,
                'tahun' => 2022,
                'plat_nomor' => 'AG 1000 IJ',
                'status' => 'tersedia',
                'foto' => null,
                'spesifikasi' => 'Executive Lounge, Premium Sound, Sunroof, Electric Sliding Door',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
