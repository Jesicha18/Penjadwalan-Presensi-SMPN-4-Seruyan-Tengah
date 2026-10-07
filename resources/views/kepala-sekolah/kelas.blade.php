<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Data Kelas - SIPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR KIRI KEPALA SEKOLAH -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-emerald-100">
                        K
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-indigo-600 font-semibold truncate max-w-[130px]">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard.kepala-sekolah') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard Utama</span>
                            </a>
                            <a href="{{ route('kepala-sekolah.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Rincian Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('kepala-sekolah.guru') }}" class="flex items-center justify-between px-3.5 py-2.5 text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl text-xs font-medium transition">
                                <span class="flex items-center space-x-2.5"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span><span>Total Guru</span></span>
                            </a>
                            <a href="{{ route('kepala-sekolah.kelas') }}" class="flex items-center justify-between px-3.5 py-2.5 bg-blue-50 text-blue-700 rounded-xl text-xs font-semibold transition">
                                <span class="flex items-center space-x-2.5"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span><span>Total Kelas</span></span>
                            </a>
                            <a href="{{ route('kepala-sekolah.mapel') }}" class="flex items-center justify-between px-3.5 py-2.5 text-gray-600 hover:bg-amber-50 hover:text-amber-700 rounded-xl text-xs font-medium transition">
                                <span class="flex items-center space-x-2.5"><span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span><span>Mata Pelajaran</span></span>
                            </a>
                            <a href="{{ route('kepala-sekolah.user') }}" class="flex items-center justify-between px-3.5 py-2.5 text-gray-600 hover:bg-violet-50 hover:text-violet-700 rounded-xl text-xs font-medium transition">
                                <span class="flex items-center space-x-2.5"><span class="w-1.5 h-1.5 bg-violet-500 rounded-full"></span><span>Pengguna Sistem</span></span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

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
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-center mb-8 pb-6 border-b border-gray-200">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Monitoring Data Kelas</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Daftar ruangan kelas aktif yang terdaftar di sistem sekolah.</p>
                    </div>
                    <a href="{{ route('dashboard.kepala-sekolah') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition">Kembali</a>
                </div>

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200"><h3 class="font-bold text-sm text-gray-900">Tabel Informasi Kelas</h3></div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-[11px] uppercase tracking-wider font-semibold">
                                    <th class="px-6 py-4">No</th>
                                    <th class="px-6 py-4">Nama Kelas</th>
                                    <th class="px-6 py-4">Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @forelse($kelasList as $index => $kelas)
                                    <tr class="hover:bg-gray-50/60 transition-colors">
                                        <td class="px-6 py-4 text-xs text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $kelas->nama_kelas ?? $kelas->name ?? 'Kelas' }}</td>
                                        <td class="px-6 py-4 text-xs text-gray-500">{{ $kelas->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-6 py-8 text-center text-xs text-gray-400">Belum ada data kelas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>