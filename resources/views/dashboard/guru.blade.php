<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - SMPN 4 Seruyan Tengah</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-smpn4.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-smpn4.png') }}">   
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Custom scrollbar halus */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased text-slate-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- ================= 1. SIDEBAR KIRI (DARK DEEP BLUE) ================= -->
        <aside class="w-64 bg-[#0F5EA3] text-white flex flex-col justify-between p-5 shrink-0 shadow-xl select-none overflow-y-auto">
            <div>
                <!-- Logo Sekolah -->
                <div class="flex items-center space-x-3 mb-8 px-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md p-1 shrink-0">
                        <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-xs font-bold tracking-wider text-white">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">{{ Auth::user()->email ?? 'guru@smpn4.sch.id' }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Sidebar -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Menu Aktif (Dashboard) -->
                            <a href="{{ route('dashboard.guru') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('guru.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <!-- Jadwal Pelajaran -->
                            <a href="{{ route('guru.jadwal') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Aktivitas Mengajar</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.presensi') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Presensi Guru</span>
                            </a>
                            <a href="{{ route('guru.presensi-siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Presensi Siswa</span>
                            </a>
                            <a href="{{ route('presensi.rekap') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                <span>Rekap Bulanan</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Logout -->
            <div class="pt-4 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-3.5 py-2.5 text-rose-200 hover:bg-rose-500/20 hover:text-rose-100 rounded-xl text-xs font-semibold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ================= 2. KONTEN UTAMA ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            <div class="w-full space-y-6">

                <!-- Header Atas -->
                <div class="pb-4 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Dashboard Guru</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Kelola absensi kehadiran, rekapitulasi, dan jadwal mengajar Anda secara terpusat.</p>
                    </div>
                </div>

                <!-- Notifikasi Sukses -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Statistik Ringkasan (Soft Colors) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-blue-50/60 border border-blue-100 p-6 rounded-2xl shadow-sm">
                        <p class="text-[11px] font-bold text-blue-600 uppercase tracking-wider">Status Kehadiran Hari Ini</p>
                        <h3 class="text-lg font-extrabold text-blue-900 mt-2">
                            @if($statusHariIni == 'Belum Absen')
                                <span class="text-amber-600">Belum Absen</span>
                            @else
                                <span class="text-emerald-600">{{ $statusHariIni }}</span>
                            @endif
                        </h3>
                        <p class="text-[11px] text-blue-400 mt-1 font-medium">Jendela waktu: 07:00 - 15:00 WIB</p>
                    </div>
                    
                    <div class="bg-emerald-50/60 border border-emerald-100 p-6 rounded-2xl shadow-sm">
                        <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Kehadiran Bulan Ini</p>
                        <h3 class="text-2xl font-extrabold text-emerald-900 mt-2">{{ $totalHadirBulanIni }} <span class="text-sm font-semibold text-emerald-600">Hari</span></h3>
                        <p class="text-[11px] text-emerald-400 mt-1 font-medium">Akumulasi hadir tepat waktu</p>
                    </div>
                    
                    <div class="bg-amber-50/60 border border-amber-100 p-6 rounded-2xl shadow-sm">
                        <p class="text-[11px] font-bold text-amber-600 uppercase tracking-wider">Jadwal Hari Ini</p>
                        <h3 class="text-2xl font-extrabold text-amber-900 mt-2">-</h3>
                        <p class="text-[11px] text-amber-400 mt-1 font-medium">Kelas yang diampu</p>
                    </div>
                </div>

                <!-- Aksi Cepat / Menu Utama (Soft Colors) -->
                <div class="space-y-4">
                    <h3 class="font-extrabold text-xs text-slate-900 uppercase tracking-wider">Aksi Cepat & Menu Utama</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        
                        <a href="{{ route('guru.presensi') }}" class="bg-blue-50/50 hover:bg-blue-50 border border-blue-100 p-6 rounded-2xl transition group shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mb-1">Absensi</div>
                                <h4 class="font-bold text-slate-900 text-xs">Presensi Guru</h4>
                                <p class="text-[11px] text-slate-500 mt-2 font-medium">Lakukan absensi kehadiran mengajar harian Anda.</p>
                            </div>
                            <span class="text-xs font-bold text-blue-600 mt-4 group-hover:translate-x-1 transition inline-flex items-center gap-1">Absen Sekarang &rarr;</span>
                        </a>

                        <a href="{{ route('presensi.rekap') }}" class="bg-emerald-50/50 hover:bg-emerald-50 border border-emerald-100 p-6 rounded-2xl transition group shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1">Statistik</div>
                                <h4 class="font-bold text-slate-900 text-xs">Rekap Presensi Bulanan</h4>
                                <p class="text-[11px] text-slate-500 mt-2 font-medium">Tinjau hasil rekapitulasi riwayat kehadiran per bulan.</p>
                            </div>
                            <span class="text-xs font-bold text-emerald-600 mt-4 group-hover:translate-x-1 transition inline-flex items-center gap-1">Lihat Rekap &rarr;</span>
                        </a>

                        <a href="{{ route('guru.presensi-siswa.index') }}" class="bg-violet-50/50 hover:bg-violet-50 border border-violet-100 p-6 rounded-2xl transition group shadow-sm flex flex-col justify-between">                            <div>
                                <div class="text-[10px] font-bold text-violet-600 uppercase tracking-wider mb-1">Akademik</div>
                                <h4 class="font-bold text-slate-900 text-xs">Kelola Presensi Siswa</h4>
                                <p class="text-[11px] text-slate-500 mt-2 font-medium">Input dan perbarui absensi harian peserta didik.</p>
                            </div>
                            <span class="text-xs font-bold text-violet-600 mt-4 group-hover:translate-x-1 transition inline-flex items-center gap-1">Buka Presensi &rarr;</span>
                        </a>

                        <a href="{{ route('guru.jadwal') }}" class="bg-amber-50/50 hover:bg-amber-50 border border-amber-100 p-6 rounded-2xl transition group shadow-sm flex flex-col justify-between">                            <div>
                                <div class="text-[10px] font-bold text-amber-600 uppercase tracking-wider mb-1">Jadwal</div>
                                <h4 class="font-bold text-slate-900 text-xs">Lihat Jadwal Mengajar</h4>
                                <p class="text-[11px] text-slate-500 mt-2 font-medium">Daftar jam dan kelas mata pelajaran yang diampu.</p>
                            </div>
                            <span class="text-xs font-bold text-amber-600 mt-4 group-hover:translate-x-1 transition inline-flex items-center gap-1">Lihat Jadwal &rarr;</span>
                        </a>

                    </div>
                </div>

            </div>
        </main>

    </div>

</body>
</html>