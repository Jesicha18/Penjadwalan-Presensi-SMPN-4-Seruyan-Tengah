<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buat Jadwal - Kurikulum System</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR UTAMA -->
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
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('waka.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-indigo-600 bg-indigo-50/50 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Master Data</p>
                        <nav class="space-y-1">
                            <a href="{{ route('guru.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Guru</span>
                            </a>
                            <a href="{{ route('kelas.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011 1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Data Kelas</span>
                            </a>
                            <a href="{{ route('siswa.naik-kelas') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                <span>Naik Kelas</span>
                            </a>
                            <a href="{{ route('siswa.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Data Siswa</span>
                            </a>
                            <a href="{{ route('alumni.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Data Alumni</span>
                            </a>
                            <a href="{{ route('mapel.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332 1.253-4.5 1.253"/></svg>
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
                    <button type="submit" class="w-full flex items-center space-x-3 px-3.5 py-2.5 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 overflow-y-auto p-8">
            
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-xs font-semibold">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold text-lg">&times;</button>
                </div>
            @endif

            {{-- Notifikasi Error --}}
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="text-xs font-semibold">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
                </div>
            @endif

            <!-- Header & Filter Periode Tahun Ajaran di Kanan Atas -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Manajemen Pembuatan Jadwal</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola data pendukung, mapping, slot waktu, dan jalankan generator otomatis.</p>
                </div>

                <!-- Bagian Form Filter Atas & Action Generator -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    
                    @if(request()->has('tahun_ajaran') && request()->has('semester'))
                    <div class="bg-emerald-50 border border-emerald-200 px-3 py-2 rounded-2xl flex items-center space-x-2 text-emerald-700 text-xs shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Aktif: <strong>{{ request('tahun_ajaran') }} - {{ request('semester') }}</strong></span>
                    </div>
                    @endif

                    <!-- Form Filter & Tombol Generate -->
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between flex-wrap gap-4">
                        
                        <!-- Bagian Form Filter (GET) -->
                        <form id="form-filter-jadwal" method="GET" action="{{ route('jadwal.index') }}" class="flex items-center gap-2">
                            <input type="text" id="input-tahun" name="tahun_ajaran" value="{{ request('tahun_ajaran', $tahunAktif ?? '') }}" class="px-3 py-1.5 text-xs border border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 w-32" placeholder="Cth: 2026/2027" maxlength="9">
                            
                            <select id="input-semester" name="semester" class="px-3 py-1.5 text-xs border border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 bg-white">
                                <option value="" disabled {{ empty(request('semester', $semesterAktif ?? '')) ? 'selected' : '' }}>-- Semester --</option>
                                <option value="Ganjil" {{ (request('semester', $semesterAktif ?? '') == 'Ganjil') ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ (request('semester', $semesterAktif ?? '') == 'Genap') ? 'selected' : '' }}>Genap</option>
                            </select>
                            
                            <button type="submit" class="px-3.5 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition-all">
                                Filter
                            </button>
                        </form>

                        <!-- Form POST untuk Generate Data dengan Efek Loading -->
                        <form id="form-generate-jadwal" method="POST" action="{{ route('jadwal.generate') }}" onsubmit="prosesGenerate(event)">
                            @csrf
                            <!-- Hidden input untuk membawa parameter tahun ajaran & semester saat generate -->
                            <input type="hidden" name="tahun_ajaran" id="gen-tahun">
                            <input type="hidden" name="semester" id="gen-semester">

                            <button type="submit" id="btn-generate" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition-all shadow-sm flex items-center gap-1.5">
                                <!-- Ikon Spinner Loading (Hidden secara default) -->
                                <svg id="spinner-icon" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <!-- Ikon Default -->
                                <svg id="default-icon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                <span id="btn-text">Generate Data</span>
                            </button>
                        </form>
                    </div>

                    <!-- Script Validasi, Input Hidden, & Loading State -->
                    <script>
                        function prosesGenerate(event) {
                            // Ambil nilai dari input filter yang ada di halaman
                            const tahunAjaranEl = document.getElementById('input-tahun');
                            const semesterEl = document.getElementById('input-semester');

                            let tahun = tahunAjaranEl ? tahunAjaranEl.value : '';
                            let semester = semesterEl ? semesterEl.value : '';

                            // Jika kosong, coba ambil dari parameter URL aktif
                            if (!tahun || !semester) {
                                const urlParams = new URLSearchParams(window.location.search);
                                tahun = tahun || urlParams.get('tahun_ajaran');
                                semester = semester || urlParams.get('semester');
                            }

                            // Validasi jika belum dipilih
                            if (!tahun || !semester) {
                                event.preventDefault(); // Batalkan submit form
                                alert('Silakan pilih dan terapkan (Filter) Tahun Ajaran dan Semester terlebih dahulu!');
                                return;
                            }

                            // Masukkan nilainya ke input hidden form generate
                            document.getElementById('gen-tahun').value = tahun;
                            document.getElementById('gen-semester').value = semester;

                            // Ubah tombol menjadi status Loading
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

            <!-- GRID KARTU NAVIGASI MODUL PENDUKUNG -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                
                <!-- 1. Card Data Kelas -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all">
                    <div>
                        <span class="inline-block px-3 py-1 bg-gray-100 text-gray-600 text-[10px] font-bold rounded-full mb-3">Modul 1</span>
                        <h4 class="text-sm font-bold text-gray-800 mb-1">Data Kelas</h4>
                        <p class="text-xs text-gray-400 mb-4">Kelola daftar rombongan belajar dan kelas yang ada di sekolah.</p>
                    </div>
                    <a href="{{ route('kelas.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 border border-gray-200 hover:border-indigo-600 hover:text-indigo-600 text-gray-700 text-xs font-semibold rounded-xl transition-all">
                        Kelola Kelas &rarr;
                    </a>
                </div>

                <!-- 2. Card Data Guru -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all">
                    <div>
                        <span class="inline-block px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-full mb-3">Modul 2</span>
                        <h4 class="text-sm font-bold text-gray-800 mb-1">Data Guru</h4>
                        <p class="text-xs text-gray-400 mb-4">Kelola informasi identitas dan data pengajar aktif di sekolah.</p>
                    </div>
                    <a href="{{ route('guru.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 border border-gray-200 hover:border-indigo-600 hover:text-indigo-600 text-gray-700 text-xs font-semibold rounded-xl transition-all">
                        Kelola Guru &rarr;
                    </a>
                </div>

                <!-- 3. Card Data Mata Pelajaran -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all">
                    <div>
                        <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full mb-3">Modul 3</span>
                        <h4 class="text-sm font-bold text-gray-800 mb-1">Data Mata Pelajaran</h4>
                        <p class="text-xs text-gray-400 mb-4">Atur mapel beserta preferensi khusus seperti prioritas jam pagi.</p>
                    </div>
                    <a href="{{ route('mapel.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 border border-gray-200 hover:border-emerald-600 hover:text-emerald-600 text-gray-700 text-xs font-semibold rounded-xl transition-all">
                        Kelola Mapel &rarr;
                    </a>
                </div>

                <!-- 4. Card Mapping Pengampu -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all">
                    <div>
                        <span class="inline-block px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-full mb-3">Modul 4</span>
                        <h4 class="text-sm font-bold text-gray-800 mb-1">Mapping Pengampu</h4>
                        <p class="text-xs text-gray-400 mb-4">Tentukan alokasi beban mengajar guru di setiap kelas.</p>
                    </div>
                    <a href="{{ route('mapping.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 border border-gray-200 hover:border-amber-600 hover:text-amber-600 text-gray-700 text-xs font-semibold rounded-xl transition-all">
                        Kelola Mapping &rarr;
                    </a>
                </div>

                <!-- 5. Card Master Slot Waktu -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all lg:col-span-2">
                    <div>
                        <span class="inline-block px-3 py-1 bg-sky-50 text-sky-600 text-[10px] font-bold rounded-full mb-3">Modul 5</span>
                        <h4 class="text-sm font-bold text-gray-800 mb-1">Master Slot Waktu</h4>
                        <p class="text-xs text-gray-400 mb-4">Atur blok waktu harian, jam pelajaran (JP), dan durasi istirahat sekolah.</p>
                    </div>
                    <a href="{{ route('slot-waktu.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 border border-gray-200 hover:border-sky-600 hover:text-sky-600 text-gray-700 text-xs font-semibold rounded-xl transition-all">
                        Kelola Slot Waktu &rarr;
                    </a>
                </div>
            </div>

            <!-- CARD SUMMARY MEMANJANG KE BAWAH PER MODUL -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 mb-4 pb-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800">Ringkasan Status Kesiapan Data Modul</h3>
                        <p class="text-xs text-gray-500">Rincian jumlah data aktif pada setiap modul untuk periode saat ini.</p>
                    </div>
                    <span class="text-xs {{ (request('tahun_ajaran') && request('semester')) ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-amber-50 text-amber-700 border-amber-200' }} font-semibold px-3 py-1 rounded-xl border">
                        @if(request('tahun_ajaran') && request('semester'))
                            Periode: {{ request('tahun_ajaran') }} - {{ request('semester') }}
                        @else
                            ⚠️ Peringatan: Periode belum dipilih!
                        @endif
                    </span>
                </div>

                <!-- List Memanjang ke Bawah per Modul -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            <span class="text-xs font-semibold text-gray-700">Modul 1: Data Kelas</span>
                        </div>
                        <span class="text-xs font-bold text-gray-900 bg-white px-3 py-1 rounded-lg border border-gray-200">
                            {{ $totalKelas ?? 0 }} Kelas Terdaftar
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-semibold text-gray-700">Modul 2: Data Guru</span>
                        </div>
                        <span class="text-xs font-bold text-gray-900 bg-white px-3 py-1 rounded-lg border border-gray-200">
                            {{ $totalGuru ?? 0 }} Guru Aktif
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <span class="text-xs font-semibold text-gray-700">Modul 3: Data Mata Pelajaran</span>
                        </div>
                        <span class="text-xs font-bold text-gray-900 bg-white px-3 py-1 rounded-lg border border-gray-200">
                            {{ $totalMapel ?? 0 }} Mapel
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                            <span class="text-xs font-semibold text-gray-700">Modul 4: Mapping Pengampu</span>
                        </div>
                        <span class="text-xs font-bold text-gray-900 bg-white px-3 py-1 rounded-lg border border-gray-200">
                            {{ $totalMapping ?? 0 }} Beban Mengajar
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 rounded-full bg-cyan-500"></span>
                            <span class="text-xs font-semibold text-gray-700">Modul 5: Master Slot Waktu</span>
                        </div>
                        <span class="text-xs font-bold text-gray-900 bg-white px-3 py-1 rounded-lg border border-gray-200">
                            {{ $totalSlot ?? 0 }} Slot Waktu
                        </span>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>