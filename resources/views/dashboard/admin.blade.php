<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator - SMPN 4 Seruyan Tengah</title>
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
                <!-- Logo & Identitas (Foto Logo Sekolah Menggantikan Inisial A) -->
                <div class="flex items-center space-x-3 mb-8 px-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md p-1 shrink-0">
                        <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-xs font-bold tracking-wider text-white">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">{{ Auth::user()->email ?? 'admin@smpn4.sch.id' }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Admin -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Manajemen User (Aktif) -->
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Manajemen User</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Keluar Akun -->
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

        <!-- ================= 2. KONTEN UTAMA ADMIN (FULL LAYAR) ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            <div class="w-full space-y-6">

                <!-- Header Section -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Dashboard Administrator</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Pusat kendali sistem, manajemen akun, dan hak akses pengguna.</p>
                    </div>
                    <div class="bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm text-xs font-bold text-slate-700">
                        📅 {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <!-- Notifikasi Sukses -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Notifikasi Error -->
                @if($errors->any())
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs space-y-1 shadow-sm font-semibold">
                        @foreach($errors->all() as $error)
                            <p>• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Statistik Cards (Urutan: Total, Admin, Waka, Kepsek, Guru) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total User</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalUsers }}</h3>
                    </div>
                    <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Admin</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalAdmin }}</h3>
                    </div>
                    <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Waka</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalWaka }}</h3>
                    </div>
                    <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kepala Sekolah</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalKepsek }}</h3>
                    </div>
                    <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Guru</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalGuru }}</h3>
                    </div>
                </div>

                <!-- Form Tambah User Baru -->
                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-extrabold text-xs uppercase tracking-wider text-slate-900 mb-5">Tambah Akun Pengguna Baru</h3>
                    <form action="{{ route('admin.users.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @csrf
                        
                        <!-- Input Nama Lengkap -->
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama & Gelar" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                        </div>

                        <!-- Input Email -->
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@sekolah.sch.id" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                        </div>

                        <!-- Pilih Role -->
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Hak Akses (Role)</label>
                            <select name="role" required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                                <option value="">Pilih Role Akses</option>
                                <option value="admin">Admin</option>
                                <option value="waka">Waka</option>
                                <option value="kepsek">Kepsek</option>
                                <option value="guru">Guru</option>
                            </select>
                        </div>

                        <!-- Input Password -->
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Password</label>
                            <input type="password" name="password" placeholder="Min. 6 Karakter" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                        </div>

                        <!-- Tombol Submit -->
                        <div class="sm:col-span-2 lg:col-span-4 flex justify-end pt-2">
                            <button type="submit" class="bg-[#2582E5] hover:bg-blue-600 text-white text-xs font-bold py-3 px-6 rounded-xl shadow-md transition-all">
                                Simpan Akun Baru
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tabel Manajemen User -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Daftar Akun Pengguna Sistem</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                    <th class="p-4">Nama Lengkap</th>
                                    <th class="p-4">Email Pengguna</th>
                                    <th class="p-4">Role</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4">Dibuat Pada</th>
                                    <th class="p-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                @forelse($users as $usr)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <!-- Kolom Nama Lengkap -->
                                        <td class="p-4 font-extrabold text-slate-900">{{ $usr->name }}</td>
                                        
                                        <!-- Kolom Email Pengguna -->
                                        <td class="p-4 font-mono text-slate-600">{{ $usr->email }}</td>

                                        <!-- Kolom Role -->
                                        <td class="p-4">
                                            <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold bg-violet-50 text-violet-700 border border-violet-100 rounded-lg uppercase">
                                                {{ $usr->role }}
                                            </span>
                                        </td>

                                        <!-- Kolom Status -->
                                        <td class="p-4">
                                            @if($usr->is_active ?? true)
                                                <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-lg">Aktif</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-100 rounded-lg">Nonaktif</span>
                                            @endif
                                        </td>

                                        <!-- Kolom Tanggal Dibuat -->
                                        <td class="p-4 font-mono text-slate-600">{{ $usr->created_at }}</td>

                                        <!-- Kolom Aksi -->
                                        <td class="p-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- Tombol Reset Password -->
                                                <form action="{{ route('admin.users.reset', $usr->id_user) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Reset password akun ini menjadi password123?')" class="inline-flex items-center px-3 py-1.5 text-[11px] font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-xl transition">
                                                        Reset
                                                    </button>
                                                </form>

                                                <!-- Tombol Aktif/Nonaktif -->
                                                <form action="{{ route('admin.users.toggle', $usr->id_user) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-[11px] font-bold {{ ($usr->is_active ?? true) ? 'text-rose-700 bg-rose-50 hover:bg-rose-100 border-rose-200' : 'text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border-emerald-200' }} border rounded-xl transition">
                                                        {{ ($usr->is_active ?? true) ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-12 text-center text-slate-400 font-medium">Belum ada data pengguna yang terdaftar.</td>
                                    </tr>
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