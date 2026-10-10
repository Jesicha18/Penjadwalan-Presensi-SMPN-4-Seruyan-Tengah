<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Jadwal Pelajaran </title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    
    <!-- Wrapper Utama Layout Dashboard (Sidebar + Konten) -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar Sesuai Request -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 shadow-sm overflow-y-auto">
            <div>
                <!-- User Profile Header -->
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center text-white justify-center font-bold shadow-md shadow-indigo-100">
                        S
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-gray-900 tracking-wider">SMPN 4 SERUYAN</h1>
                        <p class="text-[10px] text-gray-400 truncate max-w-[130px]">{{ Auth::user()->email ?? 'mashel@gmail.com' }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4 transition-transform duration-300 ease-in-out group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <!-- Profil Saya -->
                            <a href="{{ route('waka.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <!-- Menu Khusus "Buat Jadwal" -->
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl text-xs font-medium transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>
                            <!-- Menu Utama Jadwal Pelajaran (Aktif) -->
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-semibold transition-all duration-300 ease-in-out">
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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <span>Mata Pelajaran</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Tombol Keluar Akun -->
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

        <!-- Area Konten Utama (Bisa di-scroll mandiri) -->
        <main class="flex-1 overflow-y-auto px-6 py-8">
            <div class="max-w-7xl mx-auto">
                
                <!-- Header, Navigasi & Filter Tahun Ajaran -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mt-2">Jadwal Pelajaran Per Kelas</h1>
                        <p class="text-sm text-gray-500">Periode Aktif: <span class="font-medium text-gray-700">{{ $tahunAjaran }}</span> | Semester: <span class="font-medium text-gray-700">{{ $semester }}</span></p>
                    </div>

                    <!-- Form Filter Pilihan Tahun Ajaran & Semester -->
                    <form action="{{ route('jadwal-pelajaran.show') }}" method="GET" class="flex items-center gap-2">
                        
                        <!-- Dropdown Tahun Ajaran -->
                        <select name="tahun_ajaran" class="px-3 py-1.5 text-xs border border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 bg-white shadow-sm">
                            @foreach($listTahunAjaran as $ta)
                                <option value="{{ $ta }}" {{ $tahunAjaran == $ta ? 'selected' : '' }}>
                                    {{ $ta }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Dropdown Semester -->
                        <select name="semester" class="px-3 py-1.5 text-xs border border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 bg-white shadow-sm">
                            <option value="Ganjil" {{ $semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ $semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>

                        <!-- Tombol Pilih -->
                        <button type="submit" class="px-3.5 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition-all">
                            Pilih
                        </button>
                    </form>

                    <div class="flex items-center gap-3">
                        <!-- Tombol Cetak -->
                        <button onclick="window.print()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg shadow-sm flex items-center gap-1.5 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Jadwal
                        </button>
                        <a href="{{ route('jadwal.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-xs px-4 py-2 rounded-lg shadow-sm transition">
                            &larr; Kembali
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r-xl shadow-sm">
                        <p class="font-bold text-sm">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Wrapper Matriks per Hari -->
                <div class="space-y-8">
                    @php 
                        $groupedSlots = $slotWaktuList->groupBy('hari');
                    @endphp

                    @forelse($groupedSlots as $hari => $slotsPerHari)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                            <!-- Judul Header Hari -->
                            <div class="bg-indigo-900 text-white px-5 py-3 font-bold text-sm tracking-wide">
                                <span>{{ strtoupper($hari) }}</span>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100/80 text-gray-700 uppercase text-xs tracking-wider border-b border-gray-200">
                                            <th class="py-3 px-3 border border-gray-200 text-center w-20">Jam Ke</th>
                                            <th class="py-3 px-3 border border-gray-200 text-center w-32">Waktu</th>
                                            @foreach($kelasList as $kelas)
                                                <th class="py-3 px-3 border border-gray-200 text-center font-bold text-gray-900 min-w-[140px]">
                                                    {{ $kelas->nama_kelas }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 text-gray-700 text-sm">
                                        @foreach($slotsPerHari as $slot)
                                            @php
                                                $hariLower = strtolower(trim($hari));
                                                $jamSlot = substr($slot->jam_mulai, 0, 5);
                                            @endphp
                                            <tr class="hover:bg-gray-50/50 transition">
                                                <!-- Kolom Jam Ke / Jenis -->
                                                <td class="py-3 px-2 border border-gray-200 text-center font-semibold bg-gray-50/50 text-xs">
                                                    @if(!empty($slot->jenis) && in_array(strtolower($slot->jenis), ['istirahat', 'upacara', 'ishoma', 'terkunci']))
                                                        <span class="text-amber-600 uppercase font-bold tracking-wider">{{ $slot->jenis }}</span>
                                                    @else
                                                        JP {{ $slot->urutan ?? $loop->iteration }}
                                                    @endif
                                                </td>

                                                <!-- Kolom Waktu -->
                                                <td class="py-3 px-3 border border-gray-200 text-center text-gray-500 whitespace-nowrap text-xs font-mono">
                                                    {{ substr($slot->jam_mulai, 0, 5) }} - {{ substr($slot->jam_selesai, 0, 5) }}
                                                </td>

                                                <!-- Jika Jenis Istirahat / Upacara / Terkunci -->
                                                @if(!empty($slot->jenis) && in_array(strtolower($slot->jenis), ['istirahat', 'upacara', 'ishoma', 'terkunci']))
                                                    <td colspan="{{ count($kelasList) }}" class="py-3 px-3 border border-gray-200 text-center font-bold text-amber-700 bg-amber-50/50 tracking-wide text-xs">
                                                        --- {{ strtoupper($slot->keterangan ?? $slot->jenis) }} ---
                                                    </td>
                                                @else
                                                    <!-- Kolom per Kelas untuk Jam Pelajaran -->
                                                    @foreach($kelasList as $kelas)
                                                        <td class="py-3 px-3 border border-gray-200 align-top">
                                                            @if(isset($matriksJadwal[$hariLower][$jamSlot][$kelas->id_kelas]))
                                                                <div class="font-bold text-gray-900 text-xs leading-snug">
                                                                    {{ $matriksJadwal[$hariLower][$jamSlot][$kelas->id_kelas]['mapel'] }}
                                                                </div>
                                                                <div class="text-[11px] text-gray-500 italic mt-0.5">
                                                                    ({{ $matriksJadwal[$hariLower][$jamSlot][$kelas->id_kelas]['guru'] }})
                                                                </div>
                                                            @else
                                                                <span class="text-gray-300 italic text-xs">- Kosong -</span>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                @endif
                                                @if (session('success'))
                                                        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif

                                                    @if (session('error'))
                                                        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800">
                                                            <strong>Generate jadwal gagal!</strong>
                                                            <p class="mt-1">{{ session('error') }}</p>
                                                        </div>
                                                    @endif
                                                                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-gray-200 rounded-xl p-10 text-center text-gray-400 text-sm">
                            Belum ada data slot waktu di dalam database.
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>

    <style>
        @media print {
            /* Sembunyikan sidebar dan navigasi tidak perlu saat dicetak */
            aside, form, header, button, a[href*="jadwal"] {
                display: none !important;
            }
            
            /* Ubah layout agar halaman cetak full */
            .flex.h-screen {
                display: block !important;
                height: auto !important;
            }

            main {
                overflow: visible !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            body {
                background-color: white !important;
                color: black !important;
            }

            .max-w-7xl {
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            div, table {
                box-shadow: none !important;
            }
        }
    </style>

</body>
</html>