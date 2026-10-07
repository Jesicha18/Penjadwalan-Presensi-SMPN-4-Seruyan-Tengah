<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Naik Kelas - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- 1. SIDEBAR KIRI -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm overflow-y-auto">
            <div>
                <!-- Logo & Identitas -->
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100">
                        S
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-gray-400 truncate max-w-[130px]">{{ Auth::user()->email ?? 'kurikulum@smpn4.sch.id' }}</p>
                    </div>
                </div>

                <!-- Navigasi -->
                <div class="space-y-6">
                    <!-- Menu Utama -->
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
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Master Data -->
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
                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>
                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Siswa</span>
                            </a>
                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <span>Mata Pelajaran</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Logout -->
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center space-x-3 px-3 py-2 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- 2. KONTEN UTAMA TENGAH -->
        <main class="flex-1 overflow-y-auto p-8">
            <!-- Header Atas -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Manajemen Kenaikan Kelas</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Kelola kenaikan tingkat siswa secara massal dengan mudah dan terstruktur.</p>
                </div>
            </div>

            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Notifikasi Error / Gagal -->
            @if(session('error'))
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl text-xs font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Card Pilihan Kelas -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-8">
                <form method="GET" action="{{ route('siswa.naik-kelas') }}">
                    <div class="max-w-xl">
                        <label for="kelas_id" class="flex items-center space-x-2 text-xs font-bold text-gray-700 uppercase tracking-wider mb-2.5">
                            <span>Pilih Kelas Asal Siswa</span>
                        </label>
                        <div class="relative">
                            <select name="kelas_id" id="kelas_id" 
                                class="w-full bg-gray-50/50 hover:bg-gray-50 border border-gray-200 text-gray-800 text-xs rounded-xl p-3.5 pr-10 focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer" 
                                onchange="this.form.submit()">
                                <option value="">-- Pilih Kelas Asal --</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id_kelas }}" {{ $selectedKelasId == $kelas->id_kelas ? 'selected' : '' }}>
                                        Kelas {{ $kelas->nama_kelas }} (Tingkat {{ $kelas->tingkat }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-2">Pilih kelas asal terlebih dahulu untuk menampilkan daftar siswa di dalam kelas tersebut.</p>
                    </div>
                </form>
            </div>

            <!-- Jika Kelas Asal Dipilih dan Ada Siswanya -->
            @if(!empty($siswaList) && count($siswaList) > 0)
            <form action="{{ route('siswa.proses-naik-kelas') }}" method="POST">
                @csrf
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
                    <div class="mb-6 max-w-xl">
                        <label for="kelas_tujuan_id" class="flex items-center space-x-2 text-xs font-bold text-gray-700 uppercase tracking-wider mb-2.5">
                            <span>Pindahkan ke Kelas Tujuan</span>
                        </label>
                        <div class="relative">
                            <select name="kelas_tujuan_id" id="kelas_tujuan_id" 
                                class="w-full bg-gray-50/50 hover:bg-gray-100 border border-gray-200 text-gray-800 text-xs rounded-xl p-3.5 pr-10 focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer" required>
                                <option value="">-- Pilih Kelas Tujuan --</option>
                                
                                @foreach($listKelasTujuan as $kelas)
                                    <option value="{{ $kelas->id_kelas }}">
                                        Kelas {{ $kelas->nama_kelas }} (Tingkat {{ $kelas->tingkat }})
                                    </option>
                                @endforeach

                                @if(isset($kelasAsal) && $kelasAsal->tingkat == 9)
                                    <option value="lulus" class="font-bold text-indigo-600 bg-indigo-50/50"> Lulus / Pindahkan ke Alumni</option>
                                @endif
                            </select>                    
                        </div>
                        <p class="text-[11px] text-gray-400 mt-2">Pilih tingkat kelas lanjutan atau opsi kelulusan untuk siswa yang dipilih di bawah.</p>
                    </div>

                    <!-- Tabel Daftar Siswa -->
                    <div class="overflow-x-auto rounded-xl border border-gray-100">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-[11px] text-gray-400 uppercase tracking-wider border-b border-gray-100">
                                    <th class="p-4 text-center w-12">
                                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer" checked>
                                    </th>
                                    <th class="p-4">NIS</th>
                                    <th class="p-4">Nama Siswa</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-xs">
                                @foreach($siswaList as $siswa)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="p-4 text-center">
                                        <input type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}" class="siswa-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer" checked>
                                    </td>
                                    <td class="p-4 font-medium text-gray-600">{{ $siswa->nis ?? '-' }}</td>
                                    <td class="p-4 font-bold text-gray-800">{{ $siswa->nama ?? $siswa->nama_siswa ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-indigo-100 transition">
                            Proses Naik Kelas
                        </button>
                    </div>
                </div>
            </form>
            @elseif($selectedKelasId)
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm text-center">
                    <p class="text-xs text-gray-400">Tidak ada siswa yang ditemukan di kelas ini.</p>
                </div>
            @else
                <div class="bg-white p-12 rounded-2xl border border-gray-100 shadow-sm text-center">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-3 text-lg font-bold">🎓</div>
                    <h4 class="text-xs font-bold text-gray-800">Silakan Pilih Kelas Asal</h4>
                    <p class="text-[11px] text-gray-400 mt-1">Pilih kelas pada pilihan di atas untuk menampilkan daftar siswa yang akan dinaikkan tingkatnya.</p>
                </div>
            @endif
        </main>

    </div>

    <!-- Script Pilih Semua (Select All) -->
    <script>
        document.getElementById('select-all')?.addEventListener('change', function(e) {
            let checkboxes = document.querySelectorAll('.siswa-checkbox');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });
    </script>
</body>
</html>