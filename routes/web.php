<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\WakaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RekapPresensiController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BebanMengajarController;
use App\Http\Controllers\SlotWaktuController;
use App\Http\Controllers\MappingPengampuController;
use App\Http\Controllers\JadwalPelajaranController;



// Route Login
Route::get('/', [AuthController::class, 'showLoginForm']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Lupa & Reset Password via Email
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Route Dashboard Berdasarkan Role (Harus Login Dulu)
Route::middleware(['auth'])->group(function () {

    // Dashboard Waka
    Route::get('/dashboard/waka', [WakaController::class, 'index'])->name('dashboard.waka');

    // Master Data: Mata Pelajaran
    Route::get('/mapel', [MataPelajaranController::class, 'index'])->name('mapel.index');
    Route::get('/mapel/tambah', [MataPelajaranController::class, 'create'])->name('mapel.create');
    Route::post('/mapel', [MataPelajaranController::class, 'store'])->name('mapel.store');
    Route::get('/mapel/{mapel}/edit', [MataPelajaranController::class, 'edit'])->name('mapel.edit');
    Route::put('/mapel/{mapel}', [MataPelajaranController::class, 'update'])->name('mapel.update');
    Route::delete('/mapel/{mapel}', [MataPelajaranController::class, 'destroy'])->name('mapel.destroy');

    // Master Data: Kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/tambah', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    
    // Rute untuk menampilkan data siswa berdasarkan ID kelas dari menu kelas
    Route::get('/kelas/{id_kelas}/siswa', [SiswaController::class, 'indexByKelas'])->name('kelas.siswa');

    Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    Route::patch('/kelas/{kelas}/toggle-status', [KelasController::class, 'toggleStatus'])->name('kelas.toggle-status');

    // ==========================================
    // ROUTE SISWA
    // ==========================================
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/kelas/{id_kelas}', [SiswaController::class, 'indexByKelas'])->name('siswa.by-kelas');
    
    // Route Template & Import
    Route::get('/siswa/template', [SiswaController::class, 'downloadTemplate'])->name('siswa.template');
    Route::get('/siswa/import/{id}', [SiswaController::class, 'import'])->name('siswa.import');
    Route::post('/siswa/import/{id}', [SiswaController::class, 'storeImport'])->name('siswa.storeImport');

    // Resource route CRUD Siswa (kecuali index dan show)
    Route::resource('siswa', SiswaController::class)->except(['index', 'show']);

    // Master Data: Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/tambah', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');

    // Dashboard & Manajemen User khusus Admin
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    Route::get('/admin/users/tambah', [AdminController::class, 'usersCreate'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::post('/admin/users/{id}/reset-password', [AdminController::class, 'resetPassword'])->name('admin.users.reset');
    Route::patch('/admin/users/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.users.toggle');
    
    // PROFIL ADMIN & PASSWORD
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('/profile/admin', [ProfileController::class, 'editAdminProfile'])->name('profile.edit');
    Route::put('/profile/admin', [ProfileController::class, 'updateAdminProfile'])->name('profile.update');
    
    // KEPALA SEKOLAH
    Route::get('/dashboard/kepala-sekolah', [AuthController::class, 'dashboardKepalaSekolah'])->name('dashboard.kepala-sekolah');
    Route::get('/kepala-sekolah/profile', [KepalaSekolahController::class, 'editProfile'])->name('kepala-sekolah.profile');
    Route::put('/kepala-sekolah/profile', [KepalaSekolahController::class, 'updateProfile'])->name('kepala-sekolah.profile.update');
    
    // KEPALA-SEKOLAH BAGIAN SIDE BAR
    Route::get('/kepala-sekolah/guru', [KepalaSekolahController::class, 'indexGuru'])->name('kepala-sekolah.guru');
    Route::get('/kepala-sekolah/data-kelas', [KepalaSekolahController::class, 'indexKelas'])->name('kepala-sekolah.kelas');
    Route::get('/kepala-sekolah/mata-pelajaran', [KepalaSekolahController::class, 'indexMapel'])->name('kepala-sekolah.mapel');
    Route::get('/kepala-sekolah/pengguna-sistem', [KepalaSekolahController::class, 'indexUser'])->name('kepala-sekolah.user');

    // GURU PROFILE
    Route::get('/guru/profile', [GuruController::class, 'editProfile'])->name('guru.profile');
    Route::put('/guru/profile', [GuruController::class, 'updateProfile'])->name('guru.profile.update');

    // WAKA KURIKULUM (PROFIL)
    Route::get('/waka/profile', [WakaController::class, 'editProfile'])->name('waka.profile');
    Route::put('/waka/profile', [WakaController::class, 'updateProfile'])->name('waka.profile.update');

    // PRESENSI GURU & DASHBOARD GURU
    Route::get('/dashboard/guru', [GuruController::class, 'dashboardGuru'])->name('dashboard.guru');
    Route::patch('/dashboard/guru/password', [AuthController::class, 'updatePasswordGuru'])->name('guru.password.update');

    // GURU PRESENSI
    Route::get('/guru/presensi', [GuruController::class, 'showPresensiForm'])->name('guru.presensi');
    Route::post('/guru/presensi', [GuruController::class, 'storePresensi'])->name('guru.presensi.store');

    Route::get('/guru/presensi/{presensiGuru}/edit', [GuruController::class, 'editPresensi'])->name('guru.presensi.edit');
    Route::put('/guru/presensi/{presensiGuru}', [GuruController::class, 'updatePresensi'])->name('guru.presensi.update');

    Route::get('/guru/rekap-presensi', [RekapPresensiController::class, 'index'])->name('presensi.rekap');

    // NAIK KELAS 
    Route::get('/siswa/naik-kelas', [SiswaController::class, 'naikKelasIndex'])->name('siswa.naik-kelas');
    Route::post('/siswa/proses-naik-kelas', [SiswaController::class, 'prosesNaikKelas'])->name('siswa.proses-naik-kelas');

    // ALUMNI 
    Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
    Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');
    Route::delete('/alumni/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');

    // BEBAN MENGAJAR
    Route::get('/beban-mengajar', [BebanMengajarController::class, 'index'])->name('beban-mengajar.index');
    Route::get('/beban-mengajar/tambah', [BebanMengajarController::class, 'create'])->name('beban-mengajar.create');
    Route::post('/beban-mengajar', [BebanMengajarController::class, 'store'])->name('beban-mengajar.store');
    Route::get('/beban-mengajar/{bebanMengajar}/edit', [BebanMengajarController::class, 'edit'])->name('beban-mengajar.edit');
    Route::put('/beban-mengajar/{bebanMengajar}', [BebanMengajarController::class, 'update'])->name('beban-mengajar.update');
    Route::delete('/beban-mengajar/{bebanMengajar}', [BebanMengajarController::class, 'destroy'])->name('beban-mengajar.destroy');

    // SLOT WAKTU
    Route::get('/slot-waktu', [SlotWaktuController::class, 'index'])->name('slot-waktu.index');
    Route::get('/slot-waktu/create', [SlotWaktuController::class, 'create'])->name('slot-waktu.create');
    Route::post('/slot-waktu', [SlotWaktuController::class, 'store'])->name('slot-waktu.store');
    Route::get('/slot-waktu/{slotWaktu}/edit', [SlotWaktuController::class, 'edit'])->name('slot-waktu.edit');
    Route::put('/slot-waktu/{slotWaktu}', [SlotWaktuController::class, 'update'])->name('slot-waktu.update');
    Route::delete('/slot-waktu/{slotWaktu}', [SlotWaktuController::class, 'destroy'])->name('slot-waktu.destroy');

    // PENGAMPU 
    Route::resource('mapping', MappingPengampuController::class);


    // NAMA FILENYA BUAT JADWAL
Route::get('/jadwal', [JadwalPelajaranController::class, 'index'])->name('jadwal.index');

// 2. Ini khusus untuk halaman Matriks Grid Jadwal
Route::get('/jadwal-pelajaran/show', [JadwalPelajaranController::class, 'show'])->name('jadwal-pelajaran.show');

// 3. Proses generate data (biasanya method POST dari tombol form di halaman modul)
Route::post('/jadwal-pelajaran/generate', [JadwalPelajaranController::class, 'generate'])->name('jadwal.generate'); 
});