<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\PresensiGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class GuruController extends Controller
{
    // Menampilkan daftar guru
    public function index()
    {
        $guruList = Guru::with('user')->get();
        return view('guru.index', compact('guruList'));
    }

    // Menampilkan form tambah guru
    public function create()
    {
        // Mengambil user yang memiliki role 'guru' untuk dropdown Akun User dan Nama Lengkap
        $users = User::where('role', 'guru')->get();
        $usersGuru = $users; // Variabel tambahan khusus untuk dropdown nama lengkap
        
        return view('guru.create', compact('users', 'usersGuru'));
    }

    // Menyimpan data guru baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id_user', 'unique:gurus,user_id'],
            'nip'     => ['required', 'string', 'max:50', 'unique:gurus,nip'],
            'nama'    => ['required', 'string', 'max:255'],
            'status_kepegawaian' => ['required', 'string', 'max:100'],
            'status_sertifikasi' => ['required', 'string', 'max:100'], 
            'jabatan_struktural' => ['required', 'string', 'max:100'],
        ], [
            'user_id.required' => 'Akun user wajib dipilih.',
            'user_id.exists'   => 'Akun user tidak ditemukan.',
            'user_id.unique'   => 'Akun user ini sudah terdaftar sebagai data guru.',
            'nip.unique'       => 'Nomor Induk Pegawai (NIP) sudah terdaftar.',
            'status_kepegawaian.required' => 'Status kepegawaian wajib diisi.',
            'jabatan_struktural.required' => 'Jabatan struktural wajib diisi.',
        ]);

        Guru::create($request->only('user_id', 'nip', 'nama', 'status_kepegawaian', 'jabatan_struktural'));

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    // Menampilkan form edit guru
    public function edit(Guru $guru)
    {
        // Mengambil user dengan role 'guru', ATAU sertakan juga user yang sedang terikat pada guru ini 
        $users = User::where('role', 'guru')
                    ->orWhere('id_user', $guru->user_id)
                    ->get();
        
        $usersGuru = $users;

        return view('guru.edit', compact('guru', 'users', 'usersGuru'));
    }

    // Menyimpan perubahan data guru
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'user_id' => [
                'required',
                'exists:users,id_user',
                'unique:gurus,user_id,' . $guru->id
            ],
            'nip' => [
                'required',
                'string',
                'max:50',
                'unique:gurus,nip,' . $guru->id
            ],
            'nama' => [
                'required',
                'string',
                'max:255'
            ],
            'status_kepegawaian' => [
                'required',
                'string',
                'max:100'
            ],
            'status_sertifikasi' => [
                'required',
                'string',
                'max:100'
            ],      
            'jabatan_struktural' => [
                'required',
                'string',
                'max:100'
            ],
        ], [
            'user_id.required' => 'Akun user wajib dipilih.',
            'user_id.exists'   => 'Akun user tidak ditemukan.',
            'user_id.unique'   => 'Akun user ini sudah terdaftar sebagai data guru.',
            'nip.unique'       => 'Nomor Induk Pegawai (NIP) sudah terdaftar.',
            'status_kepegawaian.required' => 'Status kepegawaian wajib diisi.',
            'status_sertifikasi.required' => 'Status sertifikasi wajib diisi.',
            'jabatan_struktural.required' => 'Jabatan struktural wajib diisi.',
        ]);

        // Perbaikan: Masukkan 'status_sertifikasi' ke dalam update
        $guru->update($request->only('user_id', 'nip', 'nama', 'status_kepegawaian', 'status_sertifikasi', 'jabatan_struktural'));

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    // Menghapus data guru
    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }

    // ==========================================
    // DASHBOARD GURU
    // ==========================================
    public function dashboardGuru()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->getAuthIdentifier())->first();

        $statusHariIni = 'Belum Absen';
        $totalHadirBulanIni = 0;

        if ($guru) {
            $tanggalHariIni = date('Y-m-d');
            $bulanIni = date('m');
            $tahunIni = date('Y');

            // Cek presensi hari ini
            $absenHariIni = PresensiGuru::where('guru_id', $guru->id)
                ->where('tanggal', $tanggalHariIni)
                ->first();

            if ($absenHariIni) {
                $statusHariIni = $absenHariIni->status_kehadiran; // Hadir, Izin, Sakit, atau Tidak Hadir
            }

            // Hitung akumulasi hadir di bulan ini
            $totalHadirBulanIni = PresensiGuru::where('guru_id', $guru->id)
                ->whereMonth('tanggal', $bulanIni)
                ->whereYear('tanggal', $tahunIni)
                ->where('status_kehadiran', 'Hadir')
                ->count();
        }

        return view('dashboard.guru', compact('user', 'guru', 'statusHariIni', 'totalHadirBulanIni'));
    }

    // ==========================================
    // MANAJEMEN PROFIL SAYA (UNTUK GURU YANG LOGIN)
    // ==========================================

    // Menampilkan halaman profil Guru
    public function editProfile()
    {
        $user = Auth::user();
        
        // Mengambil data guru berdasarkan relasi user_id dan primary key user yang login
        $userId = $user->getAuthIdentifier();
        $guru = Guru::where('user_id', $userId)->first();

        return view('profile.profile-guru', compact('user', 'guru'));
    }

    // Memperbarui email atau kata sandi Guru
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $userId = $user->getAuthIdentifier();
        $primaryKey = $user->getKeyName();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $userId . ',' . $primaryKey,
            'current_password' => ['required'],
            'password' => 'nullable|min:6|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi untuk konfirmasi perubahan.',
        ]);

        // Cek kecocokan password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        $user->email = $request->email;

        // Jika kolom password baru diisi, enkripsi dan perbarui
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('guru.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // ==========================================
    // PRESENSI GURU
    // ==========================================

    // Menampilkan halaman form presensi harian guru & filter tanggal
    public function showPresensiForm(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->getAuthIdentifier())->first();

        // Ambil tanggal dari input filter, default ke hari ini jika kosong
        $tanggalPilihan = $request->input('tanggal', date('Y-m-d'));

        $today = Carbon::now('Asia/Jakarta');
        $tanggalHariIni = $today->format('Y-m-d');

        if ($guru) {
            // Batas waktu presensi jam 15:00 WIB
            $jamBatas = Carbon::createFromTime(15, 0, 0, 'Asia/Jakarta');
            
            // Jika tanggal yang dibuka adalah hari ini, DAN waktu sekarang sudah lewat jam 15:00
            if ($tanggalPilihan === $tanggalHariIni && $today->greaterThan($jamBatas)) {
                // Cek apakah guru ini sudah punya data presensi hari ini
                $cekPresensi = PresensiGuru::where('guru_id', $guru->id)
                    ->where('tanggal', $tanggalHariIni)
                    ->first();

                // Jika belum ada sama sekali, otomatis buat status "Tidak Hadir"
                if (!$cekPresensi) {
                    PresensiGuru::create([
                        'guru_id' => $guru->id,
                        'tanggal' => $tanggalHariIni,
                        'status_kehadiran' => 'Tidak Hadir',
                    ]);
                }
            }

            // Ambil riwayat presensi guru berdasarkan tanggal pilihan
            $riwayatPresensi = PresensiGuru::where('guru_id', $guru->id)
                ->where('tanggal', $tanggalPilihan)
                ->first();
        } else {
            $riwayatPresensi = null;
        }

        return view('presensi.presensi-guru', compact('user', 'guru', 'riwayatPresensi', 'tanggalPilihan'));
    }

    // Menyimpan data presensi harian guru
    public function storePresensi(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->getAuthIdentifier())->first();

        if (!$guru) {
            return back()->withErrors(['error' => 'Data guru tidak ditemukan untuk akun ini. Harap hubungi Admin.']);
        }

        $today = Carbon::now('Asia/Jakarta');
        $tanggalHariIni = $today->format('Y-m-d');
        $hariNama = $today->format('l'); // Sunday, Monday, etc.

        // Validasi Jam Operasional (07:00 - 15:00)
        $jamMulai = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta');
        $jamSelesai = Carbon::createFromTime(15, 0, 0, 'Asia/Jakarta');

        if ($today->lt($jamMulai)) {
            return back()->withErrors(['error' => 'Jendela presensi belum dibuka. Presensi dimulai pukul 07:00 WIB.']);
        }

        if ($today->gt($jamSelesai)) {
            // Otomatis ubah status menjadi Tidak Hadir jika mencoba absen lewat jam 15:00
            PresensiGuru::updateOrCreate(
                [
                    'guru_id' => $guru->id,
                    'tanggal' => $tanggalHariIni,
                ],
                [
                    'status_kehadiran' => 'Tidak Hadir'
                ]
            );
            return back()->withErrors(['error' => 'Waktu presensi telah ditutup (lewat pukul 15:00 WIB). Status Anda otomatis tercatat sebagai Tidak Hadir dan tidak dapat melakukan presensi lagi.']);
        }

        // 1. Validasi Hari Minggu (Libur Mingguan)
        if ($hariNama === 'Sunday') {
            return back()->withErrors(['error' => 'Hari Minggu sekolah libur. Presensi hanya berlaku dari hari Senin sampai Sabtu.']);
        }

        // 2. Validasi Tanggal Merah Nasional (Menggunakan API Hari Libur Indonesia)
        try {
            $response = Http::timeout(3)->get("https://api-harilibur.vercel.app/api?year=" . $today->year);
            if ($response->successful()) {
                $liburNasional = $response->json();
                foreach ($liburNasional as $libur) {
                    if ($libur['holiday_date'] === $tanggalHariIni && ($libur['is_national_holiday'] ?? true)) {
                        return back()->withErrors(['error' => 'Hari ini adalah tanggal merah / libur nasional (' . $libur['holiday_name'] . '). Presensi dinonaktifkan.']);
                    }
                }
            }
        } catch (\Exception $e) {
            // Jika koneksi internet/API bermasalah, lewati pengecekan API agar sistem tetap bisa diakses secara lokal
        }

        // 3. Cek apakah sudah ada catatan presensi hari ini (baik Hadir, Izin, Sakit, maupun Tidak Hadir)
        $sudahAbsen = PresensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', $tanggalHariIni)
            ->first();

        if ($sudahAbsen) {
            return back()->withErrors(['error' => 'Anda sudah memiliki catatan presensi untuk hari ini (' . $sudahAbsen->status_kehadiran . '). Presensi tidak dapat diubah kembali.']);
        }

        $request->validate([
            'status_kehadiran' => 'required|in:Hadir,Izin,Sakit,Tidak Hadir',
        ], [
            'status_kehadiran.required' => 'Status kehadiran wajib dipilih.',
            'status_kehadiran.in'      => 'Pilihan status kehadiran tidak valid.',
        ]);

        // Simpan / Perbarui data presensi ke database
        PresensiGuru::updateOrCreate(
            [
                'guru_id' => $guru->id,
                'tanggal' => $tanggalHariIni,
            ],
            [
                'status_kehadiran' => $request->status_kehadiran,
            ]
        );

        return redirect()->route('guru.presensi')->with('success', 'Presensi berhasil dikirim!');
    }

    public function editPresensi(PresensiGuru $presensiGuru)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->getAuthIdentifier())->first();

        // Pastikan guru yang edit adalah pemilik data presensi tersebut
        if (!$guru || $presensiGuru->guru_id !== $guru->id) {
            return redirect()->route('guru.presensi')->withErrors(['error' => 'Akses ditolak.']);
        }

        return view('presensi.edit-presensi-guru', compact('presensiGuru'));
    }

    // Menyimpan pembaruan presensi
    public function updatePresensi(Request $request, PresensiGuru $presensiGuru)
    {
        $request->validate([
            'status_kehadiran' => 'required|in:Hadir,Izin,Sakit,Tidak Hadir',
        ], [
            'status_kehadiran.required' => 'Status kehadiran wajib dipilih.',
            'status_kehadiran.in'      => 'Pilihan status kehadiran tidak valid.',
        ]);

        $presensiGuru->update([
            'status_kehadiran' => $request->status_keyhadriran ?? $request->status_kehadiran,
        ]);

        return redirect()->route('guru.presensi')->with('success', 'Presensi berhasil diperbarui!');
    }
}