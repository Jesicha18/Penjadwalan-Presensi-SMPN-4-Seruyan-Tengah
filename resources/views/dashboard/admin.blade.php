<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator - SMPN 4 Seruyan Tengah</title>
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
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Manajemen User</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
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

        <!-- 2. KONTEN UTAMA ADMIN -->
        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-5xl mx-auto">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-gray-200">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard Administrator</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Pusat kendali sistem, manajemen akun, dan hak akses pengguna.</p>
                    </div>
                </div>

                <!-- Notifikasi Sukses -->
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

                <!-- Statistik Cards (Urutan: Total, Admin, Waka, Kepsek, Guru) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                    <div class="bg-white border border-indigo-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-indigo-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total User</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</h3>
                    </div>
                    <div class="bg-white border border-blue-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-blue-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Admin</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">{{ $totalAdmin }}</h3>
                    </div>
                    <div class="bg-white border border-amber-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-amber-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Waka</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">{{ $totalWaka }}</h3>
                    </div>
                    <div class="bg-white border border-emerald-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-emerald-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kepala Sekolah</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">{{ $totalKepsek }}</h3>
                    </div>
                    <div class="bg-white border border-violet-100 p-5 rounded-3xl shadow-sm hover:shadow-md hover:border-violet-300 transition duration-200">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Guru</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">{{ $totalGuru }}</h3>
                    </div>
                </div>

                <!-- Form Tambah User Baru (Sudah ditambah input Nama Lengkap) -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-8 shadow-sm">
                    <h3 class="font-bold text-sm text-gray-900 mb-4">Tambah Akun Pengguna Baru</h3>
                    <form action="{{ route('admin.users.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @csrf
                        
                        <!-- Input Nama Lengkap -->
                        <div>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap & Gelar" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600">
                        </div>

                        <!-- Input Email -->
                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Pengguna" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600">
                        </div>

                        <!-- Pilih Role -->
                        <div>
                            <select name="role" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="waka">Waka</option>
                                <option value="kepsek">Kepsek</option>
                                <option value="guru">Guru</option>
                            </select>
                        </div>

                        <!-- Input Password -->
                        <div>
                            <input type="password" name="password" placeholder="Password (Min. 6 Karakter)" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-600">
                        </div>

                        <!-- Tombol Submit (Span full width di bawah pada layar kecil atau grid terakhir) -->
                        <div class="sm:col-span-2 lg:col-span-4 flex justify-end mt-2">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-2.5 px-6 rounded-xl shadow-sm shadow-indigo-100 transition">
                                Simpan Akun Baru
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tabel Manajemen User -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="font-bold text-sm text-gray-900">Daftar Akun Pengguna Sistem</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-[11px] uppercase tracking-wider font-semibold">
                                    <th class="px-6 py-4">Nama Lengkap</th>
                                    <th class="px-6 py-4">Email Pengguna</th>
                                    <th class="px-6 py-4">Role</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Dibuat Pada</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @foreach($users as $usr)
                                    <tr class="hover:bg-gray-50/60 transition-colors">
                                        <!-- Kolom Nama Lengkap -->
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900">{{ $usr->name }}</div>
                                        </td>
                                        
                                        <!-- Kolom Email Pengguna -->
                                        <td class="px-6 py-4">
                                            <div class="text-xs text-gray-500">{{ $usr->email }}</div>
                                        </td>

                                        <!-- Kolom Role -->
                                        <td class="px-6 py-4">
                                            <span class="inline-block px-2.5 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-lg uppercase">
                                                {{ $usr->role }}
                                            </span>
                                        </td>

                                        <!-- Kolom Status -->
                                        <td class="px-6 py-4">
                                            @if($usr->is_active ?? true)
                                                <span class="inline-block px-2.5 py-1 text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full">Aktif</span>
                                            @else
                                                <span class="inline-block px-2.5 py-1 text-[10px] font-semibold bg-rose-50 text-rose-700 border border-rose-200 rounded-2xl">Nonaktif</span>
                                            @endif
                                        </td>

                                        <!-- Kolom Tanggal Dibuat -->
                                        <td class="px-6 py-4 text-xs text-gray-500">{{ $usr->created_at }}</td>

                                        <!-- Kolom Aksi -->
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- Tombol Reset Password -->
                                                <form action="{{ route('admin.users.reset', $usr->id_user) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Reset password akun ini menjadi password123?')" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition">
                                                        Reset
                                                    </button>
                                                </form>

                                                <!-- Tombol Aktif/Nonaktif -->
                                                <form action="{{ route('admin.users.toggle', $usr->id_user) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold {{ ($usr->is_active ?? true) ? 'text-rose-700 bg-rose-50 hover:bg-rose-100 border-rose-200' : 'text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border-emerald-200' }} border rounded-lg transition">
                                                        {{ ($usr->is_active ?? true) ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>

    </div>

</body>
</html>