<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR KIRI GURU -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100">
                        G
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-gray-400 truncate max-w-[130px]">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Sidebar -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Menu Aktif (Dashboard) -->
                            <a href="{{ route('dashboard.guru') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('guru.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <!-- Jadwal Pelajaran -->
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Aktivitas Mengajar</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.presensi') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Presensi Guru</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Presensi Siswa</span>
                            </a>
                            <a href="{{ route('presensi.rekap') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                <span>Rekap Bulanan</span>
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

        <!-- KONTEN UTAMA -->
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-5xl mx-auto">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-gray-200">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard Guru</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Kelola absensi kehadiran, rekapitulasi, dan jadwal mengajar Anda secara terpusat.</p>
                    </div>
                </div>

                <!-- Notifikasi -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-medium flex items-center gap-2 shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

<!-- Statistik Ringkasan -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
    <div class="bg-white border border-gray-200 p-5 rounded-3xl shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Kehadiran Hari Ini</p>
        <h3 class="text-lg font-extrabold text-indigo-600 mt-2">
            @if($statusHariIni == 'Belum Absen')
                <span class="text-amber-600">Belum Absen</span>
            @else
                <span class="text-emerald-600">{{ $statusHariIni }}</span>
            @endif
        </h3>
        <p class="text-[11px] text-gray-400 mt-1">Jendela waktu: 07:00 - 15:00 WIB</p>
    </div>
    
    <div class="bg-white border border-gray-200 p-5 rounded-3xl shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kehadiran Bulan Ini</p>
        <h3 class="text-2xl font-extrabold text-gray-900 mt-2">{{ $totalHadirBulanIni }} <span class="text-sm font-normal text-gray-500">Hari</span></h3>
        <p class="text-[11px] text-gray-400 mt-1">Akumulasi hadir tepat waktu</p>
    </div>
    
    <div class="bg-white border border-gray-200 p-5 rounded-3xl shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jadwal Hari Ini</p>
        <h3 class="text-2xl font-extrabold text-gray-900 mt-2">-</h3>
        <p class="text-[11px] text-gray-400 mt-1">Kelas yang diampu</p>
    </div>
</div>

                <!-- Aksi Cepat / Menu Utama -->
                <div class="mb-8">
                    <h3 class="font-bold text-sm text-gray-900 mb-4">Aksi Cepat & Menu Utama</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        
                        <a href="{{ route('guru.presensi') }}" class="bg-white hover:bg-gray-50 border border-gray-200 p-5 rounded-3xl transition group shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider mb-1">Absensi</div>
                                <h4 class="font-bold text-gray-900 text-sm">Presensi Guru</h4>
                                <p class="text-xs text-gray-500 mt-2">Lakukan absensi kehadiran mengajar harian Anda.</p>
                            </div>
                            <span class="text-xs font-semibold text-indigo-600 mt-4 group-hover:translate-x-1 transition inline-block">Absen Sekarang &rarr;</span>
                        </a>

                        <a href="{{ route('presensi.rekap') }}" class="bg-white hover:bg-gray-50 border border-gray-200 p-5 rounded-3xl transition group shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider mb-1">Statistik</div>
                                <h4 class="font-bold text-gray-900 text-sm">Rekap Presensi Bulanan</h4>
                                <p class="text-xs text-gray-500 mt-2">Tinjau hasil rekapitulasi riwayat kehadiran per bulan.</p>
                            </div>
                            <span class="text-xs font-semibold text-indigo-600 mt-4 group-hover:translate-x-1 transition inline-block">Lihat Rekap &rarr;</span>
                        </a>

                        <a href="#" class="bg-white hover:bg-gray-50 border border-gray-200 p-5 rounded-3xl transition group shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider mb-1">Akademik</div>
                                <h4 class="font-bold text-gray-900 text-sm">Kelola Presensi Siswa</h4>
                                <p class="text-xs text-gray-500 mt-2">Input dan perbarui absensi harian peserta didik.</p>
                            </div>
                            <span class="text-xs font-semibold text-indigo-600 mt-4 group-hover:translate-x-1 transition inline-block">Buka Presensi &rarr;</span>
                        </a>

                        <a href="#" class="bg-white hover:bg-gray-50 border border-gray-200 p-5 rounded-3xl transition group shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider mb-1">Jadwal</div>
                                <h4 class="font-bold text-gray-900 text-sm">Lihat Jadwal Mengajar</h4>
                                <p class="text-xs text-gray-500 mt-2">Daftar jam dan kelas mata pelajaran yang diampu.</p>
                            </div>
                            <span class="text-xs font-semibold text-indigo-600 mt-4 group-hover:translate-x-1 transition inline-block">Lihat Jadwal &rarr;</span>
                        </a>

                    </div>
                </div>

            </div>
        </main>

    </div>

</body>
</html>