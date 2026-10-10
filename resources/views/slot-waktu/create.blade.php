<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Slot Waktu - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR KIRI -->
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
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-indigo-50 hover:text-indigo-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('waka.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Master Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">Data Guru</a>
                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">Data Kelas</a>
                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">Data Siswa</a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">Mata Pelajaran</a>
                        </nav>
                    </div>
                </div>
            </div>

            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition">
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
                <h2 class="text-sm font-semibold text-gray-700">Manajemen Waktu & Algoritma</h2>
                <span class="text-xs text-gray-500">Tahun Ajaran Aktif</span>
            </header>

            <div class="p-8">
                <div class="mb-6">
                    <h1 class="text-xl font-bold text-gray-900">Tambah Slot Waktu Pelajaran</h1>
                    <p class="text-xs text-gray-500 mt-1">Pastikan jam berurutan dengan benar sesuai nomor urut harian.</p>
                </div>

                <!-- Grid Layout: Form di Kiri, Referensi Jadwal Terisi di Kanan -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Kartu Form (2 Kolom) -->
                    <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                        <form action="{{ route('slot-waktu.store') }}" method="POST" class="space-y-5">
                            @csrf
                            
                            <!-- Hari -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Hari</label>
                                <input type="hidden" name="hari" value="{{ $hariPilihan }}">
                                <div class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-xs font-bold text-indigo-900">
                                    {{ $hariPilihan }}
                                </div>
                            </div>

                            <!-- Jam Mulai & Jam Selesai -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Jam Mulai</label>
                                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="w-full px-4 py-2.5 bg-gray-50 border @error('jam_mulai') border-rose-500 @else border-gray-200 @enderror rounded-xl text-xs focus:ring-2 focus:ring-indigo-500" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Jam Selesai</label>
                                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="w-full px-4 py-2.5 bg-gray-50 border @error('jam_selesai') border-rose-500 @else border-gray-200 @enderror rounded-xl text-xs focus:ring-2 focus:ring-indigo-500" required>
                                </div>
                            </div>
                            @error('jam_mulai')
                                <p class="text-rose-500 text-[11px] font-medium">{{ $message }}</p>
                            @enderror

                            <!-- Jenis Slot -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Jenis Slot</label>
                                <select name="jenis" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:ring-2 focus:ring-indigo-500" required>
                                    <option value="jp">Jam Pelajaran (JP)</option>
                                    <option value="istirahat">Istirahat</option>
                                    <option value="terkunci">Terkunci (Upacara / Senam / Pramuka)</option>
                                </select>
                            </div>

                            <!-- Keterangan -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Keterangan / Label (Opsional)</label>
                                <input type="text" name="keterangan" value="{{ old('keterangan') }}" placeholder="Contoh: Upacara Bendera" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <!-- Urutan -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Urutan (Nomor Urut Blok Harian)</label>
                                <input type="number" name="urutan" value="{{ old('urutan', $urutanSaran ?? 1) }}" class="w-full px-4 py-2.5 bg-gray-50 border @error('urutan') border-rose-500 @else border-gray-200 @enderror rounded-xl text-xs focus:ring-2 focus:ring-indigo-500" required>
                                @error('urutan')
                                    <p class="text-rose-500 text-[11px] mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                                <a href="{{ route('slot-waktu.index', ['hari' => $hariPilihan]) }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-xl text-xs font-semibold transition">Batal</a>
                                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition shadow-sm">Simpan Slot</button>
                            </div>
                        </form>
                    </div>

                    <!-- Kolom Kanan: Panduan / Tabel Slot yang Sudah Ada pada Hari Tersebut -->
                    <div class="bg-indigo-50/50 rounded-3xl border border-indigo-100 p-6 flex flex-col">
                        <h3 class="text-xs font-bold text-indigo-900 uppercase tracking-wider mb-2">Referensi Slot Hari {{ $hariPilihan }}</h3>
                        <p class="text-[11px] text-gray-500 mb-4">Berikut daftar jam yang sudah terdaftar agar tidak terjadi kesalahan urutan:</p>
                        
                        <div class="space-y-2 overflow-y-auto max-h-[350px]">
                            @forelse($existingSlots as $slot)
                                <div class="bg-white p-3 rounded-2xl border border-indigo-100 shadow-sm flex items-center justify-between text-xs">
                                    <div>
                                        <span class="font-bold text-indigo-600">Urutan #{{ $slot->urutan }}</span>
                                        <p class="font-semibold text-gray-800">{{ $slot->jam_mulai }} - {{ $slot->jam_selesai }}</p>
                                        <span class="text-[10px] text-gray-400 uppercase">{{ $slot->jenis }} {{ $slot->keterangan ? '('.$slot->keterangan.')' : '' }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-400 text-xs italic">
                                    Belum ada slot waktu untuk hari {{ $hariPilihan }}.
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>

</body>
</html>