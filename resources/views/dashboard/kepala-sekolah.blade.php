<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Sekolah - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- 1. SIDEBAR KIRI KEPALA SEKOLAH -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-emerald-100">
                        K
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-indigo-600 font-semibold truncate max-w-[130px]">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Kepala Sekolah -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Dashboard Utama -->
                            <a href="{{ route('dashboard.kepala-sekolah') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-xs font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard Utama</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('kepala-sekolah.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Menu Rincian Monitoring di Sidebar (Ikon disesuaikan mirip referensi) -->
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Rincian Data</p>
                        <nav class="space-y-1">
                            <!-- Link ke Data Guru -->
                            <a href="{{ route('kepala-sekolah.guru') }}" class="flex items-center justify-between px-3.5 py-2.5 text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl text-xs font-medium transition group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    <span class="group-hover:font-semibold">Total Guru</span>
                                </span>
                                <span class="font-bold text-gray-900 bg-gray-100 group-hover:bg-emerald-100 group-hover:text-emerald-800 px-2 py-0.5 rounded-lg transition">{{ $jumlahGuru }}</span>
                            </a>

                            <!-- Link ke Data Kelas -->
                            <a href="{{ route('kepala-sekolah.kelas') }}" class="flex items-center justify-between px-3.5 py-2.5 text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-xl text-xs font-medium transition group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    <span class="group-hover:font-semibold">Total Kelas</span>
                                </span>
                                <span class="font-bold text-gray-900 bg-gray-100 group-hover:bg-blue-100 group-hover:text-blue-800 px-2 py-0.5 rounded-lg transition">{{ $jumlahKelas }}</span>
                            </a>

                            <!-- Link ke Data Mata Pelajaran -->
                            <a href="{{ route('kepala-sekolah.mapel') }}" class="flex items-center justify-between px-3.5 py-2.5 text-gray-600 hover:bg-amber-50 hover:text-amber-700 rounded-xl text-xs font-medium transition group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    <span class="group-hover:font-semibold">Mata Pelajaran</span>
                                </span>
                                <span class="font-bold text-gray-900 bg-gray-100 group-hover:bg-amber-100 group-hover:text-amber-800 px-2 py-0.5 rounded-lg transition">{{ $jumlahMapel }}</span>
                            </a>

                            <!-- Link ke Pengguna Sistem -->
                            <a href="{{ route('kepala-sekolah.user') }}" class="flex items-center justify-between px-3.5 py-2.5 text-gray-600 hover:bg-violet-50 hover:text-violet-700 rounded-xl text-xs font-medium transition group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    <span class="group-hover:font-semibold">Pengguna Sistem</span>
                                </span>
                                <span class="font-bold text-gray-900 bg-gray-100 group-hover:bg-violet-100 group-hover:text-violet-800 px-2 py-0.5 rounded-lg transition">{{ $jumlahUser }}</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Logout -->
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- 2. KONTEN UTAMA KEPALA SEKOLAH -->
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-5xl mx-auto">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-gray-200">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard Kepala Sekolah</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Pusat monitoring data akademik, guru, dan rekapitulasi sekolah.</p>
                    </div>
                </div>

                <!-- Notifikasi Sukses / Error -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-medium flex items-center gap-2 shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Statistik Cards dengan Aksen Warna Pinggir -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Card 1: Total Guru (Emerald) -->
                    <div class="bg-white border border-emerald-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-emerald-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Guru</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-2">{{ $jumlahGuru }}</h3>
                    </div>
                    
                    <!-- Card 2: Total Kelas (Blue) -->
                    <div class="bg-white border border-blue-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-blue-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Kelas</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-2">{{ $jumlahKelas }}</h3>
                    </div>
                    
                    <!-- Card 3: Mata Pelajaran (Amber/Orange) -->
                    <div class="bg-white border border-amber-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-amber-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mata Pelajaran</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-2">{{ $jumlahMapel }}</h3>
                    </div>
                    
                    <!-- Card 4: Pengguna Sistem (Violet/Purple) -->
                    <div class="bg-white border border-violet-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-violet-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pengguna Sistem</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-2">{{ $jumlahUser }}</h3>
                    </div>
                </div>

                <!-- Menu Laporan & Monitoring (Use Case Kepala Sekolah) -->
                <div class="mb-8">
                    <h3 class="font-bold text-sm text-gray-900 mb-4">Laporan & Monitoring Akademik</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        
                        <!-- Laporan Presensi -->
                        <a href="#" class="bg-white hover:bg-gray-50 border border-gray-200 p-5 rounded-3xl transition group shadow-sm hover:shadow-md hover:border-indigo-200">
                            <div class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider mb-1">Monitoring</div>
                            <h4 class="font-bold text-gray-900 text-sm">Melihat Laporan Presensi</h4>
                            <p class="text-xs text-gray-500 mt-2">Pantau data kehadiran siswa secara berkala.</p>
                        </a>

                        <!-- Cetak Laporan Presensi -->
                        <a href="#" class="bg-white hover:bg-gray-50 border border-gray-200 p-5 rounded-3xl transition group shadow-sm hover:shadow-md hover:border-blue-200">
                            <div class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mb-1">Dokumen</div>
                            <h4 class="font-bold text-gray-900 text-sm">Cetak Laporan Presensi</h4>
                            <p class="text-xs text-gray-500 mt-2">Unduh atau cetak rekap absensi format cetak.</p>
                        </a>

                        <!-- Cetak Hasil Jadwal -->
                        <a href="#" class="bg-white hover:bg-gray-50 border border-gray-200 p-5 rounded-3xl transition group shadow-sm hover:shadow-md hover:border-amber-200">
                            <div class="text-[10px] font-bold text-amber-600 uppercase tracking-wider mb-1">Dokumen</div>
                            <h4 class="font-bold text-gray-900 text-sm">Cetak Hasil Jadwal</h4>
                            <p class="text-xs text-gray-500 mt-2">Cetak dokumen jadwal pelajaran aktif sekolah.</p>
                        </a>

                        <!-- Rekap Kinerja Kehadiran Guru -->
                        <a href="#" class="bg-white hover:bg-gray-50 border border-gray-200 p-5 rounded-3xl transition group shadow-sm hover:shadow-md hover:border-emerald-200">
                            <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1">Evaluasi</div>
                            <h4 class="font-bold text-gray-900 text-sm">Rekap Kinerja Kehadiran Guru</h4>
                            <p class="text-xs text-gray-500 mt-2">Tinjau rekam jejak kedisiplinan mengajar guru.</p>
                        </a>

                    </div>
                </div>

            </div>
        </main>

    </div>

</body>
</html>