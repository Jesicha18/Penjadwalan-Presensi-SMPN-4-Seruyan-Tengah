<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Guru - SMPN 4 Seruyan Tengah</title>
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
                        <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">{{ Auth::user()->email ?? 'guru@smpn4.sch.id' }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Sidebar -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard.guru') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
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
                            <!-- Presensi Guru (Aktif) -->
                            <a href="{{ route('guru.presensi') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Presensi Guru</span>
                            </a>
                            <!-- Presensi Siswa -->
                            <a href="{{ route('guru.presensi-siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Presensi Siswa</span>
                            </a>
                            <!-- Rekap Bulanan -->
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

        <!-- ================= 2. KONTEN UTAMA (FULL WIDTH) ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            <div class="w-full space-y-6">
                
                <!-- Header Halaman -->
                <div class="pb-4 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Presensi Kehadiran Guru</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Lakukan absensi harian Anda (Jendela waktu aktif: 07:00 - 15:00 WIB).</p>
                    </div>
                    <div class="bg-white px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm text-xs font-bold text-slate-700">
                        📅 {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <!-- Notifikasi -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs space-y-1 shadow-sm font-semibold">
                        @foreach($errors->all() as $error)
                            <p>⚠️ {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Card Form Presensi -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
                    <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider mb-4">Form Absensi Harian</h3>
                    
                    @php
                        $isMinggu = \Carbon\Carbon::now('Asia/Jakarta')->isSunday();
                    @endphp

                    @if($isMinggu)
                        <div class="p-4 bg-amber-50 text-amber-800 border border-amber-200 rounded-xl text-xs font-bold mb-4">
                            ⚠️ Hari ini adalah hari Minggu. Sistem presensi libur dan baru akan aktif kembali pada hari Senin.
                        </div>
                    @endif

                    <form action="{{ route('guru.presensi.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Status Kehadiran</label>
                            <select name="status_kehadiran" {{ $isMinggu ? 'disabled' : '' }} 
                                class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs rounded-xl p-3.5 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition {{ $isMinggu ? 'opacity-50 cursor-not-allowed' : '' }}">
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Tidak Hadir">Tidak Hadir</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit" {{ $isMinggu ? 'disabled' : '' }}
                                class="{{ $isMinggu ? 'bg-slate-300 cursor-not-allowed' : 'bg-[#2582E5] hover:bg-blue-600 shadow-md' }} text-white text-xs font-bold py-3.5 px-6 rounded-xl transition-all">
                                Kirim Presensi Sekarang
                            </button>
                            <a href="{{ route('dashboard.guru') }}"
                                class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold py-3.5 px-6 rounded-xl border border-slate-200 transition-all">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Riwayat & Filter Presensi -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
                    
                    <!-- Header Bagian & Filter Tanggal -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Riwayat & Status Kehadiran</h3>
                        
                        <!-- Form Filter Tanggal -->
                        <form action="{{ route('guru.presensi') }}" method="GET" class="flex items-center gap-2">
                            <input type="date" name="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}"
                                class="bg-slate-50 border border-slate-200 text-slate-800 text-xs rounded-xl px-3.5 py-2.5 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                            <button type="submit"
                                class="bg-slate-800 hover:bg-slate-900 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all shadow-sm">
                                Filter
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-100">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                    <th class="p-4">Tanggal</th>
                                    <th class="p-4">Status Kehadiran</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                @if(isset($riwayatPresensi) && $riwayatPresensi)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="p-4 font-mono font-medium text-slate-600">{{ $riwayatPresensi->tanggal }}</td>
                                        <td class="p-4 font-bold {{ $riwayatPresensi->status_kehadiran == 'Tidak Hadir' ? 'text-rose-600' : 'text-blue-600' }}">
                                            {{ $riwayatPresensi->status_kehadiran }}
                                        </td>
                                        <td class="p-4 text-center">
                                            <a href="{{ route('guru.presensi.edit', $riwayatPresensi->id_presensi_guru) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-lg transition text-xs">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="3" class="p-12 text-center text-slate-400 font-medium">Tidak ada data presensi pada tanggal tersebut.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>

    </div>

</body>
</html>