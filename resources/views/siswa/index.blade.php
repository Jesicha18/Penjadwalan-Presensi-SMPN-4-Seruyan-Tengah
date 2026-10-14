<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Sistem Akademik SMPN 4 Seruyan</title>
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
                <!-- User Profile Header -->
<!-- User Profile Header / Logo Sekolah -->
<div class="flex items-center space-x-3 mb-8 px-2">
    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md p-1 shrink-0">
        <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
    </div>
    <div>
        <h1 class="text-xs font-bold tracking-wider text-white">SMPN 4 SERUYAN</h1>
        <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">{{ Auth::user()->email ?? 'kurikulum@smpn4.sch.id' }}</p>
    </div>
</div>

                <!-- Navigasi Menu -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('waka.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <!-- Buat Jadwal -->
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>
                            <!-- Jadwal Pelajaran -->
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Master Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Guru</span>
                            </a>
                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Data Kelas</span>
                            </a>
                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>
                            <!-- Data Siswa (Aktif) -->
                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Siswa</span>
                            </a>
                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332 1.253-4.5 1.253"/></svg>
                                <span>Mata Pelajaran</span>
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

                <!-- Notifikasi Sukses -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Notifikasi Error -->
                @if(session('error'))
                    <div class="p-4 bg-rose-50 text-rose-800 border border-rose-200 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{-- KONDISI 1: JIKA KELAS BELUM DIPILIH (MENAMPILKAN PILIHAN KELAS) --}}
                @if(empty($selectedKelas))
                    <div class="pb-4 border-b border-slate-200">
                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Manajemen Data Siswa</h1>
                        <p class="text-xs text-slate-400 mt-0.5">Pilih kelas terlebih dahulu untuk melihat daftar siswa aktif SMPN 4 Seruyan.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($kelas as $item)
                            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between hover:border-blue-300 transition-all">
                                <div>
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="px-3 py-1 bg-blue-50 text-[#2582E5] rounded-full font-bold text-xs">
                                            Kelas
                                        </span>
                                        <span class="text-xs font-semibold text-slate-400">
                                            {{ $item->siswa_count ?? 0 }} Siswa
                                        </span>
                                    </div>
                                    <h2 class="text-lg font-extrabold text-slate-900 mb-1">
                                        {{ $item->nama_kelas ?? $item->nama }}
                                    </h2>
                                    <p class="text-xs text-slate-500 mb-6 font-medium">
                                        Wali Kelas: 
                                        {{ 
                                            $item->wali_kelas ?? 
                                            ($item->nama_wali ?? 
                                            ($item->guru->nama ?? 
                                            ($item->user->name ?? '-'))) 
                                        }}
                                    </p>
                                </div>
                                <a href="{{ route('siswa.by-kelas', $item->id ?? $item->id_kelas) }}" class="w-full bg-blue-50 hover:bg-[#2582E5] text-[#2582E5] hover:text-white text-center py-2.5 rounded-xl text-xs font-bold transition-all">
                                    Lihat Daftar Siswa &rarr;
                                </a>
                            </div>
                        @empty
                            <div class="col-span-3 py-12 text-center text-slate-400 bg-white rounded-2xl border border-slate-100 shadow-sm font-medium">
                                Belum ada data kelas yang terdaftar di sistem.
                            </div>
                        @endforelse
                    </div>

                {{-- KONDISI 2: JIKA KELAS SUDAH DIPILIH (MENAMPILKAN TABEL SISWA) --}}
                @else
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-4 border-b border-slate-200">
                        <div>
                            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Daftar Siswa - Kelas {{ $selectedKelas->nama_kelas ?? $selectedKelas->nama }}</h1>
                            <p class="text-xs text-slate-400 mt-0.5">Kelola data siswa di kelas ini.</p>
                        </div>
                        
                        <!-- Tombol Aksi (Import & Tambah Siswa) -->
                        <div class="flex items-center gap-3">
                            <!-- Tombol Import Excel -->
                            <a href="{{ route('siswa.import', $selectedKelas->id ?? $selectedKelas->id_kelas) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-2.5 px-4 rounded-xl shadow-sm transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <span>Import Excel</span>
                            </a>

                            <!-- Tombol Tambah Siswa Baru -->
                            <a href="{{ route('siswa.create', ['kelas_id' => $selectedKelas->id ?? $selectedKelas->id_kelas]) }}" class="bg-[#2582E5] hover:bg-blue-600 text-white text-xs font-bold py-2.5 px-4 rounded-xl shadow-sm transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>Tambah Siswa</span>
                            </a>
                        </div>
                    </div>

                    <!-- Fitur Pencarian Tabel Siswa -->
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                        <div class="w-full max-w-sm relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" id="searchSiswa" placeholder="Cari nama atau NIS siswa..." class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                        </div>
                    </div>

                    <!-- Tabel Daftar Siswa -->
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-xs" id="tabelSiswa">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider text-[11px]">
                                        <th class="py-3.5 px-6">No</th>
                                        <th class="py-3.5 px-6">NIS / NISN</th>
                                        <th class="py-3.5 px-6">Nama Siswa</th>
                                        <th class="py-3.5 px-6">Jenis Kelamin</th>
                                        <th class="py-3.5 px-6">Status</th>
                                        <th class="py-3.5 px-6 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-700">
                                    @forelse($siswaList as $index => $siswa)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="py-4 px-6 text-slate-400 font-medium">{{ $index + 1 }}</td>
                                            <td class="py-4 px-6 font-mono font-medium text-slate-600">{{ $siswa->nis ?? '-' }}</td>
                                            <td class="py-4 px-6 font-bold text-slate-900 nama-siswa">{{ $siswa->nama }}</td>
                                            <td class="py-4 px-6 text-slate-500 font-medium">{{ $siswa->jenis_kelamin ?? '-' }}</td>
                                            <td class="py-4 px-6">
                                                @if($siswa->status == 'Aktif')
                                                    <span class="px-2.5 py-1 text-[11px] font-bold bg-emerald-50 text-emerald-600 rounded-full">Aktif</span>
                                                @elseif($siswa->status == 'Pindah')
                                                    <span class="px-2.5 py-1 text-[11px] font-bold bg-amber-50 text-amber-600 rounded-full">Pindah</span>
                                                @else
                                                    <span class="px-2.5 py-1 text-[11px] font-bold bg-rose-50 text-rose-600 rounded-full">Berhenti</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-center space-x-2">
                                                <a href="{{ route('siswa.edit', $siswa->id ?? $siswa->id_siswa) }}" class="text-[#2582E5] hover:text-blue-700 font-bold">Edit</a>
                                                <span class="text-slate-300">|</span>
                                                <form action="{{ route('siswa.destroy', $siswa->id ?? $siswa->id_siswa) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus data siswa ini?')" class="text-rose-500 hover:text-rose-700 font-bold">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="py-12 text-center text-slate-400 font-medium">
                                                <div class="flex flex-col items-center justify-center space-y-2">
                                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                                    <span>Belum ada data siswa yang terdaftar di kelas ini.</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                                                <div class="flex items-center gap-3 mb-1">
                                <a href="{{ route('siswa.index') }}" class="text-slate-400 hover:text-slate-600 text-xs font-bold flex items-center gap-1">
                                    &larr; Kembali ke Pilih Kelas
                                </a>
                            </div>

                    <!-- Skrip Sederhana untuk Search Bar Realtime -->
                    <script>
                        document.getElementById('searchSiswa')?.addEventListener('keyup', function() {
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