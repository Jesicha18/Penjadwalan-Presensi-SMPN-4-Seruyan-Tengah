<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Presensi - SIPAS</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-smpn4.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-smpn4.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        @media print {
            aside, .no-print { display: none !important; }
            body { background: white !important; }
            .app-shell { display: block !important; height: auto !important; overflow: visible !important; }
            main { padding: 0 !important; overflow: visible !important; }
            .print-card { border: none !important; box-shadow: none !important; }
            .table-wrap { overflow: visible !important; }
            table { width: 100% !important; font-size: 10px !important; }
            th, td { padding: 6px !important; }
        }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased text-slate-800">
@php
    $jenis = request('jenis', 'siswa');
    $bulanTerpilih = (int) request('bulan', now()->month);
    $tahunTerpilih = (int) request('tahun', now()->year);
    $namaBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    $daftarTahun = $daftarTahun ?? range(now()->year - 3, now()->year);
@endphp

<div class="app-shell flex h-screen overflow-hidden">
    <aside class="w-64 bg-[#0F5EA3] text-white flex flex-col justify-between p-5 shrink-0 shadow-xl select-none overflow-y-auto">
            <div>
                <!-- Logo & Identitas (Foto Logo Sekolah Menggantikan Inisial K) -->
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
                            <!-- Dashboard Utama (Aktif) -->
                            <a href="{{ route('dashboard.kepala-sekolah') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
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
                                </span>                                   </a>

                            <!-- Link ke Data Kelas -->
                            <a href="{{ route('kepala-sekolah.kelas') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    <span>Total Kelas</span>
                                </span>                                   </a>

                            <!-- Link ke Data Mata Pelajaran -->
                            <a href="{{ route('kepala-sekolah.mapel') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    <span>Mata Pelajaran</span>
                                </span>
                            </a>

                            <!-- Link ke Pengguna Sistem -->
                            <a href="{{ route('kepala-sekolah.user') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    <span>Pengguna Sistem</span>
                                </span>
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

    <main class="flex-1 overflow-y-auto p-5 md:p-8 space-y-6">
        <div class="w-full max-w-[1600px] mx-auto space-y-6">
            <header class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 no-print">
                <div>
                    <p class="text-[10px] uppercase tracking-[0.2em] font-extrabold text-blue-600 mb-2">SIPAS · Monitoring Akademik</p>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Rekapitulasi Presensi</h2>
                    <p class="text-xs text-slate-400 mt-1">Pantau dan tinjau laporan kehadiran guru maupun siswa.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all shadow-sm">▣ Cetak Rekap</button>
                    <a href="{{ route('dashboard.kepala-sekolah') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold transition-all border border-slate-200">Kembali ke Dashboard</a>
                </div>
            </header>

            <section class="grid grid-cols-1 md:grid-cols-2 gap-4 no-print">
                <a href="{{ request()->url() . '?' . http_build_query(array_merge(request()->query(), ['jenis' => 'siswa'])) }}"
                   class="rounded-2xl border p-5 transition-all {{ $jenis === 'siswa' ? 'bg-blue-600 border-blue-600 text-white shadow-lg shadow-blue-100' : 'bg-white border-slate-200 hover:border-blue-300 text-slate-700' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold {{ $jenis === 'siswa' ? 'text-blue-100' : 'text-slate-400' }}">REKAP PRESENSI</p>
                            <h3 class="text-lg font-extrabold mt-1">Presensi Siswa</h3>
                            <p class="text-xs mt-1 {{ $jenis === 'siswa' ? 'text-blue-100' : 'text-slate-500' }}">Lihat kehadiran siswa berdasarkan kelas.</p>
                        </div>
                        <span class="text-3xl">♙</span>
                    </div>
                </a>
                <a href="{{ request()->url() . '?' . http_build_query(array_merge(request()->query(), ['jenis' => 'guru'])) }}"
                   class="rounded-2xl border p-5 transition-all {{ $jenis === 'guru' ? 'bg-blue-600 border-blue-600 text-white shadow-lg shadow-blue-100' : 'bg-white border-slate-200 hover:border-blue-300 text-slate-700' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold {{ $jenis === 'guru' ? 'text-blue-100' : 'text-slate-400' }}">REKAP PRESENSI</p>
                            <h3 class="text-lg font-extrabold mt-1">Presensi Guru</h3>
                            <p class="text-xs mt-1 {{ $jenis === 'guru' ? 'text-blue-100' : 'text-slate-500' }}">Lihat ringkasan kehadiran tenaga pendidik.</p>
                        </div>
                        <span class="text-3xl">♧</span>
                    </div>
                </a>
            </section>

            <section class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm no-print">
                <form method="GET" action="{{ request()->url() }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                    <input type="hidden" name="jenis" value="{{ $jenis }}">
                    <div>
                        <label for="bulan" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Pilih Bulan</label>
                        <select id="bulan" name="bulan" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500">
                            @foreach($namaBulan as $nomor => $nama)
                                <option value="{{ $nomor }}" {{ $bulanTerpilih === $nomor ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tahun" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Pilih Tahun</label>
                        <select id="tahun" name="tahun" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500">
                            @foreach($daftarTahun as $tahun)
                                <option value="{{ $tahun }}" {{ $tahunTerpilih === (int) $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($jenis === 'siswa')
                    <div>
                        <label for="kelas_id" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Pilih Kelas</label>
                        <select id="kelas_id" name="kelas_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500">
                            <option value="">Semua Kelas</option>
                            @foreach(($kelasList ?? []) as $kelas)
                                <option value="{{ $kelas->id_kelas ?? $kelas->id }}" {{ (string) request('kelas_id') === (string) ($kelas->id_kelas ?? $kelas->id) ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas ?? 'Kelas' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div class="hidden lg:block"></div>
                    @endif
                    <div>
                        <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white py-3 px-6 rounded-xl text-xs font-bold transition-all shadow-sm">Tampilkan Data</button>
                    </div>
                </form>
            </section>

            <section class="grid grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                    <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">Total Terdata</p>
                    <p class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalTerdata ?? (isset($rekapList) ? $rekapList->count() : 0) }}</p>
                    <p class="text-[10px] text-slate-400 mt-1">{{ $jenis === 'guru' ? 'Guru' : 'Siswa' }} dalam rekap</p>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                    <p class="text-[10px] uppercase tracking-wider font-bold text-emerald-600">Hadir</p>
                    <p class="text-2xl font-extrabold text-emerald-600 mt-2">{{ $totalHadir ?? 0 }}</p>
                    <p class="text-[10px] text-slate-400 mt-1">Total catatan kehadiran</p>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                    <p class="text-[10px] uppercase tracking-wider font-bold text-amber-600">Izin / Sakit</p>
                    <p class="text-2xl font-extrabold text-amber-600 mt-2">{{ $totalIzinSakit ?? 0 }}</p>
                    <p class="text-[10px] text-slate-400 mt-1">Total izin dan sakit</p>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                    <p class="text-[10px] uppercase tracking-wider font-bold text-rose-600">{{ $jenis === 'guru' ? 'Tidak Hadir' : 'Alpa' }}</p>
                    <p class="text-2xl font-extrabold text-rose-600 mt-2">{{ $totalAlpa ?? 0 }}</p>
                    <p class="text-[10px] text-slate-400 mt-1">Total ketidakhadiran</p>
                </div>
            </section>

            <section class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden print-card">
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm uppercase tracking-wider">
                            Laporan Kehadiran {{ $jenis === 'guru' ? 'Guru' : 'Siswa' }}
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-1">Periode: {{ $namaBulan[$bulanTerpilih] ?? '' }} {{ $tahunTerpilih }}</p>
                    </div>
                    <span class="self-start sm:self-auto px-3 py-1.5 bg-blue-50 text-blue-700 font-bold rounded-lg text-xs border border-blue-100">
                        {{ $jenis === 'guru' ? 'Rekap Guru' : (request('kelas_id') ? 'Kelas Terpilih' : 'Semua Kelas') }}
                    </span>
                </div>

                <div class="table-wrap overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[760px]">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                <th class="p-4 w-12 text-center">No</th>
                                <th class="p-4">Nama {{ $jenis === 'guru' ? 'Guru' : 'Siswa' }}</th>
                                @if($jenis === 'siswa')
                                    <th class="p-4">Kelas</th>
                                @endif
                                <th class="p-4 text-center text-emerald-600">Hadir</th>
                                <th class="p-4 text-center text-amber-600">Izin</th>
                                <th class="p-4 text-center text-blue-600">Sakit</th>
                                <th class="p-4 text-center text-rose-600">{{ $jenis === 'guru' ? 'Tidak Hadir' : 'Alpa' }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                            @forelse(($rekapList ?? []) as $index => $item)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="p-4 text-center font-mono text-slate-400">{{ $index + 1 }}</td>
                                    <td class="p-4 font-bold text-slate-900">
                                        {{ $jenis === 'guru' ? ($item->nama_guru ?? $item->nama ?? '-') : ($item->nama_siswa ?? $item->nama ?? '-') }}
                                    </td>
                                    @if($jenis === 'siswa')
                                        <td class="p-4 font-medium text-slate-600">{{ $item->kelas ?? $item->nama_kelas ?? '-' }}</td>
                                    @endif
                                    <td class="p-4 text-center font-bold text-emerald-600">{{ $item->hadir ?? 0 }}</td>
                                    <td class="p-4 text-center font-bold text-amber-600">{{ $item->izin ?? 0 }}</td>
                                    <td class="p-4 text-center font-bold text-blue-600">{{ $item->sakit ?? 0 }}</td>
                                    <td class="p-4 text-center font-bold text-rose-600">{{ $item->alpa ?? $item->tidak_hadir ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $jenis === 'guru' ? 7 : 8 }}" class="p-12 text-center">
                                        <div class="text-3xl mb-3">▤</div>
                                        <p class="font-bold text-slate-600">Belum ada data rekap presensi.</p>
                                        <p class="text-slate-400 text-[11px] mt-1">Pilih periode atau kelas lain, atau pastikan data sudah tersedia.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 text-[10px] text-slate-400 flex flex-col sm:flex-row sm:justify-between gap-1">
                    <span>SIPAS · SMPN 4 Seruyan Tengah</span>
                    <span>Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }}</span>
                </div>
            </section>
        </div>
    </main>
</div>
</body>
</html>
