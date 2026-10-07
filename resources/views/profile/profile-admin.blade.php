<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Administrator - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- 1. SIDEBAR KIRI ADMIN -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100">
                        A
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-indigo-600 font-semibold truncate max-w-[130px]">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Navigasi Menu Admin -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard.admin') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Manajemen User</span>
                            </a>
                            <!-- Menu Profil Aktif -->
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
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

        <!-- 2. KONTEN UTAMA HALAMAN PROFIL (Layout Grid 2 Kolom) -->
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-5xl mx-auto">

                <!-- Header Section -->
                <div class="mb-8 pb-6 border-b border-gray-200">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Profil Administrator</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola informasi akun dan keamanan kredensial login Anda.</p>
                </div>

                <!-- Notifikasi Sukses / Error -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-medium flex items-center gap-2 shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 text-rose-800 border border-rose-200 rounded-xl text-xs space-y-1 shadow-sm">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Wrapper Grid 2 Kolom -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Kolom Kiri: Informasi Akun -->
                    <div class="space-y-6">
                        <div class="bg-white border border-indigo-100 rounded-3xl p-6 shadow-sm">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-lg shadow-md shadow-indigo-100 shrink-0">
                                    {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Role Akses</p>
                                    <h3 class="text-sm font-extrabold text-gray-900 uppercase truncate mt-0.5">{{ Auth::user()->role }}</h3>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-100 text-xs text-gray-500 space-y-2">
                                <p class="flex justify-between"><span>Status Akun:</span> <span class="font-semibold text-emerald-600">Aktif</span></p>
                                <p class="flex justify-between"><span>Terdaftar:</span> <span class="font-medium text-gray-700">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Update Profil -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                            <h3 class="font-bold text-sm text-gray-900 mb-6">Perbarui Kredensial Akun</h3>
                            
                            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Alamat Email</label>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 transition-all">
                                </div>

                                <!-- Password Baru dengan Fitur Toggle Lihat/Sembunyi -->
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Password Baru <span class="text-gray-400 font-normal lowercase">(kosongkan jika tidak ingin mengubah)</span></label>
                                    <div class="relative">
                                        <input type="password" name="password" id="new_password" placeholder="Masukkan password baru..."
                                            class="w-full px-4 py-3 pr-12 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 transition-all">
                                        <button type="button" onclick="togglePassword('new_password', 'icon_new')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <svg id="icon_new" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Konfirmasi Password Baru dengan Fitur Toggle Lihat/Sembunyi -->
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="confirm_password" placeholder="Ulangi password baru..."
                                            class="w-full px-4 py-3 pr-12 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600 transition-all">
                                        <button type="button" onclick="togglePassword('confirm_password', 'icon_confirm')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <svg id="icon_confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 pt-4">
                                    <button type="submit"
                                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-3 px-4 rounded-xl shadow-sm shadow-indigo-100 transition-all text-center">
                                        Simpan Perubahan
                                    </button>
                                    <a href="{{ route('dashboard.admin') }}"
                                        class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold py-3 px-4 rounded-xl border border-gray-200 transition-all">
                                        Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Script Toggle Tampilkan/Sembunyikan Password -->
    <script>
        function togglePassword(fieldId, iconId) {
            const inputField = document.getElementById(fieldId);
            const iconElement = document.getElementById(iconId);

            if (inputField.type === "password") {
                inputField.type = "text";
                iconElement.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                inputField.type = "password";
                iconElement.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</body>
</html>