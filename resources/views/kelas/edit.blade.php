<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR KIRI -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 h-screen shadow-sm">
            <div class="overflow-y-auto flex-1 pr-1 custom-scrollbar">
                <!-- Profil Sidebar -->
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100">
                        S
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-gray-400 truncate max-w-[130px]">{{ Auth::user()->email ?? 'kurikulum@smpn4.sch.id' }}</p>
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
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Master Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Guru</span>
                            </a>
                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition-all duration-200 shadow-sm shadow-indigo-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Data Kelas</span>
                            </a>
                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>
                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Siswa</span>
                            </a>
                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <span>Mata Pelajaran</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Logout -->
            <div class="pt-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-3.5 py-2.5 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA (Full Layar dengan Card Style ala Manajemen Kelas) -->
        <main class="flex-1 overflow-y-auto p-8 lg:p-12">
            <div class="w-full space-y-6">

                <!-- Header Halaman -->
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Edit Kelas</h1>
                    <p class="text-xs text-gray-500 mt-1">Kelola informasi rombongan belajar dan data kelas sekolah secara terpusat.</p>
                </div>

                <!-- Validation Errors Alert -->
                @if($errors->any())
                    <div class="p-4 bg-rose-50 text-rose-800 border border-rose-200/80 rounded-2xl text-xs space-y-1 shadow-sm w-full">
                        @foreach($errors->all() as $error)
                            <p class="font-medium flex items-center gap-2">
                                <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path></svg>
                                <span>{{ $error }}</span>
                            </p>
                        @endforeach
                    </div>
                @endif

                <!-- Form Bungkus dalam Tag HTML Form tunggal -->
                <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Card 1: Informasi Dasar Kelas (Tingkat & Nama Kelas) -->
                    <div class="bg-white rounded-3xl border border-gray-200/80 shadow-sm p-6 lg:p-8 w-full">
                        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Dasar Kelas</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tingkat Kelas -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Tingkat Kelas</label>
                                <select name="tingkat" id="tingkat" required
                                    class="w-full px-4.5 py-3.5 bg-gray-50 border {{ $errors->has('tingkat') ? 'border-rose-500 focus:ring-rose-500' : 'border-gray-200 focus:ring-indigo-600' }} rounded-xl text-sm text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:border-transparent transition-all duration-200">
                                    <option value="7" {{ old('tingkat', $kelas->tingkat) == '7' ? 'selected' : '' }}>Kelas 7</option>
                                    <option value="8" {{ old('tingkat', $kelas->tingkat) == '8' ? 'selected' : '' }}>Kelas 8</option>
                                    <option value="9" {{ old('tingkat', $kelas->tingkat) == '9' ? 'selected' : '' }}>Kelas 9</option>
                                </select>
                                @error('tingkat')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Kelas -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Nama Kelas</label>
                                <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required
                                    placeholder="Contoh: 7A, 8B, 9C"
                                    class="w-full px-4.5 py-3.5 bg-gray-50 border {{ $errors->has('nama_kelas') ? 'border-rose-500 focus:ring-rose-500' : 'border-gray-200 focus:ring-indigo-600' }} rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:border-transparent transition-all duration-200">
                                @error('nama_kelas')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Pengaturan Wali Kelas & Tombol Aksi -->
                    <div class="bg-white rounded-3xl border border-gray-200/80 shadow-sm p-6 lg:p-8 w-full">
                        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Pengaturan Guru Pendamping</h2>
                        <div class="space-y-6">
                            <!-- Wali Kelas -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Wali Kelas</label>
                                <select name="wali_kelas_id" 
                                    class="w-full px-4.5 py-3.5 bg-gray-50 border {{ $errors->has('wali_kelas_id') ? 'border-rose-500 focus:ring-rose-500' : 'border-gray-200 focus:ring-indigo-600' }} rounded-xl text-sm text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:border-transparent transition-all duration-200">
                                    <option value="">-- Pilih Wali Kelas --</option>
                                    @foreach($guruList as $guru)
                                        <option value="{{ $guru->id }}" {{ (old('wali_kelas_id', $kelas->wali_kelas_id) == $guru->id) ? 'selected' : '' }}>
                                            {{ $guru->nama }}
                                            @if($guru->kelas && $guru->kelas->id_kelas != $kelas->id_kelas)
                                                (Sudah di kelas {{ $guru->kelas->nama_kelas }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('wali_kelas_id')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                                <button type="submit"
                                    class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-semibold shadow-sm transition-all duration-200">
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('kelas.index') }}"
                                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-xs font-semibold transition-all duration-200 text-center">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </main>

    </div>

</body>
</html>