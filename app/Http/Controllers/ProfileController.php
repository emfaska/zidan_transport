<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        
        // Pilih view berdasarkan role
        if ($user->role === 'admin') {
            return view('admin.profile', compact('user'));
        }
        
        if ($user->role === 'pengemudi') {
            return view('driver.profile', compact('user'));
        }
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only(['name', 'email', 'no_hp', 'alamat']);
        $user->update($data);

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('profile-photos', 'public');
            
            if ($user->role === 'pengemudi') {
                $profile = $user->driverProfile ?: new \App\Models\DriverProfile(['user_id' => $user->id]);
                if ($profile->foto_profil) Storage::disk('public')->delete($profile->foto_profil);
                $profile->foto_profil = $path;
                $profile->save();
            } elseif ($user->role === 'admin') {
                $profile = $user->adminProfile ?: new \App\Models\AdminProfile(['user_id' => $user->id]);
                if ($profile->foto_profil) Storage::disk('public')->delete($profile->foto_profil);
                $profile->foto_profil = $path;
                $profile->save();
            } elseif ($user->role === 'pelanggan') {
                $profile = $user->pelangganProfile ?: new \App\Models\PelangganProfile(['user_id' => $user->id]);
                if ($profile->foto_profil) Storage::disk('public')->delete($profile->foto_profil);
                $profile->foto_profil = $path;
                $profile->save();
            }
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
}
