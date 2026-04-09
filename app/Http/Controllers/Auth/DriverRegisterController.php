<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'foto_ktp' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
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
            'foto_ktp.required' => 'Foto KTP wajib diunggah.',
            'foto_ktp.image' => 'File KTP harus berupa gambar.',
            'foto_ktp.mimes' => 'Format foto KTP harus jpg, jpeg, atau png.',
            'foto_ktp.max' => 'Ukuran foto KTP maksimal 2MB.',
            'foto_sim.required' => 'Foto SIM wajib diunggah.',
            'foto_sim.image' => 'File SIM harus berupa gambar.',
            'foto_sim.mimes' => 'Format foto SIM harus jpg, jpeg, atau png.',
            'foto_sim.max' => 'Ukuran foto SIM maksimal 2MB.',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat_domisili' => $request->alamat_domisili,
            'nomor_sim' => $request->nomor_sim,
            'password' => Hash::make($request->password),
            'role' => 'pengemudi',
            'is_active' => false, // Menunggu persetujuan admin
            'status_driver' => 'off',
        ];

        if ($request->hasFile('foto_ktp')) {
            $data['foto_ktp'] = $request->file('foto_ktp')->store('driver-documents/ktp', 'public');
        }

        if ($request->hasFile('foto_sim')) {
            $data['foto_sim'] = $request->file('foto_sim')->store('driver-documents/sim', 'public');
        }

        User::create($data);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Akun Anda sedang dalam tinjauan admin. Kami akan menghubungi Anda segera.');
    }
}
