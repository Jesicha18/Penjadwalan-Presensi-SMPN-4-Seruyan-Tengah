<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;

class KepalaSekolahController extends Controller
{
    /**
     * Menampilkan dashboard utama kepala sekolah beserta ringkasan statistik.
     */
    public function index()
    {
        $jumlahGuru = User::where('role', 'guru')->count();
        $jumlahKelas = Kelas::count();
        $jumlahMapel = Mapel::count();
        $jumlahUser = User::count();

        return view('dashboard.kepala-sekolah', compact(
            'jumlahGuru',
            'jumlahKelas',
            'jumlahMapel',
            'jumlahUser'
        ));
    }

    /**
     * Menampilkan daftar monitoring data guru khusus kepala sekolah.
     */
    public function indexGuru()
    {
        $gurus = User::where('role', 'guru')->get();
        return view('kepala-sekolah.guru', compact('gurus'));
    }

    public function indexKelas()
    {
        $kelasList = Kelas::all();
        return view('kepala-sekolah.kelas', compact('kelasList'));
    }

    public function indexMapel()
    {
        $mapelList = \App\Models\MataPelajaran::all();
        return view('kepala-sekolah.mapel', compact('mapelList'));
    }

    public function indexUser()
    {
        $userList = User::all();
        return view('kepala-sekolah.user', compact('userList'));
    }

    /**
     * Menampilkan halaman profil kepala sekolah.
     */
    public function editProfile()
    {
        return view('profile.profil-kepsek');
    }

     //  Memperbarui email atau password kepala sekolah.
public function updateProfile(Request $request)
{
    // Dapatkan nama primary key user yang aktif secara dinamis
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

    return redirect()->route('kepala-sekolah.profile')->with('success', 'Profil berhasil diperbarui!');
}
}