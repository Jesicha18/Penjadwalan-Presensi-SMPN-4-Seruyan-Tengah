<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapping Pengampu - Kurikulum System</title>
    <!-- Tailwind CSS CDN -->
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

        <!-- KONTEN UTAMA DI SEBELAH KANAN -->
        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-xl font-bold tracking-tight text-gray-900">Mapping Pengampu Guru & Mapel</h1>
                        <p class="text-xs text-gray-500 mt-0.5">Daftar alokasi beban mengajar guru di setiap kelas.</p>
                    </div>
                    <a href="{{ route('mapping.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-2.5 px-4 rounded-xl shadow-sm transition-all">
                        + Tambah Mapping
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-gray-100 text-gray-400 uppercase tracking-wider">
                                <th class="py-3 px-4 font-semibold">No</th>
                                <th class="py-3 px-4 font-semibold">Nama Guru</th>
                                <th class="py-3 px-4 font-semibold">Mata Pelajaran</th>
                                <th class="py-3 px-4 font-semibold">Kelas</th>
                                <th class="py-3 px-4 font-semibold">Alokasi JP / Minggu</th>
                                <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            @forelse($mappings as $index => $map)
                            <tr>
                                <td class="py-3 px-4 text-gray-400">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 font-medium">{{ optional($map->guru)->nama ?? optional($map->guru)->name ?? '-' }}</td>
                                <td class="py-3 px-4">{{ optional($map->mataPelajaran)->nama_mapel ?? optional($map->mataPelajaran)->nama ?? '-' }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 bg-gray-100 font-semibold rounded-md">{{ optional($map->kelas)->nama_kelas ?? optional($map->kelas)->nama ?? '-' }}</span>
                                </td>
                                <td class="py-3 px-4 font-bold text-indigo-600">{{ $map->jumlah_jp }} JP</td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('mapping.edit', $map->id) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 font-semibold rounded-lg transition text-xs">
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('mapping.destroy', $map->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus mapping ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 font-semibold rounded-lg transition text-xs">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-400">Belum ada data mapping pengampu. Silakan tambahkan baru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- TABEL RINGKASAN / REKAP BEBAN MENGAJAR & EKUIVALENSI -->
                <div class="mb-8 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">
                        Rekapitulasi Beban Mengajar & Ekuivalensi JP Guru
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 border-b border-gray-100">
                                    <th class="p-3">Nama Guru</th>
                                    <th class="p-3">Status / Jabatan</th>
                                    <th class="p-3 text-center">Target JP (Regulasi)</th>
                                    <th class="p-3 text-center">Total JP Ter-mapping</th>
                                    <th class="p-3 text-center">Status Beban</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-600">
                                @foreach($rekapGuru as $rekap)
                                <tr>
                                    <td class="p-3 font-semibold text-gray-900">{{ $rekap['guru']->nama }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-0.5 bg-gray-100 rounded-md text-[10px] font-medium text-gray-700">
                                            {{ $rekap['keterangan_tugas'] }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center font-bold text-gray-700">{{ $rekap['batas_maksimal'] }} JP</td>
                                    <td class="p-3 text-center font-mono font-bold text-indigo-600">{{ $rekap['total_jp'] }} JP</td>
                                    <td class="p-3 text-center">
                                        @if($rekap['status_beban'] == 'Pas')
                                            <span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-lg border border-green-200 font-semibold text-[10px]">
                                                Pas (Terpenuhi)
                                            </span>
                                        @elseif($rekap['status_beban'] == 'Kurang')
                                            <span class="px-2.5 py-1 bg-amber-50 text-amber-700 rounded-lg border border-amber-200 font-semibold text-[10px]">
                                                Kurang (-{{ $rekap['batas_maksimal'] - $rekap['total_jp'] }} JP)
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 bg-rose-50 text-rose-700 rounded-lg border border-rose-200 font-semibold text-[10px]">
                                                Kelebihan (+{{ $rekap['total_jp'] - $rekap['batas_maksimal'] }} JP)
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('dashboard.waka') }}"
                        class="inline-flex items-center gap-2 text-xs font-medium text-gray-600 hover:text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                        </svg>
                        Kembali ke Dashboard
                    </a>

                    <span class="text-[11px] text-gray-400 font-mono">
                        Sistem Informasi Akademik SMPN 4 Seruyan Tengah
                    </span>
                </div>
            </div>
        </main>

    </div>

</body>
</html>