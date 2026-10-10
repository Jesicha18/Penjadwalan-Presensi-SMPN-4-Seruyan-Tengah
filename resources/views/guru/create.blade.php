<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Memastikan transisi global dan pergerakan elemen terasa sangat halus */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>
<body class="bg-[#F8F9FA] font-sans text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- 1. SIDEBAR KIRI -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 select-none">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100 transition-all duration-300 ease-in-out hover:scale-105">
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
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Master Data</p>
                        <nav class="space-y-1">
                            <!-- Data Guru (Aktif) -->
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold shadow-sm shadow-indigo-50/50 transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Guru</span>
                            </a>
                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Data Kelas</span>
                            </a>
                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>
                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Siswa</span>
                            </a>
                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50/50 hover:text-indigo-600 rounded-xl text-xs font-medium transition-all duration-200 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
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
                    <button type="submit" class="w-full flex items-center space-x-3 px-3.5 py-2.5 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition-all duration-300 ease-in-out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- 2. KONTEN UTAMA -->
        <main class="flex-1 overflow-y-auto p-8 selection:bg-indigo-500 selection:text-white">
            
            <!-- Header Atas -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Tambah Guru</h2>
                <p class="text-xs text-gray-400 mt-0.5">Masukkan data lengkap tenaga pengajar baru ke dalam sistem.</p>
            </div>

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-50 text-rose-800 border border-rose-200 rounded-xl text-xs space-y-1 shadow-sm transition-all duration-300 ease-in-out">
                    @foreach($errors->all() as $error)
                        <p class="font-medium flex items-center gap-2">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path></svg>
                            <span>{{ $error }}</span>
                        </p>
                    @endforeach
                </div>
            @endif

            <!-- Form Card Full Width -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 transition-all duration-300 ease-in-out">
                <form action="{{ route('guru.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Pilih Akun User -->
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Pilih Akun User (Login)</label>
                        <select name="user_id" id="user_id" required onchange="autofillNama(this)"
                            class="w-full px-4 py-3 bg-gray-50/75 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 ease-in-out @error('user_id') border-rose-500 @enderror">
                            <option value="" disabled selected>-- Pilih Akun User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id_user ?? $user->id }}" data-nama="{{ $user->name }}" {{ old('user_id') == ($user->id_user ?? $user->id) ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-[11px] text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Induk Pegawai (NIP) -->
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" name="nip" value="{{ old('nip') }}" required
                            placeholder="Contoh: 198501012010011002"
                            class="w-full px-4 py-3 bg-gray-50/75 border border-gray-200 rounded-xl text-xs text-gray-900 placeholder:text-gray-400 font-mono focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 ease-in-out @error('nip') border-rose-500 @enderror">
                        @error('nip')
                            <p class="mt-1 text-[11px] text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Kepegawaian (Baru) -->
                    <div>
                        <label for="status_kepegawaian" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                            Status Kepegawaian
                        </label>
                        <select name="status_kepegawaian" id="status_kepegawaian" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition" required>
                            <option value="" disabled selected>-- Pilih Status Kepegawaian --</option>
                            <option value="PNS" {{ old('status_kepegawaian', $guru->status_kepegawaian ?? '') == 'PNS' ? 'selected' : '' }}>
                                PNS
                            </option>
                            <option value="P3K" {{ old('status_kepegawaian', $guru->status_kepegawaian ?? '') == 'P3K' ? 'selected' : '' }}>
                                P3K
                            </option>
                            <option value="Honor" {{ old('status_kepegawaian', $guru->status_kepegawaian ?? '') == 'Honor' ? 'selected' : '' }}>
                                Honor
                            </option>
                        </select>
                        @error('status_kepegawaian')
                            <p class="mt-1 text-[10px] text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <!--  -->

                    <div>
                        <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Status Sertifikasi</label>
                        <select name="status_sertifikasi" id="status_sertifikasi" required
                            class="w-full px-4 py-3 bg-gray-50/75 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 ease-in-out @error('status_sertifikasi') border-rose-500 @enderror">
                            <option value="" disabled selected>-- Pilih Status Sertifikasi --</option>
                            <option value="Sudah Sertifikasi" {{ old('status_sertifikasi') == 'Sudah Sertifikasi' ? 'selected' : '' }}>Sudah Sertifikasi</option>
                            <option value="Belum Sertifikasi" {{ old('status_sertifikasi') == 'Belum Sertifikasi' ? 'selected' : '' }}>Belum Sertifikasi</option>
                        </select>
                        @error('status_sertifikasi')
                            <p class="mt-1 text-[11px] text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan Struktural (Baru) -->
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Jabatan Struktural</label>
                        <select name="jabatan_struktural" id="jabatan_struktural" required
                            class="w-full px-4 py-3 bg-gray-50/75 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 ease-in-out @error('jabatan_struktural') border-rose-500 @enderror">
                            <option value="" disabled {{ old('jabatan_struktural', $guru->jabatan_struktural ?? '') == '' ? 'selected' : '' }}>-- Pilih Jabatan Struktural --</option>
                            <option value="Tidak Ada" {{ old('jabatan_struktural', $guru->jabatan_struktural ?? '') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                            <option value="Wakil Kepala Sekolah Bidang Kurikulum" {{ old('jabatan_struktural', $guru->jabatan_struktural ?? '') == 'Wakil Kepala Sekolah Bidang Kurikulum' ? 'selected' : '' }}>Wakil Kepala Sekolah Bidang Kurikulum</option>
                            <option value="Wakil Kepala Sekolah Bidang Kesiswaan" {{ old('jabatan_struktural', $guru->jabatan_struktural ?? '') == 'Wakil Kepala Sekolah Bidang Kesiswaan' ? 'selected' : '' }}>Wakil Kepala Sekolah Bidang Kesiswaan</option>
                            <option value="Wakil Kepala Sekolah Bidang Sarana & Prasarana" {{ old('jabatan_struktural', $guru->jabatan_struktural ?? '') == 'Wakil Kepala Sekolah Bidang Sarana & Prasarana' ? 'selected' : '' }}>Wakil Kepala Sekolah Bidang Sarana & Prasarana</option>
                            <option value="Pengelola Perpustakaan" {{ old('jabatan_struktural', $guru->jabatan_struktural ?? '') == 'Pengelola Perpustakaan' ? 'selected' : '' }}>Pengelola Perpustakaan</option>
                            <option value="Pengelola Laboratorium" {{ old('jabatan_struktural', $guru->jabatan_struktural ?? '') == 'Pengelola Laboratorium' ? 'selected' : '' }}>Pengelola Laboratorium</option>
                        </select>
                        @error('jabatan_struktural')
                            <p class="mt-1 text-[11px] text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap & Gelar (Otomatis dari Pilihan User) -->
                    <div>
                        <label for="nama" class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Nama Lengkap & Gelar</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required readonly
                            placeholder="Otomatis terisi setelah memilih Akun User"
                            class="w-full px-4 py-3 bg-gray-100/75 border border-gray-200 rounded-xl text-xs text-gray-700 cursor-not-allowed focus:outline-none transition-all duration-200 ease-in-out @error('nama') border-rose-500 @enderror">
                        @error('nama')
                            <p class="mt-1 text-[11px] text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-5 py-2.5 rounded-xl shadow-md shadow-indigo-100 transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                            Simpan Data
                        </button>
                        <a href="{{ route('guru.index') }}"
                            class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-5 py-2.5 rounded-xl border border-gray-200 transition-all duration-300 ease-in-out hover:bg-gray-200/80">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>

    </div>

    <!-- JavaScript Autofill Nama & Pengecekan Saat Reload -->
    <script>
        function autofillNama(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const namaGuru = selectedOption.getAttribute('data-nama');
            const inputNama = document.getElementById('nama');

            if (namaGuru && inputNama) {
                inputNama.value = namaGuru;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const userSelect = document.getElementById('user_id');
            if (userSelect && userSelect.value) {
                autofillNama(userSelect);
            }
        });
    </script>
</body>
</html>