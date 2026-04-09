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
        User::updateOrCreate(
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

        // 2. Akun Pengemudi (Driver)
        User::updateOrCreate(
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