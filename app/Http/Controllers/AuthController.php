<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MataPelajaran; 
use App\Models\Kelas;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah user ada dan statusnya aktif (is_active = 1)
        $user = User::where('email', $request->email)->first();

        if ($user && ($user->is_active ?? 1) == 0) {
            return back()->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan.',
            ])->onlyInput('email');
        }

        // Gunakan Auth::attempt untuk autentikasi email & password
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = strtolower(trim($user->role));

            $dashboard = match ($role) {
                'admin' => '/dashboard/admin',
                'waka', 'waka_kurikulum' => '/dashboard/waka',
                'kepsek' => '/dashboard/kepala-sekolah',
                'guru' => '/dashboard/guru',
                default => null, 
            };

            if ($dashboard === null) {
                Auth::logout();
                return back()->withErrors([
                    'email' => "Role '$role' tidak dikenali. Hubungi admin.",
                ]);
            }

            return redirect()->intended($dashboard);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Fungsi untuk menghitung data dan merender dashboard Kepala Sekolah
    public function dashboardKepalaSekolah()
    {
        $jumlahGuru = User::where('role', 'guru')->count(); 
        $jumlahKelas = Kelas::count();
        $jumlahMapel = MataPelajaran::count();
        $jumlahUser = User::count();

        return view('dashboard.kepala-sekolah', [
            'jumlahGuru' => $jumlahGuru,
            'jumlahKelas' => $jumlahKelas,
            'jumlahMapel' => $jumlahMapel,
            'jumlahUser' => $jumlahUser,
        ]);
    }

    // Fungsi untuk merender dashboard Guru
    public function dashboardGuru()
    {
        $user = Auth::user();
        return view('dashboard.guru', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}