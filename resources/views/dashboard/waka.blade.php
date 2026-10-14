<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Waka Kurikulum - SMPN 4 Seruyan Tengah</title>
<!-- Favicon HD untuk Tab Browser -->
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-smpn4.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-smpn4.png') }}">    <!-- Tailwind CSS CDN -->
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
        <aside class="w-64 bg-[#0F5EA3] text-white flex flex-col justify-between p-5 shrink-0 shadow-xl">
            <div>
                <!-- Brand Header -->
<!-- User Profile Header / Logo Sekolah -->
<div class="flex items-center space-x-3 mb-8 px-2">
    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md p-1 shrink-0">
        <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
    </div>
    <div>
        <h1 class="text-xs font-bold tracking-wider text-white">SMPN 4 SERUYAN</h1>
        <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">{{ Auth::user()->email ?? 'kurikulum@smpn4.sch.id' }}</p>
    </div>
</div>
                <!-- Navigasi Menu -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Dashboard Active Pill -->
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            
                            <!-- Profil Saya -->
                            <a href="{{ route('waka.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>

                            <!-- Buat Jadwal -->
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>

                            <!-- Jadwal Pelajaran -->
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Master Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Guru</span>
                            </a>

                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011 1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Data Kelas</span>
                            </a>

                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>

                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Siswa</span>
                            </a>

                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>

                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332 1.253-4.5 1.253"/></svg>
                                <span>Mata Pelajaran</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Logout -->
            <div class="pt-4 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 text-rose-200 hover:bg-rose-500/20 hover:text-rose-100 rounded-xl text-xs font-semibold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ================= 2. KONTEN UTAMA TENGAH ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            
            <!-- Top Header Area -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Dashboard</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Kelola dan pantau seluruh operasional akademik SMPN 4 Seruyan Tengah.</p>
                </div>
            </div>

            <!-- HERO WELCOME BANNER (Tanpa statistik double) -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0C4A80] via-[#1162A8] to-[#1E7CD0] p-6 md:p-8 text-white shadow-lg">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">Selamat Datang, Wakasek Kurikulum! 👋</h1>
                        <p class="text-blue-100 text-xs mt-1">Semangat hari ini!</p>
                    </div>
                    <div>
                        <span class="bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-xl text-xs font-semibold text-white border border-white/20 inline-flex items-center gap-2">
                            📅 {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- MAIN STAT CARDS (4 Modul - Tanpa Garis Bawah) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <!-- Card 1: Data Guru (Soft Blue) -->
    <a href="{{ route('guru.index') }}" class="bg-blue-50/60 p-5 rounded-2xl border border-blue-100 shadow-sm hover:shadow-md transition-all group block">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold text-blue-600 uppercase tracking-wider">Guru Terdaftar</span>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black text-slate-800 group-hover:text-blue-600 transition-colors">{{ $jumlahGuru ?? 0 }}</h3>
            <p class="text-[11px] text-slate-500 mt-0.5">Kelola data kepegawaian guru</p>
        </div>
    </a>

    <!-- Card 2: Data Kelas (Soft Green) -->
    <a href="{{ route('kelas.index') }}" class="bg-emerald-50/60 p-5 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition-all group block">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Kelas Rombel</span>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black text-slate-800 group-hover:text-emerald-600 transition-colors">{{ $jumlahKelas ?? 0 }}</h3>
            <p class="text-[11px] text-slate-500 mt-0.5">Kelas pembelajaran aktif</p>
        </div>
    </a>

    <!-- Card 3: Data Siswa (Soft Amber/Yellow) -->
    <a href="{{ route('siswa.index') }}" class="bg-amber-50/60 p-5 rounded-2xl border border-amber-100 shadow-sm hover:shadow-md transition-all group block">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold text-amber-600 uppercase tracking-wider">Siswa Aktif</span>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black text-slate-800 group-hover:text-amber-600 transition-colors">{{ $jumlahSiswa ?? 0 }}</h3>
            <p class="text-[11px] text-slate-500 mt-0.5">Siswa terdaftar dalam sistem</p>
        </div>
    </a>

    <!-- Card 4: Mata Pelajaran (Soft Purple) -->
    <a href="{{ route('mapel.index') }}" class="bg-purple-50/60 p-5 rounded-2xl border border-purple-100 shadow-sm hover:shadow-md transition-all group block">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold text-purple-600 uppercase tracking-wider">Mata Pelajaran</span>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black text-slate-800 group-hover:text-purple-600 transition-colors">{{ $jumlahMapel ?? 0 }}</h3>
            <p class="text-[11px] text-slate-500 mt-0.5">Mapel terstruktur</p>
        </div>
    </a>
</div>
            <!-- ================= KALENDER AKADEMIK (FULL WIDTH) ================= -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Kalender Hari Ini</h3>
                        <p class="text-xs text-slate-400">Jadwal tanggal dan hari efektif sekolah.</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span id="calendar-month-year" class="text-xs font-extrabold text-slate-800"></span>
                        <button onclick="goToCurrentMonth()" class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2.5 py-1 rounded-lg hover:bg-blue-100 transition">Hari Ini</button>
                    </div>
                </div>
                
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <div class="grid grid-cols-7 gap-1 text-center text-[10px] text-slate-400 font-bold mb-2">
                        <span>Senin</span><span>Selasa</span><span>Rabu</span><span>Kamis</span><span>Jumat</span><span>Sabtu</span><span>Minggu</span>
                    </div>
                    <div id="calendar-days" class="grid grid-cols-7 gap-1 text-center text-[11px] font-semibold text-slate-700">
                        <!-- Rendered by JS -->
                    </div>
                </div>
            </div>

        </main>

    </div>

    <!-- Script Kalender Nyata -->
    <script>
        let currentDate = new Date();

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            const monthNames = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            document.getElementById('calendar-month-year').innerText = `${monthNames[month]} ${year}`;

            const daysContainer = document.getElementById('calendar-days');
            daysContainer.innerHTML = '';

            const firstDayIndex = (new Date(year, month, 1).getDay() + 6) % 7;
            const totalDays = new Date(year, month + 1, 0).getDate();

            const today = new Date();
            const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;
            const currentDay = today.getDate();

            for (let i = 0; i < firstDayIndex; i++) {
                const emptySpan = document.createElement('span');
                emptySpan.className = 'py-2';
                daysContainer.appendChild(emptySpan);
            }

            for (let day = 1; day <= totalDays; day++) {
                const daySpan = document.createElement('span');
                daySpan.innerText = day;

                if (isCurrentMonth && day === currentDay) {
                    daySpan.className = 'py-2 bg-blue-600 text-white rounded-lg shadow-sm font-bold block';
                } else {
                    daySpan.className = 'py-2 hover:bg-slate-200 rounded-lg cursor-pointer transition block';
                }

                daysContainer.appendChild(daySpan);
            }
        }

        function goToCurrentMonth() {
            currentDate = new Date();
            renderCalendar();
        }

        document.addEventListener('DOMContentLoaded', renderCalendar);
    </script>
</body>
</html>