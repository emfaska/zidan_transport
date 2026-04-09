<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rutes')->insert([
            // Luar Kota
            [
                'layanan_id' => 2, // Luar Kota
                'nama_rute' => 'Kediri - Bandara Juanda',
                'lokasi_awal' => 'Kota Kediri',
                'tujuan' => 'Bandara Juanda (T1/T2)',
                'armada_id' => 2, // Innova Reborn
                'harga_paket' => 500000,
                'harga_tol' => 85000,
                'durasi_estimasi' => '2.5 jam',
                'jarak_km' => 120,
                'catatan' => 'Harga terbaik untuk Innova Reborn. Include Driver & BBM.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'layanan_id' => 2, // Luar Kota
                'nama_rute' => 'Kediri - Surabaya Kota',
                'lokasi_awal' => 'Kota Kediri',
                'tujuan' => 'Surabaya Mall/Hotel',
                'armada_id' => 1, // HiAce
                'harga_paket' => 750000,
                'harga_tol' => 85000,
                'durasi_estimasi' => '3 jam',
                'jarak_km' => 130,
                'catatan' => 'Hemat untuk rombongan (14 orang). Include Driver & BBM.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'layanan_id' => 2, // Luar Kota
                'nama_rute' => 'Kediri - Malang (Batu)',
                'lokasi_awal' => 'Kota Kediri',
                'tujuan' => 'Kota Wisata Batu',
                'armada_id' => 3, // Elf Long Giga
                'harga_paket' => 950000,
                'harga_tol' => 50000,
                'durasi_estimasi' => '2.5 jam',
                'jarak_km' => 100,
                'catatan' => 'Muat banyak pemain (19 orang). Harga promo.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Wisata
            [
                'layanan_id' => 5, // Wisata
                'nama_rute' => 'Wisata Jogja (City Tour)',
                'lokasi_awal' => 'Kediri',
                'tujuan' => 'Yogyakarta City',
                'armada_id' => 2, // Innova Reborn
                'harga_paket' => 1200000,
                'harga_tol' => 150000,
                'durasi_estimasi' => 'Full Day',
                'jarak_km' => 250,
                'catatan' => 'Wisata nyaman dengan Innova Reborn. Harga Nett.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'layanan_id' => 5, // Wisata
                'nama_rute' => 'Wisata Bromo (Midnight)',
                'lokasi_awal' => 'Kediri',
                'tujuan' => 'Cemoro Lawang / Probolinggo',
                'armada_id' => 1, // HiAce
                'harga_paket' => 1500000,
                'harga_tol' => 120000,
                'durasi_estimasi' => '12 jam',
                'jarak_km' => 200,
                'catatan' => 'Fasilitas premium HiAce. Driver handal medan tanjakan.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Pernikahan
            [
                'layanan_id' => 3, // Pernikahan
                'nama_rute' => 'Wedding VIP - Kediri Raya',
                'lokasi_awal' => 'Standby Kediri',
                'tujuan' => 'Venue / Hotel',
                'armada_id' => 5, // Alphard
                'harga_paket' => 2500000,
                'harga_tol' => 0,
                'durasi_estimasi' => '12 jam',
                'jarak_km' => 50,
                'catatan' => 'Sudah termasuk hiasan bunga dan driver formal.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Ziarah
            [
                'layanan_id' => 4, // Ziarah
                'nama_rute' => 'Ziarah Wali 5 (Short)',
                'lokasi_awal' => 'Kediri',
                'tujuan' => 'Gresik - Tuban - Lamongan',
                'armada_id' => 3, // Elf Long Giga
                'harga_paket' => 2200000,
                'harga_tol' => 200000,
                'durasi_estimasi' => '24 jam',
                'jarak_km' => 350,
                'catatan' => 'Elf Giga 19 seats. Super lega untuk rombongan ziarah.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
