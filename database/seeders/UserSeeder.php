<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator Zidan',
                'password' => Hash::make('admin123'),
                'no_hp' => '081234567890',
                'alamat' => 'Kota Kediri, Jawa Timur',
                'role' => 'admin',
                'is_active' => true,
            ]
        );
        $admin->adminProfile()->firstOrCreate([], ['jabatan' => 'Super Admin']);

        // 2. Akun Pengemudi (Driver)
        $driver = User::firstOrCreate(
            ['email' => 'driver@gmail.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('driver123'),
                'no_hp' => '082233445566',
                'alamat' => 'Kec. Pesantren, Kediri',
                'role' => 'pengemudi',
                'is_active' => true,
            ]
        );
        $driver->driverProfile()->firstOrCreate([], [
            'alamat_domisili' => 'Kec. Pesantren, Kediri',
            'nomor_sim' => '1234567890',
            'status_driver' => 'available',
        ]);

        // 3. Akun Pelanggan (Customer)
        User::updateOrCreate(
            ['email' => 'pelanggan@gmail.com'],
            [
                'name' => 'Zidan Pelanggan',
                'password' => Hash::make('user123'),
                'no_hp' => '085566778899',
                'alamat' => 'Perumahan Indah, Kediri',
                'role' => 'pelanggan',
                'is_active' => true,
            ]
        );
    }
}