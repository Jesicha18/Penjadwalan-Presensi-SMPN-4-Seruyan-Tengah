<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Presensi Siswa | SMPN 4 Seruyan Tengah</title>
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

        <!-- ================= 2. KONTEN UTAMA (MELEBAR FULL/FULL WIDTH) ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            <div class="w-full space-y-6">

                <!-- Header -->
                <div class="pb-4 border-b border-slate-200">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Edit Presensi Siswa</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Perbarui tanggal atau status kehadiran siswa.</p>
                </div>

                {{-- Pesan Sukses --}}
                @if (session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Form Card --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 w-full">

                    {{-- Pesan Error --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs space-y-1 shadow-sm font-semibold">
                            <p>⚠️ Periksa kembali data berikut:</p>
                            <ul class="list-disc pl-5 space-y-0.5 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('presensi-siswa.update', $presensi->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Informasi Siswa --}}
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-4">Informasi Siswa</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                                        Nama Siswa
                                    </label>
                                    <input type="text"
                                           value="{{ $presensi->siswa->nama ?? '-' }}"
                                           readonly
                                           class="w-full bg-slate-50 border border-slate-200 text-slate-600 text-xs rounded-xl p-3.5 cursor-not-allowed">
                                </div>

                                <div>
                                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                                        Kelas
                                    </label>
                                    <input type="text"
                                           value="{{ $presensi->siswa->kelas->nama_kelas ?? '-' }}"
                                           readonly
                                           class="w-full bg-slate-50 border border-slate-200 text-slate-600 text-xs rounded-xl p-3.5 cursor-not-allowed">
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 pt-6"></div>

                        {{-- Data Presensi --}}
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-4">Data Presensi</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="tanggal" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                                        Tanggal Presensi
                                    </label>
                                    <input type="date"
                                           id="tanggal"
                                           name="tanggal"
                                           value="{{ old('tanggal', \Carbon\Carbon::parse($presensi->tanggal)->format('Y-m-d')) }}"
                                           required
                                           class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs rounded-xl p-3.5 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                                </div>

                                <div>
                                    <label for="status" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                                        Status Kehadiran
                                    </label>
                                    <select id="status"
                                            name="status"
                                            required
                                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs rounded-xl p-3.5 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                                        <option value="Hadir" {{ old('status', $presensi->status) == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Izin" {{ old('status', $presensi->status) == 'Izin' ? 'selected' : '' }}>Izin</option>
                                        <option value="Sakit" {{ old('status', $presensi->status) == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="Alfa" {{ old('status', $presensi->status) == 'Alfa' ? 'selected' : '' }}>Alfa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
<div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t border-slate-100">
    <a href="{{ route('guru.presensi-siswa.index') }}"
       class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold py-3 px-6 rounded-xl border border-slate-200 text-center transition-all">
        Batal
    </a>

    <button type="submit"
            class="bg-[#2582E5] hover:bg-blue-600 text-white text-xs font-bold py-3 px-6 rounded-xl shadow-md transition-all">
        Simpan Perubahan
    </button>
</div>

                    </form>
                </div>

            </div>
        </main>

    </div>

</body>
</html>