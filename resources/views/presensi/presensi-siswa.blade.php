<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Siswa - SMPN 4 Seruyan Tengah</title>
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
                            <!-- Presensi Guru -->
                            <a href="{{ route('guru.presensi') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Presensi Guru</span>
                            </a>
                            <!-- Presensi Siswa (Aktif) -->
                            <a href="{{ route('guru.presensi-siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
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

                {{-- Header --}}
                <div class="pb-4 border-b border-slate-200">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Presensi Siswa</h2>
                    <p class="text-xs text-slate-400 mt-0.5">SMPN 4 Seruyan Tengah</p>
                </div>

                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Notifikasi Error --}}
                @if ($errors->any())
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs space-y-1 shadow-sm font-semibold">
                        <p>⚠️ Terjadi kesalahan:</p>
                        <ul class="list-inside list-disc mt-1 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Informasi Jadwal --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider mb-4">Informasi Jadwal</h3>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Mata Pelajaran</p>
                            <p class="mt-1 font-extrabold text-slate-900 text-xs">
                                {{ $jadwal->mataPelajaran?->nama_mapel ?? 'Tidak tersedia' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Kelas</p>
                            <p class="mt-1 font-extrabold text-slate-900 text-xs">
                                {{ $jadwal->kelas?->nama_kelas ?? 'Tidak tersedia' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Hari</p>
                            <p class="mt-1 font-extrabold text-slate-900 text-xs">{{ $jadwal->hari }}</p>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Jam Pelajaran</p>
                            <p class="mt-1 font-extrabold text-slate-900 text-xs font-mono">
                                {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Pilih Tanggal --}}
                <form method="GET" action="{{ route('guru.presensi-siswa.create', ['jadwalId' => $jadwal->id]) }}"
                      class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-wrap items-end gap-4">
                    <div>
                        <label for="tanggal" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                            Tanggal Presensi
                        </label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}" required
                               class="bg-slate-50 border border-slate-200 text-slate-800 text-xs rounded-xl px-3.5 py-3 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                    </div>

                    <button type="submit"
                            class="bg-[#2582E5] hover:bg-blue-600 text-white rounded-xl text-xs font-bold py-3 px-5 shadow-md transition-all">
                        Tampilkan
                    </button>
                </form>

                {{-- Form Presensi --}}
                <form method="POST" action="{{ route('guru.presensi-siswa.store', ['jadwalId' => $jadwal->id]) }}">
                    @csrf
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="flex flex-wrap items-center justify-between gap-3 p-6 border-b border-slate-100">
                            <div>
                                <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Daftar Siswa</h3>
                                <p class="text-xs text-slate-400 mt-1">Total {{ $siswas->count() }} siswa</p>
                            </div>

                            <span class="inline-flex items-center rounded-xl bg-blue-50 border border-blue-100 px-3.5 py-1.5 text-xs font-bold text-blue-700 shadow-sm">
                                📅 {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}
                            </span>
                        </div>

                        @if ($siswas->isEmpty())
                            <div class="p-12 text-center text-slate-400 font-medium text-xs">
                                Belum ada siswa terdaftar pada kelas ini.
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                            <th class="p-4 w-16 text-center">No.</th>
                                            <th class="p-4">NIS</th>
                                            <th class="p-4">Nama Siswa</th>
                                            <th class="p-4">Status Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                        @foreach ($siswas as $index => $siswa)
                                            @php
                                                $statusLama = old(
                                                    'presensi.' . $siswa->id,
                                                    $presensiLama->get($siswa->id)?->status ?? 'Hadir'
                                                );
                                            @endphp

                                            <tr class="hover:bg-slate-50/50 transition">
                                                <td class="p-4 text-center font-mono text-slate-400">
                                                    {{ $index + 1 }}
                                                </td>

                                                <td class="p-4 font-mono font-medium text-slate-600">
                                                    {{ $siswa->nis ?? '-' }}
                                                </td>

                                                <td class="p-4 font-bold text-slate-900">
                                                    {{ $siswa->nama }}
                                                </td>

                                                <td class="p-4">
                                                    <select name="presensi[{{ $siswa->id }}]" required
                                                            class="w-full sm:w-48 bg-slate-50 border border-slate-200 text-slate-800 text-xs rounded-xl p-2.5 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                                                        @foreach (['Hadir', 'Izin', 'Sakit', 'Alfa'] as $status)
                                                            <option value="{{ $status }}" {{ $statusLama === $status ? 'selected' : '' }}>
                                                                {{ $status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex justify-end gap-3 p-6 border-t border-slate-100">
                                <a href="{{ route('guru.jadwal') }}"
                                   class="bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold py-3 px-5 border border-slate-200 transition-all">
                                    Batal
                                </a>

                                <button type="submit"
                                        class="bg-[#2582E5] hover:bg-blue-600 text-white rounded-xl text-xs font-bold py-3 px-6 shadow-md transition-all">
                                    Simpan Presensi
                                </button>
                            </div>
                        @endif
                    </div>
                </form>

            </div>
        </main>
    </div>

</body>
</html>