<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kepala Sekolah - SIPAS</title>
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
                            <a href="{{ route('kepala-sekolah.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-xs font-semibold transition">
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
                            <a href="{{ route('kepala-sekolah.kelas') }}" class="flex items-center justify-between px-3.5 py-2.5 text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-xl text-xs font-medium transition">
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

        <!-- KONTEN UTAMA PROFIL -->
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-6xl mx-auto">

                <!-- Header Profil -->
                <div class="mb-8 pb-6 border-b border-gray-200">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Profil Kepala Sekolah</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola informasi akun dan keamanan kredensial login Anda.</p>
                </div>

                <!-- Notifikasi Sukses -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-medium flex items-center gap-2 shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Layout 2 Kolom (Card Info & Form Update) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Kolom Kiri: Informasi Akun -->
                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm h-fit">
                        <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-gray-100">
                            <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center text-white justify-center font-bold text-lg shadow-md shadow-indigo-100">
                                K
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Role Akses</p>
                                <h3 class="text-base font-extrabold text-gray-900">KEPSEK</h3>
                            </div>
                        </div>

                        <div class="space-y-4 text-xs">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Status Akun:</span>
                                <span class="font-bold text-emerald-600">Aktif</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Terdaftar:</span>
                                <span class="font-bold text-gray-900">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Perbarui Kredensial -->
                    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-3xl p-8 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-6">Perbarui Kredensial Akun</h3>

                        <form action="{{ route('kepala-sekolah.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-5">
                                <!-- Alamat Email -->
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Email</label>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-indigo-500 transition">
                                    @error('email')
                                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Baru -->
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Password Baru <span class="text-gray-400 font-normal lowercase">(kosongkan jika tidak ingin mengubah)</span></label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password" placeholder="Masukkan password baru..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-indigo-500 transition pr-12">
                                        <button type="button" onclick="togglePassword('password', 'icon-password')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <svg id="icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password Baru -->
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                                    <div class="relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-indigo-500 transition pr-12">
                                        <button type="button" onclick="togglePassword('password_confirmation', 'icon-password-confirmation')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <svg id="icon-password-confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="flex items-center gap-3 pt-4">
                                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl shadow-md transition">Simpan Perubahan</button>
                                    <a href="{{ route('dashboard.kepala-sekolah') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition text-center">Batal</a>
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