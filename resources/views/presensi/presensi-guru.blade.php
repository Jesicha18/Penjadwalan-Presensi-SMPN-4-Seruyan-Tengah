<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Guru - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR KIRI GURU -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100">
                        G
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-gray-400 truncate max-w-[130px]">{{ Auth::user()->email }}</p>
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
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Aktivitas Mengajar</p>
                        <nav class="space-y-1">
                            <!-- Presensi Guru (Aktif) -->
                            <a href="{{ route('guru.presensi') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Presensi Guru</span>
                            </a>
                            <!-- Presensi Siswa -->
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Presensi Siswa</span>
                            </a>
                            <!-- Rekap Bulanan -->
                            <a href="{{ route('presensi.rekap') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                <span>Rekap Bulanan</span>
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

        <!-- KONTEN UTAMA PRESENSI GURU -->
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-4xl mx-auto">
                
                <!-- Header Halaman -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-gray-200">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Presensi Kehadiran Guru</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Lakukan absensi harian Anda (Jendela waktu aktif: 07:00 - 15:00 WIB).</p>
                    </div>
                    <div class="bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm text-xs font-semibold text-gray-700">
                        📅 {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <!-- Notifikasi -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-medium flex items-center gap-2 shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 text-rose-800 border border-rose-200 rounded-xl text-xs space-y-1 shadow-sm">
                        @foreach($errors->all() as $error)
                            <p>⚠️ {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Card Form Presensi -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-8">
                    <h3 class="font-bold text-sm text-gray-900 mb-4">Form Absensi Harian</h3>
                    
                    @php
                        $isMinggu = \Carbon\Carbon::now('Asia/Jakarta')->isSunday();
                    @endphp

                    @if($isMinggu)
                        <div class="p-4 bg-amber-50 text-amber-800 border border-amber-200 rounded-xl text-xs font-medium mb-4">
                            ⚠️ Hari ini adalah hari Minggu. Sistem presensi libur dan baru akan aktif kembali pada hari Senin.
                        </div>
                    @endif

                    <form action="{{ route('guru.presensi.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Status Kehadiran</label>
                            <select name="status_kehadiran" {{ $isMinggu ? 'disabled' : '' }} class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 transition-all {{ $isMinggu ? 'opacity-50 cursor-not-allowed' : '' }}">
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Tidak Hadir">Tidak Hadir</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit" {{ $isMinggu ? 'disabled' : '' }}
                                class="{{ $isMinggu ? 'bg-gray-400 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-100' }} text-white text-xs font-semibold py-3 px-6 rounded-xl shadow-sm transition-all">
                                Kirim Presensi Sekarang
                            </button>
                            <a href="{{ route('dashboard.guru') }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold py-3 px-6 rounded-xl border border-gray-200 transition-all">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Riwayat & Filter Presensi -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
                    
                    <!-- Header Bagian & Filter Tanggal -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="font-bold text-sm text-gray-900">Riwayat & Status Kehadiran</h3>
                        
                        <!-- Form Filter Tanggal -->
                        <form action="{{ route('guru.presensi') }}" method="GET" class="flex items-center gap-2">
                            <input type="date" name="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}"
                                class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-700 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 transition">
                            <button type="submit"
                                class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-xl text-xs font-semibold transition">
                                Filter
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 text-gray-400 text-[11px] uppercase tracking-wider font-semibold">
                                    <th class="pb-3 px-3">Tanggal</th>
                                    <th class="pb-3 px-3">Status Kehadiran</th>
                                    <th class="pb-3 px-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs text-gray-700 divide-y divide-gray-50">
                                @if(isset($riwayatPresensi) && $riwayatPresensi)
                                    <tr>
                                        <td class="py-3 px-3">{{ $riwayatPresensi->tanggal }}</td>
                                        <td class="py-3 px-3 font-bold {{ $riwayatPresensi->status_kehadiran == 'Tidak Hadir' ? 'text-rose-600' : 'text-indigo-600' }}">
                                            {{ $riwayatPresensi->status_kehadiran }}
                                        </td>
                                        <td class="py-3 px-3 text-center">
                                            <a href="{{ route('guru.presensi.edit', $riwayatPresensi->id_presensi_guru) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold rounded-lg transition">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-gray-400">Tidak ada data presensi pada tanggal tersebut.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>

    </div>

</body>
</html>