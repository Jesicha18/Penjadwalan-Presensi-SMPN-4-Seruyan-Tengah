<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MataPelajaran; 
use App\Models\Kelas;
use App\Models\Guru;  // Ditambahkan agar bisa menghitung data dari tabel gurus
use App\Models\Siswa; // Ditambahkan agar bisa menghitung data siswa aktif

class WakaController extends Controller
{
    // Menampilkan dashboard waka beserta ringkasan statistik
// Menampilkan dashboard waka beserta ringkasan statistik
    public function index()
    {
        $jumlahMapel  = MataPelajaran::count();
        $jumlahKelas  = Kelas::count(); // Diubah jadi menghitung semua kelas dulu
        $jumlahGuru   = Guru::count(); 
        $jumlahSiswa  = Siswa::count(); // Diubah jadi menghitung semua siswa dulu

        return view('dashboard.waka', [
            'jumlahMapel'  => $jumlahMapel,
            'jumlahKelas'  => $jumlahKelas,
            'jumlahGuru'   => $jumlahGuru,
            'jumlahSiswa'  => $jumlahSiswa
        ]);
    }

    // Menampilkan halaman profil Waka Kurikulum
    public function editProfile()
    {
        return view('profile.profile-waka');
    }

    // Memperbarui email atau password Waka Kurikulum
    public function updateProfile(Request $request)
    {
        $userId = auth()->user()->getAuthIdentifier();
        $primaryKey = auth()->user()->getKeyName();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $userId . ',' . $primaryKey,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('waka.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}