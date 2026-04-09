<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek status aktif (khusus untuk alur persetujuan driver)
            if (!Auth::user()->is_active) {
                $user = Auth::user();
                Auth::logout();
                
                if ($user->role === 'pengemudi') {
                    if ($user->rejection_note) {
                        return back()->withErrors(['email' => 'Pendaftaran ditolak. Alasan: ' . $user->rejection_note . '. Silakan perbaiki data Anda.']);
                    }
                    return back()->withErrors(['email' => 'Akun Anda sedang dalam tahap peninjauan oleh admin. Mohon tunggu konfirmasi selanjutnya.']);
                }
                
                return back()->withErrors(['email' => 'Akun Anda nonaktif. Silakan hubungi admin.']);
            }

            // Redirect berdasarkan role
            return $this->redirectByRole(Auth::user()->role);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    protected function redirectByRole($role)
    {
        return match ($role) {
            'admin' => redirect()->intended('/admin/dashboard'),
            'pengemudi' => redirect()->intended('/driver/dashboard'),
            default => redirect()->intended('/home'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}