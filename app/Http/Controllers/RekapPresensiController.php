<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\PresensiGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapPresensiController extends Controller
{
    // Menampilkan halaman rekap presensi bulanan (Guru & Siswa)
    public function index(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->getAuthIdentifier())->first();

        // Filter Bulan, Tahun, dan Tab Aktif (guru / siswa)
        $bulanPilihan = $request->input('bulan', date('m'));
        $tahunPilihan = $request->input('tahun', date('Y'));
        $tabAktif     = $request->input('tab', 'guru');

        // 1. REKAP GURU
        $listPresensiGuru = collect();
        // Tambahkan 'tidak_hadir' pada array statistik
        $statistikGuru = ['hadir' => 0, 'izin' => 0, 'sakit' => 0, 'tidak_hadir' => 0];

        if ($guru) {
            $listPresensiGuru = PresensiGuru::where('guru_id', $guru->id)
                ->whereMonth('tanggal', $bulanPilihan)
                ->whereYear('tanggal', $tahunPilihan)
                ->orderBy('tanggal', 'ASC')
                ->get();

            $statistikGuru['hadir']       = $listPresensiGuru->where('status_kehadiran', 'Hadir')->count();
            $statistikGuru['izin']        = $listPresensiGuru->where('status_kehadiran', 'Izin')->count();
            $statistikGuru['sakit']       = $listPresensiGuru->where('status_kehadiran', 'Sakit')->count();
            // Menghitung status Tidak Hadir secara terpisah
            $statistikGuru['tidak_hadir'] = $listPresensiGuru->where('status_kehadiran', 'Tidak Hadir')->count();
        }

        // 2. REKAP SISWA
        $listPresensiSiswa = collect();

        return view('presensi.rekap-presensi', compact(
            'user', 
            'guru', 
            'listPresensiGuru', 
            'statistikGuru', 
            'listPresensiSiswa',
            'bulanPilihan', 
            'tahunPilihan',
            'tabAktif'
        ));
    }
}