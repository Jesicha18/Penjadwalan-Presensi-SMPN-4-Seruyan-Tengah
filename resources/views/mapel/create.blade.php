<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Pelajaran - SMPN 4 Seruyan Tengah</title>
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
                        <p class="text-[10px] text-gray-400 truncate max-w-[130px]">{{ Auth::user()->email ?? 'kurikulum@smpn4.sch.id' }}</p>
                    </div>
                </div>

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
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span>Data Siswa</span>
                            </a>
                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition">
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
                    <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-full">

                <!-- Header Section -->
                <div class="mb-6">
                    <h1 class="text-xl font-bold tracking-tight text-gray-900">Tambah Mata Pelajaran</h1>
                    <p class="text-xs text-gray-500 mt-0.5">Pilih mata pelajaran dari daftar kurikulum sekolah.</p>
                </div>

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 text-rose-800 border border-rose-200 rounded-xl text-xs space-y-1 shadow-sm">
                        @foreach($errors->all() as $error)
                            <p class="font-medium flex items-center gap-2">
                                <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path></svg>
                                <span>{{ $error }}</span>
                            </p>
                        @endforeach
                    </div>
                @endif

                <!-- Form Card Full Lebar -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
                    <form action="{{ route('mapel.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Pilih Mata Pelajaran</label>
                            <select name="nama_mapel" id="nama_mapel" required
                                onchange="updateKodeMapel(this)"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                                <option value="" disabled selected>-- Pilih Mata Pelajaran --</option>
                                <option value="Pendidikan Agama Islam dan Budi Pekerti" data-kode="PAI" {{ old('nama_mapel') == 'Pendidikan Agama Islam dan Budi Pekerti' ? 'selected' : '' }}>Pendidikan Agama Islam dan Budi Pekerti</option>
                                <option value="Pendidikan Pancasila dan Kewarganegaraan" data-kode="PPKN" {{ old('nama_mapel') == 'Pendidikan Pancasila dan Kewarganegaraan' ? 'selected' : '' }}>Pendidikan Pancasila dan Kewarganegaraan</option>
                                <option value="Bahasa Indonesia" data-kode="BIN" {{ old('nama_mapel') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                <option value="Matematika" data-kode="MTK" {{ old('nama_mapel') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                                <option value="Ilmu Pengetahuan Alam" data-kode="IPA" {{ old('nama_mapel') == 'Ilmu Pengetahuan Alam' ? 'selected' : '' }}>Ilmu Pengetahuan Alam</option>
                                <option value="Ilmu Pengetahuan Sosial" data-kode="IPS" {{ old('nama_mapel') == 'Ilmu Pengetahuan Sosial' ? 'selected' : '' }}>Ilmu Pengetahuan Sosial</option>
                                <option value="Bahasa Inggris" data-kode="BIG" {{ old('nama_mapel') == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
                                <option value="Prakarya" data-kode="SBK" {{ old('nama_mapel') == 'Prakarya' ? 'selected' : '' }}>Prakarya</option>
                                <option value="Pendidikan Jasmani, Olahraga, dan Kesehatan" data-kode="PJOK" {{ old('nama_mapel') == 'Pendidikan Jasmani, Olahraga, dan Kesehatan' ? 'selected' : '' }}>Pendidikan Jasmani, Olahraga, dan Kesehatan</option>
                                <option value="Informatika" data-kode="INF" {{ old('nama_mapel') == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                                <option value="Muatan Lokal (Bahasa Dayak/Ketentuan Sekolah)" data-kode="MULOK" {{ old('nama_mapel') == 'Muatan Lokal (Bahasa Dayak/Ketentuan Sekolah)' ? 'selected' : '' }}>Muatan Lokal</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Kode Mapel</label>
                            <input type="text" name="kode_mapel" id="kode_mapel" value="{{ old('kode_mapel') }}" required readonly
                                placeholder="Otomatis terisi..."
                                class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-xs text-gray-700 font-mono focus:outline-none cursor-not-allowed">
                        </div>

                        <!-- Checkbox Prioritas Jam Pagi -->
                        <div class="flex items-center gap-3 p-4 bg-gray-50 border border-gray-200 rounded-xl">
                            <input type="checkbox" name="prioritas_jam_pagi" id="prioritas_jam_pagi" value="1" 
                                {{ old('prioritas_jam_pagi') ? 'checked' : '' }}
                                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <div>
                                <label for="prioritas_jam_pagi" class="text-xs font-semibold text-gray-800 cursor-pointer">Prioritas Jam Pagi</label>
                                <p class="text-[11px] text-gray-500">Centang jika mata pelajaran ini diutamakan untuk dijadwalkan pada sesi jam pelajaran pagi.</p>
                            </div>
                        </div>

                        <!-- Tombol Aksi di Kanan Bawah -->
                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('mapel.index') }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold py-2.5 px-6 rounded-xl border border-gray-200 text-center">
                                Kembali
                            </a>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-2.5 px-6 rounded-xl shadow-sm text-center">
                                Simpan & Proses
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>

    </div>

    <script>
        function updateKodeMapel(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const kode = selectedOption.getAttribute('data-kode') || '';
            document.getElementById('kode_mapel').value = kode;
        }
    </script>

</body>
</html>