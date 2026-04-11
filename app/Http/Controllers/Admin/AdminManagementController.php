<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->with('adminProfile')->get();
        return view('admin.admin_management.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin_management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'jabatan' => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
                'role' => 'admin',
                'is_active' => true,
            ]);

            $adminProfileData = [
                'jabatan' => $request->jabatan,
            ];

            if ($request->hasFile('foto_profil')) {
                $adminProfileData['foto_profil'] = $request->file('foto_profil')->store('admin-profiles', 'public');
            }

            $user->adminProfile()->create($adminProfileData);
        });

        return redirect()->route('admin.management.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }
}
