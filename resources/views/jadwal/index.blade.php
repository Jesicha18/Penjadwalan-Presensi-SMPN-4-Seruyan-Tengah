<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buat Jadwal - SMPN 4 Seruyan Tengah</title>
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
        <aside class="w-64 bg-[#0F5EA3] text-white flex flex-col justify-between p-5 shrink-0 shadow-xl select-none">
            <div>
                <!-- Brand Header -->
<!-- User Profile Header / Logo Sekolah -->
<div class="flex items-center space-x-3 mb-8 px-2">
    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md p-1 shrink-0">
        <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
    </div>
    <div>
        <h1 class="text-xs font-bold tracking-wider text-white">SMPN 4 SERUYAN</h1>
        <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">{{ Auth::user()->email ?? 'kurikulum@smpn4.sch.id' }}</p>
    </div>
</div>

                <!-- Navigasi Menu -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            
                            <!-- Profil Saya -->
                            <a href="{{ route('waka.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>

                            <!-- Buat Jadwal Active Pill -->
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-[#2582E5] text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>

                            <!-- Jadwal Pelajaran -->
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Master Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Guru</span>
                            </a>

                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011 1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Data Kelas</span>
                            </a>

                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>

                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Siswa</span>
                            </a>

                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>

                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332 1.253-4.5 1.253"/></svg>
                                <span>Mata Pelajaran</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Logout -->
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

        <!-- ================= 2. KONTEN UTAMA ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-xs font-bold">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold text-base">&times;</button>
                </div>
            @endif

            {{-- Notifikasi Error --}}
            @if(session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        <span class="text-xs font-bold">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold text-base">&times;</button>
                </div>
            @endif

            <!-- Header & Filter Periode Tahun Ajaran di Kanan Atas -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Pembuatan Jadwal</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Kelola data pendukung, mapping, slot waktu, dan jalankan generator otomatis.</p>
                </div>

                <!-- Bagian Form Filter Atas & Action Generator -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    
                    @if(request()->has('tahun_ajaran') && request()->has('semester'))
                    <div class="bg-emerald-50 border border-emerald-200 px-3 py-2 rounded-xl flex items-center space-x-2 text-emerald-700 text-xs shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Aktif: <strong>{{ request('tahun_ajaran') }} {{ request('semester') }}</strong></span>
                    </div>
                    @endif

                    <!-- Form Filter & Tombol Generate -->
                    <div class="bg-white p-3 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between flex-wrap gap-3">
                        
                        <!-- Bagian Form Filter (GET) -->
                        <form id="form-filter-jadwal" method="GET" action="{{ route('jadwal.index') }}" onsubmit="return validateFormFilter(event)" class="flex flex-col gap-1">
                            <div class="flex items-center gap-2">
                                <input type="text" id="input-tahun" name="tahun_ajaran" value="{{ request('tahun_ajaran', $tahunAktif ?? '') }}" class="px-3 py-2 text-xs border @error('tahun_ajaran') border-rose-500 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:border-blue-500 w-32 bg-slate-50 text-slate-800" placeholder="Cth: 2026/2027" pattern="\d{4}/\d{4}" title="Format tahun ajaran harus YYYY/YYYY (Cth: 2026/2027)" required maxlength="9">
                                
                                <!-- Dropdown Semester Modern -->
                                <div class="relative inline-block">
                                    <select id="input-semester" name="semester" class="appearance-none px-3.5 py-2 pr-8 text-xs font-semibold border border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 bg-slate-50 text-slate-700 shadow-sm cursor-pointer" required>
                                        <option value="" disabled {{ empty(request('semester', $semesterAktif ?? '')) ? 'selected' : '' }}>-- Semester --</option>
                                        <option value="Ganjil" {{ (request('semester', $semesterAktif ?? '') == 'Ganjil') ? 'selected' : '' }}>Ganjil</option>
                                        <option value="Genap" {{ (request('semester', $semesterAktif ?? '') == 'Genap') ? 'selected' : '' }}>Genap</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                
                                <button type="submit" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all shadow-sm">
                                    Filter
                                </button>
                            </div>

                            @error('tahun_ajaran')
                                <span class="text-rose-500 text-[10px] mt-0.5 ml-1">{{ $message }}</span>
                            @enderror
                        </form>

                        <!-- Form POST untuk Generate Data dengan Efek Loading -->
                        <form id="form-generate-jadwal" method="POST" action="{{ route('jadwal.generate') }}" onsubmit="prosesGenerate(event)">
                            @csrf
                            <input type="hidden" name="tahun_ajaran" id="gen-tahun">
                            <input type="hidden" name="semester" id="gen-semester">

                            <button type="submit" id="btn-generate" class="px-4 py-2 bg-[#2582E5] hover:bg-blue-600 text-white text-xs font-bold rounded-xl transition-all shadow-md flex items-center gap-2">
                                <svg id="spinner-icon" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <svg id="default-icon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                <span id="btn-text">Generate Data</span>
                            </button>
                        </form>
                    </div>

                    <!-- Script Validasi & Loading State -->
                    <script>
                        function validateFormFilter(event) {
                            const tahunInput = document.getElementById('input-tahun').value;
                            const parts = tahunInput.split('/');
                            
                            if (parts.length === 2) {
                                const th1 = parseInt(parts[0]);
                                const th2 = parseInt(parts[1]);
                                
                                if (th2 !== th1 + 1) {
                                    event.preventDefault();
                                    alert('Tahun ajaran harus berurutan, contoh: 2026/2027.');
                                    return false;
                                }
                            }
                            return true;
                        }

                        function prosesGenerate(event) {
                            const tahunAjaranEl = document.getElementById('input-tahun');
                            const semesterEl = document.getElementById('input-semester');

                            let tahun = tahunAjaranEl ? tahunAjaranEl.value : '';
                            let semester = semesterEl ? semesterEl.value : '';

                            if (!tahun || !semester) {
                                const urlParams = new URLSearchParams(window.location.search);
                                tahun = tahun || urlParams.get('tahun_ajaran');
                                semester = semester || urlParams.get('semester');
                            }

                            if (!tahun || !semester) {
                                event.preventDefault();
                                alert('Silakan pilih dan terapkan (Filter) Tahun Ajaran dan Semester terlebih dahulu!');
                                return;
                            }

                            const parts = tahun.split('/');
                            if (parts.length === 2) {
                                const th1 = parseInt(parts[0]);
                                const th2 = parseInt(parts[1]);
                                if (th2 !== th1 + 1) {
                                    event.preventDefault();
                                    alert('Tahun ajaran harus berurutan, contoh: 2026/2027.');
                                    return;
                                }
                            }

                            document.getElementById('gen-tahun').value = tahun;
                            document.getElementById('gen-semester').value = semester;

                            const btn = document.getElementById('btn-generate');
                            const spinner = document.getElementById('spinner-icon');
                            const defIcon = document.getElementById('default-icon');
                            const btnText = document.getElementById('btn-text');

                            btn.disabled = true;
                            btn.classList.add('opacity-75', 'cursor-not-allowed');
                            defIcon.classList.add('hidden');
                            spinner.classList.remove('hidden');
                            btnText.innerText = 'Jadwal sedang dibuat...';
                        }
                    </script>
                </div>
            </div>

            <!-- GRID KARTU NAVIGASI MODUL PENDUKUNG (PASTEL COLORS) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                
                <!-- 1. Card Data Kelas (Blue Soft Pastel) -->
                <div class="bg-blue-50/70 p-6 rounded-2xl shadow-sm border border-blue-100/60 flex flex-col justify-between hover:shadow-md transition-all">
                    <div>
                        <span class="inline-block px-3 py-1 bg-blue-100/80 text-blue-700 text-[10px] font-extrabold rounded-full mb-3">Modul 1</span>
                        <h4 class="text-sm font-bold text-slate-800 mb-1">Data Kelas</h4>
                        <p class="text-xs text-slate-500/80 mb-4">Kelola daftar rombongan belajar dan kelas yang ada di sekolah.</p>
                    </div>
                    <a href="{{ route('kelas.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-white/80 hover:bg-white text-blue-600 text-xs font-bold rounded-xl transition-all shadow-sm border border-blue-100">
                        Kelola Kelas &rarr;
                    </a>
                </div>

                <!-- 2. Card Data Guru (Emerald Soft Pastel) -->
                <div class="bg-emerald-50/70 p-6 rounded-2xl shadow-sm border border-emerald-100/60 flex flex-col justify-between hover:shadow-md transition-all">
                    <div>
                        <span class="inline-block px-3 py-1 bg-emerald-100/80 text-emerald-700 text-[10px] font-extrabold rounded-full mb-3">Modul 2</span>
                        <h4 class="text-sm font-bold text-slate-800 mb-1">Data Guru</h4>
                        <p class="text-xs text-slate-500/80 mb-4">Kelola informasi identitas dan data pengajar aktif di sekolah.</p>
                    </div>
                    <a href="{{ route('guru.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-white/80 hover:bg-white text-emerald-600 text-xs font-bold rounded-xl transition-all shadow-sm border border-emerald-100">
                        Kelola Guru &rarr;
                    </a>
                </div>

                <!-- 3. Card Data Mata Pelajaran (Purple Soft Pastel) -->
                <div class="bg-purple-50/70 p-6 rounded-2xl shadow-sm border border-purple-100/60 flex flex-col justify-between hover:shadow-md transition-all">
                    <div>
                        <span class="inline-block px-3 py-1 bg-purple-100/80 text-purple-700 text-[10px] font-extrabold rounded-full mb-3">Modul 3</span>
                        <h4 class="text-sm font-bold text-slate-800 mb-1">Data Mata Pelajaran</h4>
                        <p class="text-xs text-slate-500/80 mb-4">Atur mapel beserta preferensi khusus seperti prioritas jam pagi.</p>
                    </div>
                    <a href="{{ route('mapel.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-white/80 hover:bg-white text-purple-600 text-xs font-bold rounded-xl transition-all shadow-sm border border-purple-100">
                        Kelola Mapel &rarr;
                    </a>
                </div>

                <!-- 4. Card Mapping Pengampu (Amber Soft Pastel) -->
                <div class="bg-amber-50/70 p-6 rounded-2xl shadow-sm border border-amber-100/60 flex flex-col justify-between hover:shadow-md transition-all">
                    <div>
                        <span class="inline-block px-3 py-1 bg-amber-100/80 text-amber-700 text-[10px] font-extrabold rounded-full mb-3">Modul 4</span>
                        <h4 class="text-sm font-bold text-slate-800 mb-1">Mapping Pengampu</h4>
                        <p class="text-xs text-slate-500/80 mb-4">Tentukan alokasi beban mengajar guru di setiap kelas.</p>
                    </div>
                    <a href="{{ route('mapping.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-white/80 hover:bg-white text-amber-600 text-xs font-bold rounded-xl transition-all shadow-sm border border-amber-100">
                        Kelola Mapping &rarr;
                    </a>
                </div>

                <!-- 5. Card Master Slot Waktu (Sky Soft Pastel) -->
                <div class="bg-sky-50/70 p-6 rounded-2xl shadow-sm border border-sky-100/60 flex flex-col justify-between hover:shadow-md transition-all lg:col-span-2">
                    <div>
                        <span class="inline-block px-3 py-1 bg-sky-100/80 text-sky-700 text-[10px] font-extrabold rounded-full mb-3">Modul 5</span>
                        <h4 class="text-sm font-bold text-slate-800 mb-1">Master Slot Waktu</h4>
                        <p class="text-xs text-slate-500/80 mb-4">Atur blok waktu harian, jam pelajaran (JP), dan durasi istirahat sekolah.</p>
                    </div>
                    <a href="{{ route('slot-waktu.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-white/80 hover:bg-white text-sky-600 text-xs font-bold rounded-xl transition-all shadow-sm border border-sky-100">
                        Kelola Slot Waktu &rarr;
                    </a>
                </div>
            </div>

            <!-- CARD SUMMARY RINGKASAN KESIAPAN DATA -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 mb-4 pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Ringkasan Status Kesiapan Data Modul</h3>
                        <p class="text-xs text-slate-400">Rincian jumlah data aktif pada setiap modul untuk periode saat ini.</p>
                    </div>
                    <span class="text-xs {{ (request('tahun_ajaran') && request('semester')) ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-amber-50 text-amber-700 border-amber-200' }} font-bold px-3 py-1 rounded-xl border">
                        @if(request('tahun_ajaran') && request('semester'))
                            Periode: {{ request('tahun_ajaran') }} {{ request('semester') }}
                        @else
                            ⚠️ Peringatan: Periode belum dipilih!
                        @endif
                    </span>
                </div>

                <!-- List Detail per Modul -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-blue-50/50 rounded-xl border border-blue-100/50">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            <span class="text-xs font-semibold text-slate-700">Modul 1: Data Kelas</span>
                        </div>
                        <span class="text-xs font-extrabold text-slate-800 bg-white px-3 py-1 rounded-lg border border-slate-200">
                            {{ $totalKelas ?? 0 }} Kelas Terdaftar
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-emerald-50/50 rounded-xl border border-emerald-100/50">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-semibold text-slate-700">Modul 2: Data Guru</span>
                        </div>
                        <span class="text-xs font-extrabold text-slate-800 bg-white px-3 py-1 rounded-lg border border-slate-200">
                            {{ $totalGuru ?? 0 }} Guru Aktif
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-purple-50/50 rounded-xl border border-purple-100/50">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                            <span class="text-xs font-semibold text-slate-700">Modul 3: Data Mata Pelajaran</span>
                        </div>
                        <span class="text-xs font-extrabold text-slate-800 bg-white px-3 py-1 rounded-lg border border-slate-200">
                            {{ $totalMapel ?? 0 }} Mapel
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-amber-50/50 rounded-xl border border-amber-100/50">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <span class="text-xs font-semibold text-slate-700">Modul 4: Mapping Pengampu</span>
                        </div>
                        <span class="text-xs font-extrabold text-slate-800 bg-white px-3 py-1 rounded-lg border border-slate-200">
                            {{ $totalMapping ?? 0 }} Beban Mengajar
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-sky-50/50 rounded-xl border border-sky-100/50">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                            <span class="text-xs font-semibold text-slate-700">Modul 5: Master Slot Waktu</span>
                        </div>
                        <span class="text-xs font-extrabold text-slate-800 bg-white px-3 py-1 rounded-lg border border-slate-200">
                            {{ $totalSlot ?? 0 }} Slot Waktu
                        </span>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>