<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\PresensiGuru;
use App\Models\PresensiSiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapPresensiController extends Controller
{
    // Menampilkan halaman rekap presensi bulanan (Guru & Siswa)
    public function index(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->getAuthIdentifier())->first();

        // Filter Bulan, Tahun, Tab Aktif (guru / siswa)
        $bulanPilihan = $request->input('bulan', date('m'));
        $tahunPilihan = $request->input('tahun', date('Y'));
        $tabAktif     = $request->input('tab', 'guru');
        $kelasPilihan = $request->input('kelas_id');

        // Daftar kelas untuk dropdown presensi siswa
        $daftarKelas = Kelas::orderBy('nama_kelas')->get();

        // 1. REKAP GURU
        $listPresensiGuru = collect();

        $statistikGuru = [
            'hadir' => 0,
            'izin' => 0,
            'sakit' => 0,
            'tidak_hadir' => 0
        ];

        if ($guru) {
            $listPresensiGuru = PresensiGuru::where('guru_id', $guru->id)
                ->whereMonth('tanggal', $bulanPilihan)
                ->whereYear('tanggal', $tahunPilihan)
                ->orderBy('tanggal', 'ASC')
                ->get();

            $statistikGuru['hadir'] = $listPresensiGuru
                ->where('status_kehadiran', 'Hadir')->count();

            $statistikGuru['izin'] = $listPresensiGuru
                ->where('status_kehadiran', 'Izin')->count();

            $statistikGuru['sakit'] = $listPresensiGuru
                ->where('status_kehadiran', 'Sakit')->count();

            $statistikGuru['tidak_hadir'] = $listPresensiGuru
                ->where('status_kehadiran', 'Tidak Hadir')->count();
        }

        // 2. REKAP SISWA
            $queryPresensiSiswa = PresensiSiswa::with(['siswa', 'siswa.kelas'])            ->whereMonth('tanggal', $bulanPilihan)
            ->whereYear('tanggal', $tahunPilihan);

        // Filter kelas hanya untuk rekap siswa
        if (!empty($kelasPilihan)) {
            $queryPresensiSiswa->whereHas('siswa', function ($query) use ($kelasPilihan) {
                $query->where('kelas_id', $kelasPilihan);
            });
        }

        $listPresensiSiswa = $queryPresensiSiswa
            ->orderBy('tanggal', 'ASC')
            ->get();

return view('presensi.rekap-presensi', compact(
    'tabAktif',
    'bulanPilihan',
    'tahunPilihan',
    'statistikGuru',
    'listPresensiGuru',
    'listPresensiSiswa',
    'daftarKelas'
));
    }
}