<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Waka Kurikulum - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- 1. SIDEBAR KIRI -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100">
                        S
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-gray-400 truncate max-w-[130px]">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-indigo-500 hover:bg-indigo-50 hover:text-indigo-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4 transition-transform duration-300 ease-in-out group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('waka.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <!-- Menu Khusus "Buat Jadwal" (Pusat Kartu Modul & Generator) -->
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>
                            <!-- Menu Utama Jadwal Pelajaran (Arsip/Hasil Jadi) -->
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Master Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span>Data Guru</span>
                            </a>

                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011 1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span>Data Kelas</span>
                            </a>
                            <!-- Menu Naik Kelas -->
                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>
                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span>Data Siswa</span>
                            </a>
                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332 1.253-4.5 1.253"/>
                                </svg>
                                <span>Mata Pelajaran</span>
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

        <!-- 2. KONTEN UTAMA TENGAH -->
        <main class="flex-1 overflow-y-auto p-8">
            <!-- Header Atas -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Dashboard Kurikulum</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Selamat datang kembali, Waka Kurikulum SMPN 4 Seruyan Tengah.</p>
                </div>
            </div>

            <!-- Quick Overview Cards -->
            <div class="mb-8">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Ringkasan Akademik</h3>
                <div class="grid grid-cols-4 gap-4">
                    <!-- Card 1: Data Guru -->
                    <a href="{{ route('guru.index') }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden hover:shadow-md hover:border-amber-100 transition block">
                        <div class="w-8 h-8 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center font-bold text-xs mb-3">👨‍🏫</div>
                        <h4 class="text-sm font-bold text-gray-800">Data Guru</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">{{ $jumlahGuru ?? 0 }} Guru Terdaftar</p>
                        <div class="mt-4">
                            <span class="text-[10px] bg-amber-50 text-amber-600 font-semibold px-2.5 py-1 rounded-lg">Kelola Guru</span>
                        </div>
                    </a>
                    
                    <!-- Card 2: Data Kelas -->
                    <a href="{{ route('kelas.index') }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden hover:shadow-md hover:border-emerald-100 transition block">
                        <div class="w-8 h-8 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center font-bold text-xs mb-3">🏫</div>
                        <h4 class="text-sm font-bold text-gray-800">Data Kelas</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">{{ $jumlahKelas ?? 0 }} Kelas Aktif</p>
                        <div class="mt-4">
                            <span class="text-[10px] bg-emerald-50 text-emerald-600 font-semibold px-2.5 py-1 rounded-lg">Kelola Kelas</span>
                        </div>
                    </a>

                    <!-- Card 3: Data Siswa (Baru) -->
                    <a href="{{ route('siswa.index') }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden hover:shadow-md hover:border-blue-100 transition block">
                        <div class="w-8 h-8 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center font-bold text-xs mb-3">🎓</div>
                        <h4 class="text-sm font-bold text-gray-800">Data Siswa</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">{{ $jumlahSiswa ?? 0 }} Siswa Aktif</p>
                        <div class="mt-4">
                            <span class="text-[10px] bg-blue-50 text-blue-600 font-semibold px-2.5 py-1 rounded-lg">Kelola Siswa</span>
                        </div>
                    </a>

                    <!-- Card 4: Mata Pelajaran -->
                    <a href="{{ route('mapel.index') }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden hover:shadow-md hover:border-indigo-100 transition block">
                        <div class="w-8 h-8 bg-indigo-50 text-indigo-500 rounded-xl flex items-center justify-center font-bold text-xs mb-3">📚</div>
                        <h4 class="text-sm font-bold text-gray-800">Mata Pelajaran</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">{{ $jumlahMapel ?? 0 }} Mapel Tersedia</p>
                        <div class="mt-4">
                            <span class="text-[10px] bg-indigo-50 text-indigo-600 font-semibold px-2.5 py-1 rounded-lg">Kelola Mapel</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Bagian Status Penjadwalan -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Penjadwalan & Algoritma</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center py-10">
                    <div class="w-12 h-12 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-3 text-lg">⚙️</div>
                    <h4 class="text-xs font-bold text-gray-800">Belum Ada Jadwal Aktif</h4>
                    <p class="text-[11px] text-gray-400 mt-1 max-w-sm mx-auto">Sistem penjadwalan otomatis siap digunakan setelah master data guru, kelas, siswa, dan mapel lengkap diisi.</p>
                </div>
            </div>
        </main>

        <!-- 3. SIDEBAR KANAN (Kalender Nyata & Info) -->
        <aside class="w-80 bg-white border-l border-gray-100 p-6 flex flex-col justify-between hidden xl:flex shrink-0">
            <div>
                <!-- Informasi Kalender Dinamis (Nyata) -->
                <div class="bg-[#F8F9FA] p-5 rounded-2xl mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <span id="calendar-month-year" class="text-xs font-bold text-gray-800"></span>
                        <span class="text-[10px] text-indigo-600 font-semibold cursor-pointer hover:underline" onclick="goToCurrentMonth()">Hari Ini</span>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-center text-[10px] text-gray-400 font-medium mb-2">
                        <span>Sn</span><span>Sl</span><span>Rb</span><span>Km</span><span>Jm</span><span>Sb</span><span>Mg</span>
                    </div>
                    <div id="calendar-days" class="grid grid-cols-7 gap-1 text-center text-[11px] font-medium text-gray-600">
                        <!-- Tanggal dirender otomatis lewat JavaScript -->
                    </div>
                </div>
            </div>
        </aside>

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
                emptySpan.className = 'py-1';
                daysContainer.appendChild(emptySpan);
            }

            for (let day = 1; day <= totalDays; day++) {
                const daySpan = document.createElement('span');
                daySpan.innerText = day;

                if (isCurrentMonth && day === currentDay) {
                    daySpan.className = 'py-1 bg-indigo-600 text-white rounded-lg shadow-sm font-bold block';
                } else {
                    daySpan.className = 'py-1 hover:bg-gray-200 rounded-lg cursor-pointer transition block';
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