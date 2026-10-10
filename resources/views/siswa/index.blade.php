<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Sistem Akademik SMPN 4 Seruyan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR KIRI -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm overflow-y-auto">
            <div>
                <!-- User Profile Header -->
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
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
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
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Master Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Guru</span>
                            </a>
                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Data Kelas</span>
                            </a>
                                                        <!-- Menu Naik Kelas -->
                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>
                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold shadow-sm shadow-indigo-50/50 transition-all duration-200 group">
                                <svg class="w-4 h-4 text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Siswa</span>
                            </a>
                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
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
                    <button type="submit" class="w-full flex items-center space-x-3 px-3.5 py-2.5 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-full">

                <!-- Notifikasi Sukses -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-medium flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Notifikasi Error -->
                @if(session('error'))
                    <div class="mb-6 p-4 bg-rose-50 text-rose-800 border border-rose-200 rounded-xl text-xs font-medium flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{-- KONDISI 1: JIKA KELAS BELUM DIPILIH (MENAMPILKAN PILIHAN KELAS) --}}
                @if(empty($selectedKelas))
                    <div class="mb-6">
                        <h1 class="text-xl font-bold tracking-tight text-gray-900">Manajemen Data Siswa</h1>
                        <p class="text-xs text-gray-500 mt-0.5">Pilih kelas terlebih dahulu untuk melihat daftar siswa aktif SMPN 4 Seruyan.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($kelas as $item)
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 flex flex-col justify-between hover:border-indigo-300 transition-all">
                                <div>
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full font-bold text-xs">
                                            Kelas
                                        </span>
                                        <span class="text-xs font-medium text-gray-400">
                                            {{ $item->siswa_count ?? 0 }} Siswa
                                        </span>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">
                                        {{ $item->nama_kelas ?? $item->nama }}
                                    </h2>
                                    <p class="text-xs text-gray-500 mb-6">
                                        Wali Kelas: 
                                        {{ 
                                            $item->wali_kelas ?? 
                                            ($item->nama_wali ?? 
                                            ($item->guru->nama ?? 
                                            ($item->user->name ?? '-'))) 
                                        }}
                                    </p>
                                </div>
                                <a href="{{ route('siswa.by-kelas', $item->id ?? $item->id_kelas) }}" class="w-full bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white text-center py-2.5 rounded-xl text-xs font-semibold transition-all">
                                    Lihat Daftar Siswa &rarr;
                                </a>
                            </div>
                        @empty
                            <div class="col-span-3 py-12 text-center text-gray-400 bg-white rounded-2xl border border-gray-200 shadow-sm">
                                Belum ada data kelas yang terdaftar di sistem.
                            </div>
                        @endforelse
                    </div>

                {{-- KONDISI 2: JIKA KELAS SUDAH DIPILIH (MENAMPILKAN TABEL SISWA) --}}
                @else
                    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <a href="{{ route('siswa.index') }}" class="text-gray-400 hover:text-gray-600 text-xs font-semibold flex items-center gap-1">
                                    &larr; Kembali ke Pilih Kelas
                                </a>
                            </div>
                            <h1 class="text-xl font-bold tracking-tight text-gray-900">Daftar Siswa - Kelas {{ $selectedKelas->nama_kelas ?? $selectedKelas->nama }}</h1>
                            <p class="text-xs text-gray-500 mt-0.5">Kelola data siswa di kelas ini.</p>
                        </div>
                        
                        <!-- Tombol Aksi (Import & Tambah Siswa) -->
                        <div class="flex items-center gap-3">
                            <!-- Tombol Import Excel -->
                            <a href="{{ route('siswa.import', $selectedKelas->id ?? $selectedKelas->id_kelas) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold py-2.5 px-4 rounded-xl shadow-sm transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <span>Import Excel</span>
                            </a>

                            <!-- Tombol Tambah Siswa Baru -->
                            <a href="{{ route('siswa.create', ['kelas_id' => $selectedKelas->id ?? $selectedKelas->id_kelas]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-2.5 px-4 rounded-xl shadow-sm transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>Tambah Siswa</span>
                            </a>
                        </div>
                    </div>

                    <!-- Fitur Pencarian Tabel Siswa -->
                    <div class="mb-4 bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
                        <div class="w-full max-w-sm relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" id="searchSiswa" placeholder="Cari nama atau NIS siswa..." class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                        </div>
                    </div>

                    <!-- Tabel Daftar Siswa -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-xs" id="tabelSiswa">
                                <thead>
                                    <tr class="bg-gray-50/75 border-b border-gray-100 text-gray-400 font-semibold uppercase tracking-wider text-[10px]">
                                        <th class="py-3.5 px-6">No</th>
                                        <th class="py-3.5 px-6">NIS / NISN</th>
                                        <th class="py-3.5 px-6">Nama Siswa</th>
                                        <th class="py-3.5 px-6">Jenis Kelamin</th>
                                        <th class="py-3.5 px-6">Status</th>
                                        <th class="py-3.5 px-6 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-700">
                                    @forelse($siswaList as $index => $siswa)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="py-4 px-6 text-gray-400 font-medium">{{ $index + 1 }}</td>
                                            <td class="py-4 px-6 font-medium text-gray-900">{{ $siswa->nis ?? '-' }}</td>
                                            <td class="py-4 px-6 font-bold text-gray-900 nama-siswa">{{ $siswa->nama }}</td>
                                            <td class="py-4 px-6 text-gray-500">{{ $siswa->jenis_kelamin ?? '-' }}</td>
                                            <td class="p-4">
                                                @if($siswa->status == 'Aktif')
                                                    <span class="px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-600 rounded-full">Aktif</span>
                                                @elseif($siswa->status == 'Pindah')
                                                    <span class="px-2.5 py-1 text-xs font-semibold bg-amber-50 text-amber-600 rounded-full">Pindah</span>
                                                @else
                                                    <span class="px-2.5 py-1 text-xs font-semibold bg-rose-50 text-rose-600 rounded-full">Berhenti</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-center space-x-2">
                                                <a href="{{ route('siswa.edit', $siswa->id ?? $siswa->id_siswa) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                                <span class="text-gray-300">|</span>
                                                <form action="{{ route('siswa.destroy', $siswa->id ?? $siswa->id_siswa) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus data siswa ini?')" class="text-rose-500 hover:text-rose-700 font-semibold">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="py-12 text-center text-gray-400">
                                                <div class="flex flex-col items-center justify-center space-y-2">
                                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                                    <span>Belum ada data siswa yang terdaftar di kelas ini.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Skrip Sederhana untuk Search Bar Realtime -->
                    <script>
                        document.getElementById('searchSiswa').addEventListener('keyup', function() {
                            let filter = this.value.toLowerCase();
                            let rows = document.querySelectorAll('#tabelSiswa tbody tr');

                            rows.forEach(row => {
                                let text = row.innerText.toLowerCase();
                                if (text.includes(filter)) {
                                    row.style.display = "";
                                } else {
                                    row.style.display = "none";
                                }
                            });
                        });
                    </script>
                @endif

            </div>
        </main>
    </div>

</body>
</html>