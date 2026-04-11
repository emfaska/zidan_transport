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
        $request->validate([
            'login' => 'required|string',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_hp';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek status aktif (khusus untuk alur persetujuan driver)
            if (!Auth::user()->is_active) {
                $user = Auth::user();
                Auth::logout();
                
                if ($user->role === 'pengemudi') {
                    if ($user->rejection_note) {
                        return back()->withErrors(['login' => 'Pendaftaran ditolak. Alasan: ' . $user->rejection_note . '. Silakan perbaiki data Anda.']);
                    }
                    return back()->withErrors(['login' => 'Akun Anda sedang dalam tahap peninjauan oleh admin. Mohon tunggu konfirmasi selanjutnya.']);
                }
                
                return back()->withErrors(['login' => 'Akun Anda nonaktif. Silakan hubungi admin.']);
            }

            // Redirect berdasarkan role
            return $this->redirectByRole(Auth::user()->role);
        }

        return back()->withErrors(['login' => 'Email/No HP atau password salah.']);
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