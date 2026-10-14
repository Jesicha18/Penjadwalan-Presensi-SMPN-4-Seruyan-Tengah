<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Presensi Bulanan - SMPN 4 Seruyan Tengah</title>
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
                            <!-- Presensi Siswa -->
                            <a href="{{ route('guru.presensi-siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Presensi Siswa</span>
                            </a>
                            <!-- Rekap Bulanan (Aktif) -->
                            <a href="{{ route('presensi.rekap') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
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
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="space-y-0.5">
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Rekapitulasi Presensi Bulanan</h2>
                        <p class="text-xs text-slate-400">Kelola dan pantau laporan kehadiran pendidik serta peserta didik secara berkala.</p>
                    </div>
                    
                    <!-- Form Filter Periode Laporan -->
                    <form action="{{ route('presensi.rekap') }}" method="GET" class="flex flex-wrap items-center gap-2.5 bg-slate-50 p-2.5 rounded-xl border border-slate-200 shadow-sm">
                        <input type="hidden" name="tab" value="{{ $tabAktif }}">
                        
                        <div class="flex items-center space-x-2 px-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[11px] font-bold text-slate-600 uppercase tracking-wider">Periode:</span>
                        </div>

                        <select name="bulan" class="px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                            <option value="01" {{ $bulanPilihan == '01' ? 'selected' : '' }}>Januari</option>
                            <option value="02" {{ $bulanPilihan == '02' ? 'selected' : '' }}>Februari</option>
                            <option value="03" {{ $bulanPilihan == '03' ? 'selected' : '' }}>Maret</option>
                            <option value="04" {{ $bulanPilihan == '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ $bulanPilihan == '05' ? 'selected' : '' }}>Mei</option>
                            <option value="06" {{ $bulanPilihan == '06' ? 'selected' : '' }}>Juni</option>
                            <option value="07" {{ $bulanPilihan == '07' ? 'selected' : '' }}>Juli</option>
                            <option value="08" {{ $bulanPilihan == '08' ? 'selected' : '' }}>Agustus</option>
                            <option value="09" {{ $bulanPilihan == '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $bulanPilihan == '10' ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $bulanPilihan == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $bulanPilihan == '12' ? 'selected' : '' }}>Desember</option>
                        </select>

                        <select name="tahun" class="px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                            @for($y = date('Y'); $y >= date('Y') - 2; $y--)
                                <option value="{{ $y }}" {{ $tahunPilihan == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>

                        <button type="submit" class="bg-[#2582E5] hover:bg-blue-600 text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-md transition-all">
                            Terapkan
                        </button>
                    </form>
                </div>

                <!-- Tab Navigasi Kategori (Guru vs Murid) -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('presensi.rekap', ['tab' => 'guru', 'bulan' => $bulanPilihan, 'tahun' => $tahunPilihan]) }}" 
                       class="flex items-center gap-2 px-6 py-3.5 rounded-xl text-xs font-extrabold transition shadow-sm {{ $tabAktif == 'guru' ? 'bg-[#2582E5] text-white shadow-md' : 'bg-white text-slate-700 border border-slate-100 hover:bg-slate-50' }}">
                        <span>👤</span>
                        <span>Rekap Presensi Guru</span>
                    </a>
                    <a href="{{ route('presensi.rekap', ['tab' => 'siswa', 'bulan' => $bulanPilihan, 'tahun' => $tahunPilihan]) }}" 
                       class="flex items-center gap-2 px-6 py-3.5 rounded-xl text-xs font-extrabold transition shadow-sm {{ $tabAktif == 'siswa' ? 'bg-[#2582E5] text-white shadow-md' : 'bg-white text-slate-700 border border-slate-100 hover:bg-slate-50' }}">
                        <span>🎓</span>
                        <span>Rekap Presensi Murid</span>
                    </a>
                </div>

                <!-- KONTEN TAB: REKAP GURU -->
                @if($tabAktif == 'guru')
                    <!-- Statistik Ringkasan Guru -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Hadir</p>
                            <h3 class="text-3xl font-extrabold text-emerald-600 mt-2">{{ $statistikGuru['hadir'] ?? 0 }} <span class="text-xs font-medium text-slate-400">Hari</span></h3>
                        </div>

                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Izin</p>
                            <h3 class="text-3xl font-extrabold text-amber-600 mt-2">{{ $statistikGuru['izin'] ?? 0 }} <span class="text-xs font-medium text-slate-400">Hari</span></h3>
                        </div>

                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Sakit</p>
                            <h3 class="text-3xl font-extrabold text-blue-600 mt-2">{{ $statistikGuru['sakit'] ?? 0 }} <span class="text-xs font-medium text-slate-400">Hari</span></h3>
                        </div>

                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tidak Hadir</p>
                            <h3 class="text-3xl font-extrabold text-rose-600 mt-2">{{ $statistikGuru['alpa'] ?? 0 }} <span class="text-xs font-medium text-slate-400">Hari</span></h3>
                        </div>
                    </div>

                    <!-- Tabel Rekap Guru -->
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                            <div>
                                <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Rincian Kehadiran Bulanan (Pendidik)</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Catatan log kehadiran harian Anda selama periode terpilih.</p>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        <th class="p-4 w-16 text-center">No</th>
                                        <th class="p-4">Tanggal Presensi</th>
                                        <th class="p-4">Status Kehadiran</th>
                                        <th class="p-4 text-center">Aksi Konfirmasi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                    @forelse($listPresensiGuru as $index => $item)
                                        <tr class="hover:bg-slate-50/50 transition">
                                            <td class="p-4 text-center font-mono text-slate-400">{{ $index + 1 }}</td>
                                            <td class="p-4 font-extrabold text-slate-900">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                            <td class="p-4">
                                                @if($item->status_kehadiran == 'Hadir')
                                                    <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-700 font-bold rounded-lg border border-emerald-100">Hadir</span>
                                                @elseif($item->status_kehadiran == 'Izin')
                                                    <span class="inline-flex items-center px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-lg border border-amber-100">Izin</span>
                                                @elseif($item->status_kehadiran == 'Sakit')
                                                    <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 font-bold rounded-lg border border-blue-100">Sakit</span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg border border-rose-100">Tidak Hadir</span>
                                                @endif
                                            </td>
                                            <td class="p-4 text-center">
                                                <a href="{{ route('guru.presensi.edit', $item->id_presensi_guru) }}" 
                                                   class="inline-flex items-center justify-center px-3.5 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-lg transition text-xs shadow-sm">
                                                    Ubah Data
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="p-12 text-center text-slate-400 font-medium">Belum ada dokumen rekaman presensi pendidik pada bulan ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- KONTEN TAB: REKAP SISWA -->
                @if($tabAktif == 'siswa')
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-100">
                            <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Rincian Kehadiran Bulanan (Peserta Didik)</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Daftar rekapitulasi kehadiran seluruh siswa pada kelas binaan akademik Anda.</p>
                        </div>

                        {{-- FILTER KELAS KHUSUS REKAP PRESENSI MURID --}}
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <form action="{{ route('presensi.rekap') }}" method="GET" class="flex flex-col sm:flex-row sm:items-end gap-3">
                                <input type="hidden" name="tab" value="siswa">
                                <input type="hidden" name="bulan" value="{{ $bulanPilihan }}">
                                <input type="hidden" name="tahun" value="{{ $tahunPilihan }}">

                                <div class="flex-1 max-w-sm">
                                    <label for="kelas_id" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                                        Pilih Kelas
                                    </label>
                                    <select name="kelas_id" id="kelas_id"
                                            class="w-full bg-white border border-slate-200 text-slate-800 text-xs rounded-xl px-3.5 py-3 focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                                        <option value="">Semua Kelas</option>
                                        @foreach($daftarKelas as $kelas)
                                            <option value="{{ $kelas->id_kelas }}" {{ (string) ($kelasPilihan ?? '') === (string) $kelas->id_kelas ? 'selected' : '' }}>
                                                {{ $kelas->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit"
                                        class="bg-[#2582E5] hover:bg-blue-600 text-white px-5 py-3 rounded-xl text-xs font-bold shadow-md transition-all">
                                    Terapkan Filter
                                </button>

                                <a href="{{ route('presensi.rekap', ['tab' => 'siswa', 'bulan' => $bulanPilihan, 'tahun' => $tahunPilihan]) }}"
                                   class="bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 px-5 py-3 rounded-xl text-xs font-bold transition-all text-center">
                                    Reset Kelas
                                </a>
                            </form>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        <th class="p-4 w-16 text-center">No</th>
                                        <th class="p-4">Nama Peserta Didik</th>
                                        <th class="p-4">Kelas</th>
                                        <th class="p-4">Tanggal</th>
                                        <th class="p-4">Status Kehadiran</th>
                                        <th class="p-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                    @forelse($listPresensiSiswa as $index => $siswa)
                                        <tr class="hover:bg-slate-50/50 transition">
                                            <td class="p-4 text-center font-mono text-slate-400">{{ $index + 1 }}</td>
                                            <td class="p-4 font-extrabold text-slate-900">{{ $siswa->siswa->nama ?? 'Siswa' }}</td>
                                            <td class="p-4 font-bold text-slate-700">{{ $siswa->siswa->kelas->nama_kelas ?? '-' }}</td>
                                            <td class="p-4 font-mono text-slate-600">{{ \Carbon\Carbon::parse($siswa->tanggal)->translatedFormat('d F Y') }}</td>
                                            <td class="p-4 font-bold">
                                                @if($siswa->status == 'Hadir')
                                                    <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-700 font-bold rounded-lg border border-emerald-100">Hadir</span>
                                                @elseif($siswa->status == 'Izin')
                                                    <span class="inline-flex items-center px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-lg border border-amber-100">Izin</span>
                                                @elseif($siswa->status == 'Sakit')
                                                    <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 font-bold rounded-lg border border-blue-100">Sakit</span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg border border-rose-100">{{ $siswa->status == 'Alfa' ? 'Alfa' : 'Tidak Hadir' }}</span>
                                                @endif
                                            </td>
                                            <td class="p-4 text-center">
                                                <a href="{{ route('presensi-siswa.edit', $siswa->id) }}"
                                                   class="inline-flex items-center justify-center px-3.5 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-lg transition text-xs shadow-sm">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="p-12 text-center text-slate-400 font-medium">Belum ada catatan presensi peserta didik yang terekam pada bulan ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </main>

    </div>

</body>
</html>