<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // <-- Pastikan ini di-import di bagian atas controller jika belum ada
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\SlotWaktu;

use App\Models\JadwalPelajaran; // <-- Tambahkan baris import ini di bagian atas!// <-- Pastikan model Jadwal di-import di sini

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

    /**
     * Memperbarui email atau password kepala sekolah.
     */
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

    /**
     * Menampilkan halaman melihat jadwal pelajaran untuk kepala sekolah.
     */
public function melihatJadwal(Request $request)
    {
        // Ambil daftar tahun ajaran yang tersedia di database
        $years = JadwalPelajaran::whereNotNull('tahun_ajaran')->distinct()->orderByDesc('tahun_ajaran')->pluck('tahun_ajaran')->all();
        if (!$years) $years = [date('Y') . '/' . (date('Y') + 1)];
        
        $year = $request->input('tahun_ajaran', session('tahun_ajaran_aktif', $years[0]));
        $semester = $request->input('semester', session('semester_aktif', 'Ganjil'));
        
        session(['tahun_ajaran_aktif' => $year, 'semester_aktif' => $semester]);

        $kelasList = Kelas::where('is_active', 1)->orderBy('nama_kelas')->get();
        $slotWaktuList = SlotWaktu::orderBy('urutan')->get();
        
        $jadwalList = JadwalPelajaran::with(['mataPelajaran', 'guru', 'kelas', 'slotWaktu'])
            ->where('tahun_ajaran', $year)
            ->where('semester', $semester)
            ->get();

        // Susun ke dalam bentuk matriks grid (Hari -> Jam -> Kelas)
        $matriksJadwal = [];
        foreach ($jadwalList as $jadwal) {
            $slot = $jadwal->slotWaktu;
            $day = strtolower(trim((string) ($slot->hari ?? $jadwal->hari ?? '')));
            $start = substr(trim((string) ($slot->jam_mulai ?? $jadwal->jam_mulai ?? '')), 0, 5);
            $classId = $jadwal->kelas_id;
            
            $cell = [
                'mapel' => $jadwal->mataPelajaran->nama_mapel ?? '-', 
                'guru' => $jadwal->guru->nama ?? '-'
            ];
            
            $matriksJadwal[$day][$start][$classId] = $cell;
        }

        $tahunAjaran = $year;
        $listTahunAjaran = $years;

        return view('kepala-sekolah.melihat-jadwal', compact(
            'slotWaktuList', 
            'kelasList', 
            'matriksJadwal', 
            'tahunAjaran', 
            'semester', 
            'listTahunAjaran'
        ));
    }
}