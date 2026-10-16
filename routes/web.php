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
use App\Http\Controllers\BebanMengajarController;
use App\Http\Controllers\SlotWaktuController;
use App\Http\Controllers\MappingPengampuController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\PresensiSiswaController;

/*
|--------------------------------------------------------------------------
| LOGIN, LOGOUT, DAN RESET PASSWORD
|--------------------------------------------------------------------------
*/

// Menampilkan halaman login melalui URL utama.
Route::get('/', [AuthController::class, 'showLoginForm']);

// Menampilkan halaman login melalui /login.
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

// Memproses email dan password yang dikirim dari formulir login.
Route::post('/login', [AuthController::class, 'login']);

// Mengakhiri sesi login pengguna.
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Menampilkan formulir permintaan tautan reset password.
Route::get('/forgot-password', [
    ForgotPasswordController::class,
    'showLinkRequestForm'
])->name('password.request');

// Mengirim tautan reset password melalui email.
Route::post('/forgot-password', [
    ForgotPasswordController::class,
    'sendResetLinkEmail'
])->name('password.email');

// Menampilkan formulir untuk membuat password baru.
Route::get('/reset-password/{token}', [
    ForgotPasswordController::class,
    'showResetForm'
])->name('password.reset');

// Memproses perubahan password dari formulir reset password.
Route::post('/reset-password', [
    ForgotPasswordController::class,
    'reset'
])->name('password.update');


/*
|--------------------------------------------------------------------------
| ROUTE YANG WAJIB LOGIN
|--------------------------------------------------------------------------
|
| Middleware auth memastikan pengguna sudah login.
| Middleware role membatasi akses berdasarkan role pengguna.
|
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD BERDASARKAN ROLE
    |--------------------------------------------------------------------------
    */

    // Dashboard Admin hanya untuk role admin.
    Route::get('/dashboard/admin', [
        AdminController::class,
        'index'
    ])->middleware('role:admin')
      ->name('dashboard.admin');

    // Dashboard Waka hanya untuk role waka.
    Route::get('/dashboard/waka', [
        WakaController::class,
        'index'
    ])->middleware('role:waka')
      ->name('dashboard.waka');

    // Dashboard Kepala Sekolah menggunakan role kepsek di database.
    // Middleware menormalkan kepsek menjadi kepala_sekolah.
    Route::get('/dashboard/kepala-sekolah', [
        AuthController::class,
        'dashboardKepalaSekolah'
    ])->middleware('role:kepala_sekolah')
      ->name('dashboard.kepala-sekolah');

    // Dashboard Guru hanya untuk role guru.
    Route::get('/dashboard/guru', [
        GuruController::class,
        'dashboardGuru'
    ])->middleware('role:guru')
      ->name('dashboard.guru');


    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN USER - ADMIN
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar pengguna sistem.
    Route::get('/admin/users', [
        AdminController::class,
        'usersIndex'
    ])->middleware('role:admin')
      ->name('admin.users.index');

    // Menampilkan formulir tambah pengguna.
    Route::get('/admin/users/tambah', [
        AdminController::class,
        'usersCreate'
    ])->middleware('role:admin')
      ->name('admin.users.create');

    // Menyimpan pengguna baru.
    Route::post('/admin/users', [
        AdminController::class,
        'storeUser'
    ])->middleware('role:admin')
      ->name('admin.users.store');

    // Mengatur ulang password pengguna.
    Route::post('/admin/users/{id}/reset-password', [
        AdminController::class,
        'resetPassword'
    ])->middleware('role:admin')
      ->name('admin.users.reset');

    // Mengaktifkan atau menonaktifkan akun pengguna.
    Route::patch('/admin/users/{id}/toggle-status', [
        AdminController::class,
        'toggleStatus'
    ])->middleware('role:admin')
      ->name('admin.users.toggle');


    /*
    |--------------------------------------------------------------------------
    | PROFIL ADMIN
    |--------------------------------------------------------------------------
    */

    // Menampilkan formulir ubah password profil Admin.
    Route::get('/profile/password', [
        ProfileController::class,
        'editPassword'
    ])->middleware('role:admin')
      ->name('password.edit');

    // Memproses perubahan password profil Admin.
    // Nama route dibuat berbeda dari password.update untuk reset password.
    Route::put('/profile/password', [
        ProfileController::class,
        'updatePassword'
    ])->middleware('role:admin')
      ->name('profile.password.update');

    // Menampilkan formulir profil Admin.
    Route::get('/profile/admin', [
        ProfileController::class,
        'editAdminProfile'
    ])->middleware('role:admin')
      ->name('profile.edit');

    // Menyimpan perubahan profil Admin.
    Route::put('/profile/admin', [
        ProfileController::class,
        'updateAdminProfile'
    ])->middleware('role:admin')
      ->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | PROFIL KEPALA SEKOLAH
    |--------------------------------------------------------------------------
    */

    // Menampilkan profil Kepala Sekolah.
    Route::get('/kepala-sekolah/profile', [
        KepalaSekolahController::class,
        'editProfile'
    ])->middleware('role:kepala_sekolah')
      ->name('kepala-sekolah.profile');

    // Menyimpan perubahan profil Kepala Sekolah.
    Route::put('/kepala-sekolah/profile', [
        KepalaSekolahController::class,
        'updateProfile'
    ])->middleware('role:kepala_sekolah')
      ->name('kepala-sekolah.profile.update');

    // Menampilkan data guru kepada Kepala Sekolah.
    Route::get('/kepala-sekolah/guru', [
        KepalaSekolahController::class,
        'indexGuru'
    ])->middleware('role:kepala_sekolah')
      ->name('kepala-sekolah.guru');

    // Menampilkan data kelas kepada Kepala Sekolah.
    Route::get('/kepala-sekolah/data-kelas', [
        KepalaSekolahController::class,
        'indexKelas'
    ])->middleware('role:kepala_sekolah')
      ->name('kepala-sekolah.kelas');

    // Menampilkan data mata pelajaran kepada Kepala Sekolah.
    Route::get('/kepala-sekolah/mata-pelajaran', [
        KepalaSekolahController::class,
        'indexMapel'
    ])->middleware('role:kepala_sekolah')
      ->name('kepala-sekolah.mapel');

    // Menampilkan data pengguna sistem kepada Kepala Sekolah.
    Route::get('/kepala-sekolah/pengguna-sistem', [
        KepalaSekolahController::class,
        'indexUser'
    ])->middleware('role:kepala_sekolah')
      ->name('kepala-sekolah.user');

    // Menampilkan jadwal pelajaran untuk Kepala Sekolah.
    Route::get('/kepala-sekolah/melihat-jadwal', [
        KepalaSekolahController::class,
        'melihatJadwal'
    ])->middleware('role:kepala_sekolah')
      ->name('kepala-sekolah.jadwal.cetak');

    // Menampilkan rekap presensi untuk Kepala Sekolah.
    Route::get('/kepala-sekolah/melihat-rekap', [
        KepalaSekolahController::class,
        'melihatRekapPresensi'
    ])->middleware('role:kepala_sekolah')
      ->name('kepala-sekolah.presensi');

      // KEPALA SEKOLAH MELIHAT REKAP PRESENSI
    Route::get(
        '/kepala-sekolah/rekap-presensi',
        [KepalaSekolahController::class, 'melihatRekapPresensi']
    )->name('kepala-sekolah.rekap-presensi');

// Menampilkan rekap presensi siswa dan guru untuk Kepala Sekolah.
Route::get('/kepala-sekolah/melihat-rekap', [
    KepalaSekolahController::class,
    'melihatRekapPresensi'
])->middleware('role:kepala_sekolah')
  ->name('kepala-sekolah.presensi');

// Menampilkan rekap presensi guru.
Route::get('/kepala-sekolah/rekap-guru', [
    KepalaSekolahController::class,
    'melihatRekapGuru'
])->middleware('role:kepala_sekolah')
  ->name('kepala-sekolah.rekap-guru');
    /*
    |--------------------------------------------------------------------------
    | PROFIL WAKA
    |--------------------------------------------------------------------------
    */

    // Menampilkan profil Waka.
    Route::get('/waka/profile', [
        WakaController::class,
        'editProfile'
    ])->middleware('role:waka')
      ->name('waka.profile');

    // Menyimpan perubahan profil Waka.
    Route::put('/waka/profile', [
        WakaController::class,
        'updateProfile'
    ])->middleware('role:waka')
      ->name('waka.profile.update');


    /*
    |--------------------------------------------------------------------------
    | PROFIL DAN PASSWORD GURU
    |--------------------------------------------------------------------------
    */

    // Menampilkan profil Guru.
    Route::get('/guru/profile', [
        GuruController::class,
        'editProfile'
    ])->middleware('role:guru')
      ->name('guru.profile');

    // Menyimpan perubahan profil Guru.
    Route::put('/guru/profile', [
        GuruController::class,
        'updateProfile'
    ])->middleware('role:guru')
      ->name('guru.profile.update');

    // Memproses perubahan password Guru.
    Route::patch('/dashboard/guru/password', [
        AuthController::class,
        'updatePasswordGuru'
    ])->middleware('role:guru')
      ->name('guru.password.update');


    /*
    |--------------------------------------------------------------------------
    | MASTER DATA MATA PELAJARAN
    |--------------------------------------------------------------------------
    |
    | Sementara hanya memakai auth agar akses yang sudah berjalan
    | tidak berubah sebelum kewenangan Admin dan Waka dipastikan.
    */

    // Menampilkan daftar mata pelajaran.
    Route::get('/mapel', [
        MataPelajaranController::class,
        'index'
    ])->name('mapel.index');

    // Menampilkan formulir tambah mata pelajaran.
    Route::get('/mapel/tambah', [
        MataPelajaranController::class,
        'create'
    ])->name('mapel.create');

    // Menyimpan mata pelajaran baru.
    Route::post('/mapel', [
        MataPelajaranController::class,
        'store'
    ])->name('mapel.store');

    // Menampilkan formulir edit mata pelajaran.
    Route::get('/mapel/{mapel}/edit', [
        MataPelajaranController::class,
        'edit'
    ])->name('mapel.edit');

    // Memperbarui data mata pelajaran.
    Route::put('/mapel/{mapel}', [
        MataPelajaranController::class,
        'update'
    ])->name('mapel.update');

    // Menghapus mata pelajaran.
    Route::delete('/mapel/{mapel}', [
        MataPelajaranController::class,
        'destroy'
    ])->name('mapel.destroy');


    /*
    |--------------------------------------------------------------------------
    | MASTER DATA KELAS
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar kelas.
    Route::get('/kelas', [
        KelasController::class,
        'index'
    ])->name('kelas.index');

    // Menampilkan formulir tambah kelas.
    Route::get('/kelas/tambah', [
        KelasController::class,
        'create'
    ])->name('kelas.create');

    // Menyimpan kelas baru.
    Route::post('/kelas', [
        KelasController::class,
        'store'
    ])->name('kelas.store');

    // Menampilkan siswa dari kelas tertentu.
    Route::get('/kelas/{id_kelas}/siswa', [
        SiswaController::class,
        'indexByKelas'
    ])->name('kelas.siswa');

    // Menampilkan formulir edit kelas.
    Route::get('/kelas/{kelas}/edit', [
        KelasController::class,
        'edit'
    ])->name('kelas.edit');

    // Memperbarui data kelas.
    Route::put('/kelas/{kelas}', [
        KelasController::class,
        'update'
    ])->name('kelas.update');

    // Menghapus kelas.
    Route::delete('/kelas/{kelas}', [
        KelasController::class,
        'destroy'
    ])->name('kelas.destroy');

    // Mengaktifkan atau menonaktifkan kelas.
    Route::patch('/kelas/{kelas}/toggle-status', [
        KelasController::class,
        'toggleStatus'
    ])->name('kelas.toggle-status');


    /*
    |--------------------------------------------------------------------------
    | MASTER DATA SISWA
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar siswa.
    Route::get('/siswa', [
        SiswaController::class,
        'index'
    ])->name('siswa.index');

    // Menampilkan siswa berdasarkan kelas.
    Route::get('/siswa/kelas/{id_kelas}', [
        SiswaController::class,
        'indexByKelas'
    ])->name('siswa.by-kelas');

    // Mengunduh template impor siswa.
    Route::get('/siswa/template', [
        SiswaController::class,
        'downloadTemplate'
    ])->name('siswa.template');

    // Menampilkan halaman impor siswa.
    Route::get('/siswa/import/{id}', [
        SiswaController::class,
        'import'
    ])->name('siswa.import');

    // Memproses impor siswa.
    Route::post('/siswa/import/{id}', [
        SiswaController::class,
        'storeImport'
    ])->name('siswa.storeImport');

    // CRUD siswa selain index dan show.
    Route::resource('siswa', SiswaController::class)
        ->except(['index', 'show']);

    // Memproses kenaikan kelas siswa.
    Route::get('/siswa/naik-kelas', [
        SiswaController::class,
        'naikKelasIndex'
    ])->name('siswa.naik-kelas');

    Route::post('/siswa/proses-naik-kelas', [
        SiswaController::class,
        'prosesNaikKelas'
    ])->name('siswa.proses-naik-kelas');


    /*
    |--------------------------------------------------------------------------
    | MASTER DATA GURU
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar guru.
    Route::get('/guru', [
        GuruController::class,
        'index'
    ])->name('guru.index');

    // Menampilkan formulir tambah guru.
    Route::get('/guru/tambah', [
        GuruController::class,
        'create'
    ])->name('guru.create');

    // Menyimpan data guru baru.
    Route::post('/guru', [
        GuruController::class,
        'store'
    ])->name('guru.store');

    // Menampilkan formulir edit guru.
    Route::get('/guru/{guru}/edit', [
        GuruController::class,
        'edit'
    ])->name('guru.edit');

    // Memperbarui data guru.
    Route::put('/guru/{guru}', [
        GuruController::class,
        'update'
    ])->name('guru.update');

    // Menghapus data guru.
    Route::delete('/guru/{guru}', [
        GuruController::class,
        'destroy'
    ])->name('guru.destroy');


    /*
    |--------------------------------------------------------------------------
    | PRESENSI GURU
    |--------------------------------------------------------------------------
    */

    // Menampilkan formulir presensi Guru.
    Route::get('/guru/presensi', [
        GuruController::class,
        'showPresensiForm'
    ])->middleware('role:guru')
      ->name('guru.presensi');

    // Menyimpan presensi Guru.
    Route::post('/guru/presensi', [
        GuruController::class,
        'storePresensi'
    ])->middleware('role:guru')
      ->name('guru.presensi.store');

    // Menampilkan formulir edit presensi Guru.
    Route::get('/guru/presensi/{presensiGuru}/edit', [
        GuruController::class,
        'editPresensi'
    ])->middleware('role:guru')
      ->name('guru.presensi.edit');

    // Memperbarui presensi Guru.
    Route::put('/guru/presensi/{presensiGuru}', [
        GuruController::class,
        'updatePresensi'
    ])->middleware('role:guru')
      ->name('guru.presensi.update');

    // Menampilkan rekap presensi Guru.
    Route::get('/guru/rekap-presensi', [
        RekapPresensiController::class,
        'index'
    ])->middleware('role:guru')
      ->name('presensi.rekap');


    /*
    |--------------------------------------------------------------------------
    | PRESENSI SISWA
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar presensi siswa untuk Guru.
    Route::get('/guru/presensi-siswa', [
        PresensiSiswaController::class,
        'index'
    ])->middleware('role:guru')
      ->name('guru.presensi-siswa.index');

    // Menampilkan formulir presensi siswa berdasarkan jadwal.
    Route::get('/guru/jadwal/{jadwalId}/presensi-siswa', [
        PresensiSiswaController::class,
        'create'
    ])->middleware('role:guru')
      ->name('guru.presensi-siswa.create');

    // Menyimpan presensi siswa berdasarkan jadwal.
    Route::post('/guru/jadwal/{jadwalId}/presensi-siswa', [
        PresensiSiswaController::class,
        'store'
    ])->middleware('role:guru')
      ->name('guru.presensi-siswa.store');

    // Menampilkan formulir edit presensi siswa.
    Route::get('/presensi-siswa/{presensiId}/edit', [
        PresensiSiswaController::class,
        'edit'
    ])->middleware('role:guru')
      ->name('presensi-siswa.edit');

    // Memperbarui presensi siswa.
    Route::put('/presensi-siswa/{presensiId}', [
        PresensiSiswaController::class,
        'update'
    ])->middleware('role:guru')
      ->name('presensi-siswa.update');


    /*
    |--------------------------------------------------------------------------
    | ALUMNI
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar alumni.
    Route::get('/alumni', [
        AlumniController::class,
        'index'
    ])->name('alumni.index');

    // Menampilkan detail alumni.
    Route::get('/alumni/{id}', [
        AlumniController::class,
        'show'
    ])->name('alumni.show');

    // Menghapus data alumni.
    Route::delete('/alumni/{id}', [
        AlumniController::class,
        'destroy'
    ])->name('alumni.destroy');


    /*
    |--------------------------------------------------------------------------
    | BEBAN MENGAJAR - WAKA
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar beban mengajar.
    Route::get('/beban-mengajar', [
        BebanMengajarController::class,
        'index'
    ])->middleware('role:waka')
      ->name('beban-mengajar.index');

    // Menampilkan formulir tambah beban mengajar.
    Route::get('/beban-mengajar/tambah', [
        BebanMengajarController::class,
        'create'
    ])->middleware('role:waka')
      ->name('beban-mengajar.create');

    // Menyimpan beban mengajar baru.
    Route::post('/beban-mengajar', [
        BebanMengajarController::class,
        'store'
    ])->middleware('role:waka')
      ->name('beban-mengajar.store');

    // Menampilkan formulir edit beban mengajar.
    Route::get('/beban-mengajar/{bebanMengajar}/edit', [
        BebanMengajarController::class,
        'edit'
    ])->middleware('role:waka')
      ->name('beban-mengajar.edit');

    // Memperbarui beban mengajar.
    Route::put('/beban-mengajar/{bebanMengajar}', [
        BebanMengajarController::class,
        'update'
    ])->middleware('role:waka')
      ->name('beban-mengajar.update');

    // Menghapus beban mengajar.
    Route::delete('/beban-mengajar/{bebanMengajar}', [
        BebanMengajarController::class,
        'destroy'
    ])->middleware('role:waka')
      ->name('beban-mengajar.destroy');


    /*
    |--------------------------------------------------------------------------
    | SLOT WAKTU - WAKA
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar slot waktu.
    Route::get('/slot-waktu', [
        SlotWaktuController::class,
        'index'
    ])->middleware('role:waka')
      ->name('slot-waktu.index');

    // Menampilkan formulir tambah slot waktu.
    Route::get('/slot-waktu/create', [
        SlotWaktuController::class,
        'create'
    ])->middleware('role:waka')
      ->name('slot-waktu.create');

    // Menyimpan slot waktu baru.
    Route::post('/slot-waktu', [
        SlotWaktuController::class,
        'store'
    ])->middleware('role:waka')
      ->name('slot-waktu.store');

    // Menampilkan formulir edit slot waktu.
    Route::get('/slot-waktu/{slotWaktu}/edit', [
        SlotWaktuController::class,
        'edit'
    ])->middleware('role:waka')
      ->name('slot-waktu.edit');

    // Memperbarui slot waktu.
    Route::put('/slot-waktu/{slotWaktu}', [
        SlotWaktuController::class,
        'update'
    ])->middleware('role:waka')
      ->name('slot-waktu.update');

    // Menghapus slot waktu.
    Route::delete('/slot-waktu/{slotWaktu}', [
        SlotWaktuController::class,
        'destroy'
    ])->middleware('role:waka')
      ->name('slot-waktu.destroy');


    /*
    |--------------------------------------------------------------------------
    | MAPPING PENGAMPU - WAKA
    |--------------------------------------------------------------------------
    */

    // CRUD mapping guru, mata pelajaran, dan kelas.
    Route::resource('mapping', MappingPengampuController::class)
        ->middleware('role:waka');


    /*
    |--------------------------------------------------------------------------
    | JADWAL PELAJARAN - WAKA
    |--------------------------------------------------------------------------
    */

    // Menampilkan halaman pengelolaan jadwal.
    Route::get('/jadwal', [
        JadwalPelajaranController::class,
        'index'
    ])->middleware('role:waka')
      ->name('jadwal.index');

    // Menampilkan data jadwal pelajaran.
    Route::get('/jadwal-pelajaran/show', [
        JadwalPelajaranController::class,
        'show'
    ])->middleware('role:waka')
      ->name('jadwal-pelajaran.show');

    // Menjalankan proses generate jadwal.
    Route::post('/jadwal-pelajaran/generate', [
        JadwalPelajaranController::class,
        'generate'
    ])->middleware('role:waka')
      ->name('jadwal.generate');

    // Menukar posisi jadwal pelajaran.
    Route::post('/jadwal-pelajaran/tukar', [
        JadwalPelajaranController::class,
        'tukarJadwal'
    ])->middleware('role:waka')
      ->name('jadwal-pelajaran.tukar');


    /*
    |--------------------------------------------------------------------------
    | JADWAL MENGAJAR GURU
    |--------------------------------------------------------------------------
    */

    // Menampilkan jadwal mengajar milik Guru yang login.
    Route::get('/guru/jadwal-mengajar', [
        GuruController::class,
        'jadwalMengajar'
    ])->middleware('role:guru')
      ->name('guru.jadwal');

});
