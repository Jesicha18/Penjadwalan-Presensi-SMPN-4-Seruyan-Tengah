<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar Saya | SMPN 4 Seruyan Tengah</title>
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
                            <!-- Jadwal Pelajaran (Aktif) -->
                            <a href="{{ route('guru.jadwal') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Aktivitas Mengajar</p>
                        <nav class="space-y-1">
                            <!-- Presensi Guru -->
                            <a href="{{ route('guru.presensi') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Presensi Guru</span>
                            </a>
                            <!-- Presensi Siswa -->
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

        <!-- ================= 2. KONTEN UTAMA (FULL WIDTH) ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            <div class="w-full space-y-6">

                <!-- Header -->
                <div class="pb-4 border-b border-slate-200">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Jadwal Mengajar Saya</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Kelola dan pantau jadwal jam pelajaran mengajar Anda secara terstruktur.</p>
                </div>

                {{-- NOTIFIKASI SUKSES --}}
                @if (session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- NOTIFIKASI ERROR --}}
                @if ($errors->any())
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs space-y-1 shadow-sm font-semibold">
                        @foreach ($errors->all() as $error)
                            <p>⚠️ {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- INFORMASI GURU --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Guru Pengampu</p>
                        <h3 class="text-base font-extrabold text-slate-900 mt-1">{{ $guru->nama ?? '-' }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5 font-mono">NIP: {{ $guru->nip ?: '-' }}</p>
                    </div>
                </div>

                {{-- SIAPKAN PILIHAN HARI --}}
                @php
                    $daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    $hariAktif = request('hari', 'Senin');

                    if (!in_array($hariAktif, $daftarHari, true)) {
                        $hariAktif = 'Senin';
                    }

                    $jadwalHarian = $jadwal
                        ->filter(function ($item) use ($hariAktif) {
                            return strcasecmp(trim($item->hari ?? ''), $hariAktif) === 0;
                        })
                        ->sortBy('jam_mulai')
                        ->values();
                @endphp

                {{-- FILTER TAHUN AJARAN DAN SEMESTER --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <div class="mb-4">
                        <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider">TENTUKAN JADWAL</h3>
                        <p class="text-xs text-slate-400 mt-1">Pilih tahun ajaran dan semester untuk menyaring jadwal mengajar.</p>
                    </div>

                    <form action="{{ route('guru.jadwal') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="hidden" name="hari" value="{{ $hariAktif }}">

                        <div>
                            <label for="tahun_ajaran" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tahun Ajaran</label>
                            <select name="tahun_ajaran" id="tahun_ajaran" 
                                class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs rounded-xl p-3.5 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                                <option value="">Semua Tahun Ajaran</option>
                                @foreach ($daftarTahunAjaran as $tahun)
                                    <option value="{{ $tahun }}" {{ (string) $filterTahun === (string) $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="semester" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Semester</label>
                            <select name="semester" id="semester" 
                                class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs rounded-xl p-3.5 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                                <option value="Ganjil" {{ $filterSemester === 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ $filterSemester === 'Genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 bg-[#2582E5] hover:bg-blue-600 text-white rounded-xl text-xs font-bold py-3.5 px-5 shadow-md transition-all">
                                Tampilkan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- RINGKASAN (Soft Colors) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-blue-50/60 border border-blue-100 rounded-2xl p-6 shadow-sm">
                        <p class="text-[11px] font-bold text-blue-600 uppercase tracking-wider">Total Jam Mengajar</p>
                        <div class="flex items-end gap-2 mt-2">
                            <span class="text-3xl font-extrabold text-blue-900">{{ $jadwal->count() }}</span>
                            <span class="text-xs font-semibold text-blue-600 mb-1">slot jadwal</span>
                        </div>
                        <p class="text-[11px] text-blue-400 mt-1 font-medium">Total seluruh hari dalam filter yang dipilih.</p>
                    </div>

                    <div class="bg-emerald-50/60 border border-emerald-100 rounded-2xl p-6 shadow-sm">
                        <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Kelas yang Diajar</p>
                        <div class="flex items-end gap-2 mt-2">
                            <span class="text-3xl font-extrabold text-emerald-900">{{ $jadwal->pluck('kelas_id')->unique()->count() }}</span>
                            <span class="text-xs font-semibold text-emerald-600 mb-1">kelas</span>
                        </div>
                        <p class="text-[11px] text-emerald-400 mt-1 font-medium">Jumlah kelas yang diampu.</p>
                    </div>
                </div>

                {{-- JADWAL PER HARI --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="font-extrabold text-slate-900 text-sm uppercase tracking-wider">Daftar Jadwal Mengajar</h3>
                        <p class="text-xs text-slate-400 mt-1">Pilih hari untuk melihat daftar mata pelajaran dan jam mengajar.</p>
                    </div>

                    {{-- TAB PILIHAN HARI --}}
                    <div class="px-6 pt-5 pb-4">
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                            @foreach ($daftarHari as $hari)
                                <a href="{{ route('guru.jadwal', [
                                        'tahun_ajaran' => request('tahun_ajaran', $filterTahun),
                                        'semester' => $filterSemester,
                                        'hari' => $hari,
                                    ]) }}"
                                    class="flex items-center justify-center rounded-xl px-4 py-3 text-xs font-bold transition
                                    {{ $hariAktif === $hari
                                        ? 'bg-[#2582E5] text-white shadow-md'
                                        : 'bg-slate-50 text-slate-600 border border-slate-200 hover:bg-blue-50 hover:text-[#0F5EA3]' }}">
                                    {{ $hari }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- INFORMASI HARI AKTIF --}}
                    <div class="px-6 py-4 bg-blue-50/50 border-y border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div>
                            <h4 class="font-extrabold text-blue-900 text-xs">Jadwal Hari {{ $hariAktif }}</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Daftar slot waktu pelajaran aktif.</p>
                        </div>
                        <span class="inline-flex items-center rounded-xl bg-white border border-blue-100 px-3 py-1 text-xs font-bold text-blue-700 shadow-sm">
                            {{ $jadwalHarian->count() }} slot jadwal
                        </span>
                    </div>

                    {{-- TABEL JADWAL HARIAN --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                    <th class="p-4 w-12 text-center">No.</th>
                                    <th class="p-4">Waktu</th>
                                    <th class="p-4">Mata Pelajaran</th>
                                    <th class="p-4">Kelas</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                @forelse ($jadwalHarian as $item)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="p-4 text-center font-mono text-slate-400">{{ $loop->iteration }}</td>
                                        <td class="p-4 whitespace-nowrap font-mono font-medium text-slate-600">
                                            {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                        </td>
                                        <td class="p-4 font-bold text-slate-900">
                                            {{ $item->mataPelajaran?->nama_mapel ?? 'Mata pelajaran tidak ditemukan' }}
                                        </td>
                                        <td class="p-4">
                                            <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 font-bold text-slate-700">
                                                {{ $item->kelas?->nama_kelas ?? $item->kelas?->nama ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-center">
                                            <a href="{{ route('guru.presensi-siswa.create', ['jadwalId' => $item->id]) }}"
                                                class="inline-flex items-center justify-center rounded-xl bg-[#2582E5] hover:bg-blue-600 px-4 py-2 text-white text-xs font-bold shadow-sm transition">
                                                Presensi Siswa
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-12 text-center">
                                            <div class="text-3xl mb-2">📅</div>
                                            <p class="font-bold text-slate-900 text-xs">Belum Ada Jadwal Hari {{ $hariAktif }}</p>
                                            <p class="text-slate-400 text-[11px] mt-1 font-medium">Tidak ada jadwal mengajar pada hari ini untuk filter yang dipilih.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 border-t border-slate-100 text-[11px] text-slate-400 font-medium">
                        Menampilkan {{ $jadwalHarian->count() }} slot jadwal untuk hari {{ $hariAktif }}.
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>