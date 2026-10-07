<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Slot Waktu - SMPN 4 Seruyan Tengah</title>
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
                            <!-- Menu Khusus "Buat Jadwal" -->
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>
                            <!-- Menu Utama Jadwal Pelajaran -->
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
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

        <!-- KONTEN UTAMA -->
        <main class="flex-1 flex flex-col overflow-y-auto">
            <!-- Area Formulir (Full seperti layout Mapping Pengampu) -->
            <div class="p-8">
                <!-- Header Halaman di luar kotak (Judul & Subjudul) -->
                <div class="mb-6">
                    <h1 class="text-xl font-bold text-gray-900">Edit Slot Waktu Pelajaran</h1>
                    <p class="text-xs text-gray-500 mt-1">Ubah data hari, jam mulai, jam selesai, jenis slot, atau urutan waktu.</p>
                </div>

                <!-- Kartu Form Full Lebar -->
                <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                    <form action="{{ route('slot-waktu.update', $slotWaktu->id) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')
                        
                        <!-- Hari -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Hari</label>
                            <select name="hari" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $h)
                                    <option value="{{ $h }}" {{ old('hari', $slotWaktu->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                                @endforeach
                            </select>
                            @error('hari')
                                <p class="mt-1 text-[10px] text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Mulai & Jam Selesai -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Jam Mulai</label>
                                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $slotWaktu->jam_mulai ? \Carbon\Carbon::parse($slotWaktu->jam_mulai)->format('H:i') : '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                @error('jam_mulai')
                                    <p class="mt-1 text-[10px] text-rose-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Jam Selesai</label>
                                <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $slotWaktu->jam_selesai ? \Carbon\Carbon::parse($slotWuntut->jam_selesai ?? $slotWaktu->jam_selesai)->format('H:i') : '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                @error('jam_selesai')
                                    <p class="mt-1 text-[10px] text-rose-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Jenis Slot -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Jenis Slot</label>
                            <select name="jenis" id="jenisSlot" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="jp" {{ old('jenis', $slotWaktu->jenis) == 'jp' ? 'selected' : '' }}>Jam Pelajaran (JP - Tempat Algoritma Menaruh Jadwal)</option>
                                <option value="istirahat" {{ old('jenis', $slotWaktu->jenis) == 'istirahat' ? 'selected' : '' }}>Istirahat</option>
                                <option value="terkunci" {{ old('jenis', $slotWaktu->jenis) == 'terkunci' ? 'selected' : '' }}>Terkunci (Upacara / Senam / Pramuka)</option>
                            </select>
                            @error('jenis')
                                <p class="mt-1 text-[10px] text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                        </div>

                        <!-- Keterangan / Label -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Keterangan / Label (Opsional)</label>
                            <input type="text" name="keterangan" value="{{ old('keterangan', $slotWaktu->keterangan) }}" placeholder="Contoh: Upacara Bendera / Istirahat Pertama" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('keterangan')
                                <p class="mt-1 text-[10px] text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Urutan (Nomor Urut Blok Harian)</label>
                            
                            <!-- Input dengan border merah otomatis jika ada error -->
                            <input type="number" name="urutan" value="{{ old('urutan', $urutanSaran ?? 1) }}" 
                                class="w-full px-4 py-2.5 bg-gray-50 border @error('urutan') border-rose-500 ring-1 ring-rose-500 @else border-gray-200 @enderror rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500" required>

                            <!-- Pesan Peringatan Merah -->
                            @error('urutan')
                                <p class="text-rose-500 text-[11px] mt-1.5 flex items-center gap-1 font-medium">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('slot-waktu.index', ['hari' => $slotWaktu->hari]) }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-xl text-xs font-semibold transition">Batal</a>
                            <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

</body>
</html>