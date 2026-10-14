<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kepala Sekolah - SIPAS</title>
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
                <!-- Logo & Identitas (Foto Logo Sekolah Menggantikan Inisial K) -->
                <div class="flex items-center space-x-3 mb-8 px-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md p-1 shrink-0">
                        <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-xs font-bold tracking-wider text-white">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">{{ Auth::user()->email ?? 'kepsek@smpn4.sch.id' }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Utama -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Dashboard Utama (Aktif) -->
                            <a href="{{ route('dashboard.kepala-sekolah') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <!-- Navigasi Rincian Data -->
                                <span>Dashboard Utama</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('kepala-sekolah.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Rincian Data</p>
                        <nav class="space-y-1">
                            <!-- Link ke Data Guru -->
                            <a href="{{ route('kepala-sekolah.guru') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    <span>Total Guru</span>
                                </span>
                            </a>

                            <!-- Link ke Data Kelas -->
                            <a href="{{ route('kepala-sekolah.kelas') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    <span>Total Kelas</span>
                                </span>
                            </a>

                            <!-- Link ke Data Mata Pelajaran -->
                            <a href="{{ route('kepala-sekolah.mapel') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    <span>Mata Pelajaran</span>
                                </span>
                            </a>

                            <!-- Link ke Pengguna Sistem -->
                            <a href="{{ route('kepala-sekolah.user') }}" class="flex items-center justify-between px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all group">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    <span>Pengguna Sistem</span>
                                </span>
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

        <!-- ================= 2. KONTEN UTAMA PROFIL (FULL LAYAR) ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            <div class="w-full space-y-6">

                <!-- Header Profil -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Profil Kepala Sekolah</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Kelola informasi akun dan keamanan kredensial login Anda.</p>
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

                <!-- Layout 2 Kolom (Card Info & Form Update) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Kolom Kiri: Informasi Akun -->
                    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm h-fit space-y-6">
                        <div class="flex items-center space-x-4 pb-6 border-b border-slate-100">
                            <div class="w-12 h-12 bg-blue-50 text-[#0F5EA3] rounded-2xl flex items-center justify-center font-bold text-lg shadow-sm shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Role Akses</p>
                                <h3 class="text-sm font-extrabold text-slate-900 mt-0.5">KEPALA SEKOLAH</h3>
                            </div>
                        </div>

                        <div class="space-y-4 text-xs">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 font-medium">Status Akun:</span>
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 font-bold rounded-lg border border-emerald-100">Aktif</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 font-medium">Terdaftar:</span>
                                <span class="font-extrabold text-slate-800">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Perbarui Kredensial -->
                    <div class="lg:col-span-2 bg-white border border-slate-100 rounded-2xl p-6 md:p-8 shadow-sm">
                        <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider mb-6">Perbarui Kredensial Akun</h3>

                        <form action="{{ route('kepala-sekolah.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-5">
                                <!-- Alamat Email -->
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required 
                                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition">
                                    @error('email')
                                        <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Baru -->
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Password Baru <span class="text-slate-400 font-normal lowercase">(kosongkan jika tidak ingin mengubah)</span></label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password" placeholder="Masukkan password baru..." 
                                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition pr-12">
                                        <button type="button" onclick="togglePassword('password', 'icon-password')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                            <svg id="icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password Baru -->
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                                    <div class="relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru..." 
                                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 transition pr-12">
                                        <button type="button" onclick="togglePassword('password_confirmation', 'icon-password-confirmation')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                            <svg id="icon-password-confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                                    <button type="submit" class="bg-[#2582E5] hover:bg-blue-600 text-white text-xs font-bold py-3 px-6 rounded-xl shadow-md transition-all">Simpan Perubahan</button>
                                    <a href="{{ route('dashboard.kepala-sekolah') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold py-3 px-6 rounded-xl border border-slate-200 text-center transition-all">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <!-- Script Toggle Tampilkan/Sembunyikan Password -->
    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            
            if (field.type === "password") {
                field.type = "text";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                field.type = "password";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }
    </script>
</body>
</html>