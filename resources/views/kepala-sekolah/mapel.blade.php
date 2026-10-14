<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Mata Pelajaran - SIPAS</title>
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
                <!-- Logo & Identitas -->
                <div class="flex items-center space-x-3 mb-8 px-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md p-1 shrink-0">
                        <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-xs font-bold tracking-wider text-white">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">{{ Auth::user()->email ?? 'kepsek@smpn4.sch.id' }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Utama -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Dashboard Utama -->
                            <a href="{{ route('dashboard.kepala-sekolah') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard Utama</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('kepala-sekolah.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Navigasi Rincian Data -->
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Rincian Data</p>
                        <nav class="space-y-1">
                            <!-- Link ke Data Guru -->
                            <a href="{{ route('kepala-sekolah.guru') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    <span>Total Guru</span>
                                </span>
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            </a>

                            <!-- Link ke Data Kelas -->
                            <a href="{{ route('kepala-sekolah.kelas') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    <span>Total Kelas</span>
                                </span>
                                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                            </a>

                            <!-- Link ke Data Mata Pelajaran (Aktif) -->
                            <a href="{{ route('kepala-sekolah.mapel') }}" class="flex items-center justify-between px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    <span>Mata Pelajaran</span>
                                </span>
                                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            </a>

                            <!-- Link ke Pengguna Sistem -->
                            <a href="{{ route('kepala-sekolah.user') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    <span>Pengguna Sistem</span>
                                </span>
                                <span class="w-2 h-2 rounded-full bg-violet-400"></span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Keluar Akun -->
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

        <!-- ================= 2. KONTEN UTAMA (FULL LAYAR) ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            <div class="w-full space-y-6">

                <!-- Header Halaman -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Monitoring Mata Pelajaran</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Daftar kurikulum mata pelajaran aktif yang diajarkan di sekolah.</p>
                    </div>
                    <a href="{{ route('dashboard.kepala-sekolah') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-sm">
                        Kembali ke Dashboard
                    </a>
                </div>

                <!-- Tabel Data Mata Pelajaran -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Tabel Mata Pelajaran</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                    <th class="p-4 w-16 text-center">No</th>
                                    <th class="p-4">Nama Mata Pelajaran</th>
                                    <th class="p-4">Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                @forelse($mapelList as $index => $mapel)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="p-4 text-center font-mono text-slate-400">{{ $index + 1 }}</td>
                                        <td class="p-4 font-extrabold text-slate-900">
                                            <span class="inline-flex items-center px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-lg border border-amber-100">
                                                {{ $mapel->nama_mapel ?? $mapel->name ?? 'Mapel' }}
                                            </span>
                                        </td>
                                        <td class="p-4 font-mono text-slate-600">{{ $mapel->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-12 text-center text-slate-400 font-medium">Belum ada data mata pelajaran yang terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>

    </div>

</body>
</html>