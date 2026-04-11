<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DriverProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class DriverRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.driver-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat_domisili' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'nomor_sim' => ['required', 'string', 'max:50'],
            'foto_profil' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'foto_sim' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
            'alamat_domisili.required' => 'Alamat domisili wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nomor_sim.required' => 'Nomor SIM wajib diisi.',
            'foto_profil.required' => 'Foto profil pengemudi wajib diunggah.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format foto profil harus jpg, jpeg, atau png.',
            'foto_profil.max' => 'Ukuran foto profil maksimal 2MB.',
            'foto_sim.required' => 'Foto SIM wajib diunggah.',
            'foto_sim.image' => 'File SIM harus berupa gambar.',
            'foto_sim.mimes' => 'Format foto SIM harus jpg, jpeg, atau png.',
            'foto_sim.max' => 'Ukuran foto SIM maksimal 2MB.',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
                'role' => 'pengemudi',
                'is_active' => false,
            ]);

            $driverProfileData = [
                'alamat_domisili' => $request->alamat_domisili,
                'nomor_sim' => $request->nomor_sim,
                'status_driver' => 'off',
            ];

            if ($request->hasFile('foto_profil')) {
                $driverProfileData['foto_profil'] = $request->file('foto_profil')->store('profiles', 'public');
            }

            if ($request->hasFile('foto_sim')) {
                $driverProfileData['foto_sim'] = $request->file('foto_sim')->store('driver-documents/sim', 'public');
            }

            $user->driverProfile()->create($driverProfileData);
        });

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Akun Anda sedang dalam tinjauan admin. Kami akan menghubungi Anda segera.');
    }
}
