<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Presensi Bulanan - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex min-h-screen overflow-x-hidden">
        
        <!-- SIDEBAR KIRI GURU -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100">
                        G
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-gray-400 truncate max-w-[130px]">{{ Auth::user()->email ?? 'guru@smpn4seruyan.sch.id' }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Sidebar -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard.guru') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('guru.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <!-- Jadwal Pelajaran -->
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Aktivitas Mengajar</p>
                        <nav class="space-y-1">
                            <!-- Presensi Guru -->
                            <a href="{{ route('guru.presensi') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Presensi Guru</span>
                            </a>
                            <!-- Presensi Siswa -->
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Presensi Siswa</span>
                            </a>
                            <!-- Rekap Bulanan (Aktif) -->
                            <a href="{{ route('presensi.rekap') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                <span>Rekap Bulanan</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Keluar Akun -->
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

        <!-- KONTEN UTAMA -->
        <main class="flex-1 bg-slate-50/50 p-10 overflow-y-auto">
            <div class="max-w-6xl mx-auto space-y-8">
                
                <!-- Header Halaman -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm">
                    <div class="space-y-1">
                        <h1 class="text-xl font-bold tracking-tight text-gray-900">Rekapitulasi Presensi Bulanan</h1>
                        <p class="text-xs text-gray-500">Kelola dan pantau laporan kehadiran pendidik serta peserta didik secara berkala.</p>
                    </div>
                    
                    <!-- Form Filter Periode Laporan -->
                    <form action="{{ route('presensi.rekap') }}" method="GET" class="flex flex-wrap items-center gap-2.5 bg-gray-50/80 p-2 rounded-xl border border-gray-200/60">
                        <input type="hidden" name="tab" value="{{ $tabAktif }}">
                        
                        <div class="flex items-center space-x-2 px-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-xs font-medium text-gray-600">Periode:</span>
                        </div>

                        <select name="bulan" class="px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-xs">
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

                        <select name="tahun" class="px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-xs">
                            @for($y = date('Y'); $y >= date('Y') - 2; $y--)
                                <option value="{{ $y }}" {{ $tahunPilihan == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>

                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-xs font-semibold shadow-sm transition">
                            Terapkan
                        </button>
                    </form>
                </div>

                <!-- Tab Navigasi Kategori (Guru vs Murid) -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('presensi.rekap', ['tab' => 'guru', 'bulan' => $bulanPilihan, 'tahun' => $tahunPilihan]) }}" 
                       class="flex items-center gap-2 px-5 py-3 rounded-2xl text-xs font-bold transition shadow-xs {{ $tabAktif == 'guru' ? 'bg-indigo-600 text-white shadow-indigo-100' : 'bg-white text-gray-600 border border-gray-200/80 hover:bg-gray-50' }}">
                        <span>👤</span>
                        <span>Rekap Presensi Guru</span>
                    </a>
                    <a href="{{ route('presensi.rekap', ['tab' => 'siswa', 'bulan' => $bulanPilihan, 'tahun' => $tahunPilihan]) }}" 
                       class="flex items-center gap-2 px-5 py-3 rounded-2xl text-xs font-bold transition shadow-xs {{ $tabAktif == 'siswa' ? 'bg-indigo-600 text-white shadow-indigo-100' : 'bg-white text-gray-600 border border-gray-200/80 hover:bg-gray-50' }}">
                        <span>🎓</span>
                        <span>Rekap Presensi Murid</span>
                    </a>
                </div>

                <!-- KONTEN TAB: REKAP GURU -->
                @if($tabAktif == 'guru')
                    <!-- Statistik Ringkasan Guru (Ditambah Tidak Hadir / Alpa) -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
                        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Hadir</p>
                                <h3 class="text-3xl font-extrabold text-emerald-600">{{ $statistikGuru['hadir'] ?? 0 }} <span class="text-xs font-medium text-gray-400">Hari</span></h3>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Izin</p>
                                <h3 class="text-3xl font-extrabold text-amber-600">{{ $statistikGuru['izin'] ?? 0 }} <span class="text-xs font-medium text-gray-400">Hari</span></h3>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Sakit</p>
                                <h3 class="text-3xl font-extrabold text-blue-600">{{ $statistikGuru['sakit'] ?? 0 }} <span class="text-xs font-medium text-gray-400">Hari</span></h3>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tidak Hadir </p>
                                <h3 class="text-3xl font-extrabold text-rose-600">{{ $statistikGuru['alpa'] ?? 0 }} <span class="text-xs font-medium text-gray-400">Hari</span></h3>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Rekap Guru -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-sm text-gray-900">Rincian Kehadiran Bulanan (Pendidik)</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Catatan log kehadiran harian Anda selama periode terpilih.</p>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/75 border-b border-gray-100 text-gray-400 text-[11px] uppercase tracking-wider font-semibold">
                                        <th class="py-3.5 px-6">No</th>
                                        <th class="py-3.5 px-6">Tanggal Presensi</th>
                                        <th class="py-3.5 px-6">Status Kehadiran</th>
                                        <th class="py-3.5 px-6 text-center">Aksi Konfirmasi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-xs text-gray-700 divide-y divide-gray-100">
                                    @forelse($listPresensiGuru as $index => $item)
                                        <tr class="hover:bg-gray-50/50 transition">
                                            <td class="py-4 px-6 text-gray-400 font-medium">{{ $index + 1 }}</td>
                                            <td class="py-4 px-6 font-semibold text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                            <td class="py-4 px-6">
                                                @if($item->status_kehadiran == 'Hadir')
                                                    <span class="inline-flex items-center px-2.5 py-1 bg-emerald-50 text-emerald-700 font-bold rounded-lg border border-emerald-100">Hadir</span>
                                                @elseif($item->status_kehadiran == 'Izin')
                                                    <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 text-amber-700 font-bold rounded-lg border border-amber-100">Izin</span>
                                                @elseif($item->status_kehadiran == 'Sakit')
                                                    <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 font-bold rounded-lg border border-blue-100">Sakit</span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg border border-rose-100">Tidak Hadir</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                <a href="{{ route('guru.presensi.edit', $item->id_presensi_guru) }}" 
                                                   class="inline-flex items-center justify-center px-3 py-1.5 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-lg transition border border-gray-200 shadow-sm">
                                                    Ubah Data
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-12 text-center text-gray-400 italic">Belum ada dokumen rekaman presensi pendidik pada bulan ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- KONTEN TAB: REKAP SISWA -->
                @if($tabAktif == 'siswa')
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h3 class="font-bold text-sm text-gray-900">Rincian Kehadiran Bulanan (Peserta Didik)</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Daftar rekapitulasi kehadiran seluruh siswa pada kelas binaan akademik Anda.</p>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/75 border-b border-gray-100 text-gray-400 text-[11px] uppercase tracking-wider font-semibold">
                                        <th class="py-3.5 px-6">No</th>
                                        <th class="py-3.5 px-6">Nama Peserta Didik</th>
                                        <th class="py-3.5 px-6">Kelas</th>
                                        <th class="py-3.5 px-6">Tanggal</th>
                                        <th class="py-3.5 px-6">Status Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody class="text-xs text-gray-700 divide-y divide-gray-100">
                                    @forelse($listPresensiSiswa as $index => $siswa)
                                        <tr class="hover:bg-gray-50/50 transition">
                                            <td class="py-4 px-6 text-gray-400 font-medium">{{ $index + 1 }}</td>
                                            <td class="py-4 px-6 font-semibold text-gray-900">{{ $siswa->siswa->nama ?? 'Siswa' }}</td>
                                            <td class="py-4 px-6 text-gray-600 font-medium">{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                            <td class="py-4 px-6 text-gray-600">{{ \Carbon\Carbon::parse($siswa->tanggal)->translatedFormat('d F Y') }}</td>
                                            <td class="py-4 px-6 font-bold">
                                                @if($siswa->status == 'Hadir')
                                                    <span class="inline-flex items-center px-2.5 py-1 bg-emerald-50 text-emerald-700 font-bold rounded-lg border border-emerald-100">Hadir</span>
                                                @elseif($siswa->status == 'Izin')
                                                    <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 text-amber-700 font-bold rounded-lg border border-amber-100">Izin</span>
                                                @elseif($siswa->status == 'Sakit')
                                                    <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 font-bold rounded-lg border border-blue-100">Sakit</span>
                                                @else
                                                    <!-- Badge khusus untuk Tidak Hadir / Alpa -->
                                                    <span class="inline-flex items-center px-2.5 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg border border-rose-100">Tidak Hadir</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-12 text-center text-gray-400 italic">Belum ada catatan presensi peserta didik yang terekam pada bulan ini.</td>
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