<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Siswa | SMPN 4 Seruyan Tengah</title>
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

                <!-- Header -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Presensi Siswa</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Lihat dan kelola catatan kehadiran peserta didik berdasarkan kelas dan tanggal.</p>
                    </div>
                    <div class="bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm text-xs font-bold text-slate-700">
                        📅 {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <!-- Notifikasi -->
                @if (session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs space-y-1 shadow-sm font-semibold">
                        <p>⚠️ Terjadi kesalahan:</p>
                        <ul class="list-disc pl-5 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Ringkasan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Catatan</p>
                        <h3 class="text-3xl font-extrabold text-slate-900 mt-2">{{ $totalCatatan ?? 0 }}</h3>
                        <p class="text-[11px] text-slate-400 mt-1 font-medium">Catatan sesuai filter</p>
                    </div>

                    <div class="bg-emerald-50/60 p-6 rounded-2xl border border-emerald-100 shadow-sm">
                        <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Hadir</p>
                        <h3 class="text-3xl font-extrabold text-emerald-900 mt-2">{{ $jumlahHadir ?? 0 }}</h3>
                        <p class="text-[11px] text-emerald-600 mt-1 font-medium">Status kehadiran Hadir</p>
                    </div>

                    <div class="bg-amber-50/60 p-6 rounded-2xl border border-amber-100 shadow-sm">
                        <p class="text-[11px] font-bold text-amber-600 uppercase tracking-wider">Izin dan Sakit</p>
                        <h3 class="text-3xl font-extrabold text-amber-900 mt-2">{{ $jumlahIzinSakit ?? 0 }}</h3>
                        <p class="text-[11px] text-amber-600 mt-1 font-medium">Status Izin dan Sakit</p>
                    </div>

                    <div class="bg-rose-50/60 p-6 rounded-2xl border border-rose-100 shadow-sm">
                        <p class="text-[11px] font-bold text-rose-600 uppercase tracking-wider">Alfa</p>
                        <h3 class="text-3xl font-extrabold text-rose-900 mt-2">{{ $jumlahAlfa ?? 0 }}</h3>
                        <p class="text-[11px] text-rose-600 mt-1 font-medium">Status Alfa</p>
                    </div>
                </div>

                <!-- Tabel Riwayat Presensi -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

                    <div class="p-6 border-b border-slate-100">
                        <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Daftar Catatan Presensi</h3>
                        <p class="text-xs text-slate-400 mt-1">Cari catatan kehadiran siswa untuk diperiksa atau diperbarui.</p>
                    </div>

                    <!-- Filter -->
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <form action="{{ route('guru.presensi-siswa.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                            <div>
                                <label for="search" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Cari Nama Siswa</label>
                                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Masukkan nama siswa..."
                                       class="w-full bg-white border border-slate-200 text-slate-800 text-xs rounded-xl px-3.5 py-3 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                            </div>

                            <div>
                                <label for="kelas_id" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Kelas</label>
                                <select id="kelas_id" name="kelas_id"
                                        class="w-full bg-white border border-slate-200 text-slate-800 text-xs rounded-xl px-3.5 py-3 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                                    <option value="">Semua Kelas</option>
                                    @foreach ($daftarKelas ?? [] as $kelas)
                                        <option value="{{ $kelas->id_kelas }}" {{ (string) request('kelas_id') === (string) $kelas->id_kelas ? 'selected' : '' }}>
                                            {{ $kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="tanggal" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Presensi</label>
                                <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}"
                                       class="w-full bg-white border border-slate-200 text-slate-800 text-xs rounded-xl px-3.5 py-3 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                            </div>

                            <div class="flex items-end gap-2">
                                <button type="submit"
                                        class="flex-1 bg-[#2582E5] hover:bg-blue-600 text-white rounded-xl text-xs font-bold py-3 px-4 shadow-md transition-all">
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                    <th class="p-4 w-16 text-center">No</th>
                                    <th class="p-4">Nama Siswa</th>
                                    <th class="p-4">Kelas</th>
                                    <th class="p-4">Mata Pelajaran</th>
                                    <th class="p-4">Tanggal</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                @forelse ($listPresensiSiswa ?? [] as $presensi)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="p-4 text-center font-mono text-slate-400">
                                            {{ ($listPresensiSiswa->firstItem() ?? 1) + $loop->index }}
                                        </td>

                                        <td class="p-4">
                                            <p class="font-extrabold text-slate-900">{{ $presensi->siswa->nama ?? 'Siswa' }}</p>
                                            <p class="text-[11px] text-slate-400 mt-0.5 font-mono">NIS: {{ $presensi->siswa->nis ?? '-' }}</p>
                                        </td>

                                        <td class="p-4 font-bold text-slate-700">
                                            {{ $presensi->siswa->kelas->nama_kelas ?? '-' }}
                                        </td>

                                        <td class="p-4 text-slate-600">
                                            {{ $presensi->jadwalPelajaran->mataPelajaran->nama_mata_pelajaran ?? $presensi->jadwalPelajaran->mataPelajaran->nama ?? '-' }}
                                        </td>

                                        <td class="p-4 font-mono text-slate-600 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($presensi->tanggal)->translatedFormat('d M Y') }}
                                        </td>

                                        <td class="p-4">
                                            @if ($presensi->status === 'Hadir')
                                                <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-700 font-bold rounded-lg border border-emerald-100">
                                                    Hadir
                                                </span>
                                            @elseif ($presensi->status === 'Izin')
                                                <span class="inline-flex items-center px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-lg border border-amber-100">
                                                    Izin
                                                </span>
                                            @elseif ($presensi->status === 'Sakit')
                                                <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 font-bold rounded-lg border border-blue-100">
                                                    Sakit
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg border border-rose-100">
                                                    Alfa
                                                </span>
                                            @endif
                                        </td>

                                        <td class="p-4 text-center">
                                            <a href="{{ route('presensi-siswa.edit', $presensi->id) }}"
                                               class="inline-flex items-center justify-center px-3.5 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-lg transition text-xs shadow-sm">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="p-12 text-center">
                                            <p class="font-extrabold text-slate-900 text-xs">Belum Ada Catatan Presensi</p>
                                            <p class="text-slate-400 text-[11px] mt-1 font-medium">Catatan presensi tidak ditemukan. Coba ubah filter kelas, nama siswa, atau tanggal.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if (isset($listPresensiSiswa) && method_exists($listPresensiSiswa, 'links'))
                        <div class="p-6 border-t border-slate-100">
                            {{ $listPresensiSiswa->withQueryString()->links() }}
                        </div>
                    @endif
                </div>

                <!-- Informasi -->
                <div class="p-6 bg-blue-50/50 border border-blue-100 rounded-2xl flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-extrabold text-blue-900 text-xs">Informasi</p>
                        <p class="text-xs text-blue-700 mt-0.5 font-medium leading-relaxed">
                            Halaman ini digunakan untuk mencari dan mengelola catatan presensi yang sudah tersimpan. Untuk mengisi presensi baru, buka menu Jadwal Pelajaran dan pilih jadwal mengajar yang sesuai.
                        </p>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>