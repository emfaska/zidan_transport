<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengemudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengemudis = User::where('role', 'pengemudi')->latest()->get();
        return view('admin.pengemudi.index', compact('pengemudis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengemudi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'nullable|string|max:20',
            'nomor_sim' => 'required|string|max:50',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_driver' => 'required|in:available,on_duty,off',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengemudi',
            'no_hp' => $request->no_hp,
            'nomor_sim' => $request->nomor_sim,
            'status_driver' => $request->status_driver,
        ];

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('profiles', 'public');
        }

        User::create($data);

        return redirect()->route('admin.pengemudi.index')->with('success', 'Data pengemudi berhasil didaftarkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $pengemudi)
    {
        return view('admin.pengemudi.show', compact('pengemudi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pengemudi)
    {
        return view('admin.pengemudi.edit', compact('pengemudi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pengemudi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$pengemudi->id,
            'no_hp' => 'nullable|string|max:20',
            'nomor_sim' => 'required|string|max:50',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_driver' => 'required|in:available,on_duty,off',
        ]);

        $data = $request->only(['name', 'email', 'no_hp', 'nomor_sim', 'status_driver']);

        if ($request->hasFile('foto_profil')) {
            if ($pengemudi->foto_profil) {
                Storage::disk('public')->delete($pengemudi->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('profiles', 'public');
        }

        $pengemudi->update($data);

        return redirect()->route('admin.pengemudi.index')->with('success', 'Data pengemudi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengemudi)
    {
        if ($pengemudi->foto_profil) {
            Storage::disk('public')->delete($pengemudi->foto_profil);
        }
        $pengemudi->delete();
        return redirect()->route('admin.pengemudi.index')->with('success', 'Data pengemudi berhasil dihapus!');
    }
    /**
     * Approve the specified driver.
     */
    public function approve($id)
    {
        $pengemudi = User::findOrFail($id);
        $pengemudi->is_active = true;
        $pengemudi->rejection_note = null; // Reset catatan penolakan jika disetujui
        $pengemudi->save();

        return redirect()->route('admin.pengemudi.index')->with('success', 'Akun pengemudi berhasil disetujui dan diaktifkan!');
    }

    /**
     * Reject the specified driver with a note.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $pengemudi = User::findOrFail($id);
        $pengemudi->is_active = false;
        $pengemudi->rejection_note = $request->reason;
        $pengemudi->save();

        return redirect()->route('admin.pengemudi.index')->with('success', 'Pendaftaran pengemudi telah ditolak dengan catatan.');
    }
}
