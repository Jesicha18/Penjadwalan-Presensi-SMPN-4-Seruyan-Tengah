<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pelajaran - SMPN 4 Seruyan Tengah</title>
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
    
    <!-- Wrapper Utama Layout Dashboard (Sidebar + Konten) -->
    <div class="flex h-screen overflow-hidden">

        <!-- ================= 1. SIDEBAR KIRI (DARK DEEP BLUE) ================= -->
        <aside class="w-64 bg-[#0F5EA3] text-white flex flex-col justify-between p-5 shrink-0 shadow-xl select-none overflow-y-auto">
            <div>
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

                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard.waka') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('waka.profile') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('jadwal.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Buat Jadwal</span>
                            </a>
                            <!-- Menu Utama Jadwal Pelajaran (Aktif) -->
                            <a href="{{ route('jadwal-pelajaran.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 bg-white/20 text-white rounded-xl text-xs font-bold shadow-inner transition-all">
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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2v0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
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
        

        <!-- ================= 2. KONTEN UTAMA (FULL WIDTH) ================= -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">

            <div class="max-w-7xl mx-auto space-y-6">
                
                <!-- Header, Navigasi & Filter Tahun Ajaran -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between pb-4 border-b border-slate-200 gap-4">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Jadwal Pelajaran Per Kelas</h1>
                        <p class="text-xs text-slate-400 mt-0.5">Periode Aktif: <span class="font-bold text-slate-700">{{ $tahunAjaran }}</span> | Semester: <span class="font-bold text-slate-700">{{ $semester }}</span></p>
                    </div>

                    <!-- Form Filter Pilihan Tahun Ajaran & Semester -->
                    <form action="{{ route('jadwal-pelajaran.show') }}" method="GET" class="flex items-center gap-2">
                        <select name="tahun_ajaran" class="px-3.5 py-2 text-xs border border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 bg-white shadow-sm font-semibold cursor-pointer">
                            @foreach($listTahunAjaran as $ta)
                                <option value="{{ $ta }}" {{ $tahunAjaran == $ta ? 'selected' : '' }}>
                                    {{ $ta }}
                                </option>
                            @endforeach
                        </select>

                        <select name="semester" class="px-3.5 py-2 text-xs border border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 bg-white shadow-sm font-semibold cursor-pointer">
                            <option value="Ganjil" {{ $semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ $semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>

                        <button type="submit" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all">
                            Pilih
                        </button>
                    </form>

                    <div class="flex items-center gap-3">
                        <button onclick="window.print()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-md flex items-center gap-1.5 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Jadwal
                        </button>
                        <a href="{{ route('jadwal.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs px-4 py-2 rounded-xl border border-slate-200 shadow-sm transition">
                            &larr; Kembali
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 bg-rose-50 text-rose-800 border border-rose-200 rounded-xl text-xs font-bold space-y-1 shadow-sm">
                        <span class="block mb-1 font-extrabold">Generate jadwal gagal!</span>
                        <p class="font-normal">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Wrapper Matriks per Hari -->
                <div class="print-area space-y-6">
                        @php 
                        $groupedSlots = $slotWaktuList->groupBy('hari');
                    @endphp

                    @forelse($groupedSlots as $hari => $slotsPerHari)
                        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                            <!-- Judul Header Hari -->
                            <div class="bg-[#0F5EA3] text-white px-6 py-3.5 font-bold text-xs tracking-wider uppercase">
                                <span>{{ strtoupper($hari) }}</span>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse text-xs">
                                    <thead>
                                        <tr class="bg-slate-50 text-slate-400 uppercase text-[11px] tracking-wider border-b border-slate-100 font-extrabold">
                                            <th class="py-3.5 px-4 text-center w-20">Jam Ke</th>
                                            <th class="py-3.5 px-4 text-center w-32">Waktu</th>
                                            @foreach($kelasList as $kelas)
                                                <th class="py-3.5 px-4 text-center font-bold text-slate-900 min-w-[140px]">
                                                    {{ $kelas->nama_kelas }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-700">
                                        @foreach($slotsPerHari as $slot)
                                            @php
                                                $hariLower = strtolower(trim($hari));
                                                $jamSlot = substr($slot->jam_mulai, 0, 5);
                                            @endphp
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <!-- Kolom Jam Ke / Jenis -->
                                                <td class="py-3.5 px-3 text-center font-bold bg-slate-50/40 text-slate-900 text-xs">
                                                    @if(!empty($slot->jenis) && in_array(strtolower($slot->jenis), ['istirahat', 'upacara', 'ishoma', 'terkunci']))
                                                        <span class="text-amber-600 uppercase font-extrabold tracking-wider">{{ $slot->jenis }}</span>
                                                    @else
                                                        JP {{ $slot->urutan ?? $loop->iteration }}
                                                    @endif
                                                </td>

                                                <!-- Kolom Waktu -->
                                                <td class="py-3.5 px-4 text-center text-slate-500 whitespace-nowrap text-xs font-mono font-bold">
                                                    {{ substr($slot->jam_mulai, 0, 5) }} - {{ substr($slot->jam_selesai, 0, 5) }}
                                                </td>

                                                <!-- Jika Jenis Istirahat / Upacara / Terkunci -->
                                                @if(!empty($slot->jenis) && in_array(strtolower($slot->jenis), ['istirahat', 'upacara', 'ishoma', 'terkunci']))
                                                    <td colspan="{{ count($kelasList) }}" class="py-3.5 px-4 text-center font-extrabold text-amber-700 bg-amber-50/50 tracking-wider text-xs">
                                                        --- {{ strtoupper($slot->keterangan ?? $slot->jenis) }} ---
                                                    </td>
                                                @else
                                                    <!-- Kolom per Kelas untuk Jam Pelajaran -->
                                                    @foreach($kelasList as $kelas)
                                                        <td class="py-3.5 px-4 align-top">
                                                            @if(isset($matriksJadwal[$hariLower][$jamSlot][$kelas->id_kelas]))
                                                                <div class="font-bold text-slate-900 text-xs leading-snug">
                                                                    {{ $matriksJadwal[$hariLower][$jamSlot][$kelas->id_kelas]['mapel'] }}
                                                                </div>
                                                                <div class="text-[11px] text-slate-400 italic mt-0.5 font-medium">
                                                                    ({{ $matriksJadwal[$hariLower][$jamSlot][$kelas->id_kelas]['guru'] }})
                                                                </div>
                                                            @else
                                                                <span class="text-slate-300 italic text-xs font-medium">Kosong -</span>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-slate-100 rounded-2xl p-12 text-center text-slate-400 text-xs font-bold shadow-sm">
                            Belum ada data slot waktu di dalam database.
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>

    <!-- Style Cetak / Print -->
    
<style>
    /* Pengaturan khusus saat mencetak */
    @page {
        size: A4 landscape;
        margin: 8mm;
    }

    @media print {
        /* Sembunyikan seluruh dashboard */
        body * {
            visibility: hidden !important;
        }

        /* Tampilkan hanya tabel jadwal */
        .print-area,
        .print-area * {
            visibility: visible !important;
        }

        /* Jadikan area jadwal sebagai halaman cetak */
        .print-area {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            display: block !important;
            overflow: visible !important;
        }

        /* Hilangkan dekorasi dashboard */
        .print-area .bg-white {
            box-shadow: none !important;
            border-color: #cbd5e1 !important;
            border-radius: 0 !important;
        }

        /* Hilangkan batas scroll horizontal */
        .print-area .overflow-x-auto {
            overflow: visible !important;
        }

        /* Paksa seluruh kolom kelas masuk ke halaman */
        .print-area table {
            width: 100% !important;
            min-width: 0 !important;
            max-width: 100% !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
            font-size: 8px !important;
        }

        /* Ukuran kolom Jam Ke dan Waktu */
        .print-area th:first-child,
        .print-area td:first-child {
            width: 7% !important;
        }

        .print-area th:nth-child(2),
        .print-area td:nth-child(2) {
            width: 11% !important;
        }

        /* Enam kolom kelas: 7A sampai 9B */
        .print-area th:nth-child(n+3),
        .print-area td:nth-child(n+3) {
            width: 13.666% !important;
            min-width: 0 !important;
            max-width: none !important;
            padding: 5px 4px !important;
            overflow-wrap: anywhere !important;
            word-break: normal !important;
        }

        /* Ukuran teks mata pelajaran dan guru */
        .print-area td .font-bold {
            font-size: 8px !important;
            line-height: 1.3 !important;
        }

        .print-area td .italic {
            font-size: 7px !important;
            line-height: 1.2 !important;
        }

        /* Rapikan header tabel */
        .print-area th {
            font-size: 8px !important;
            padding: 6px 3px !important;
        }

        /* Pertahankan warna penting jika didukung browser */
        .print-area * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Usahakan setiap blok hari tidak terpotong */
        .print-area > div {
            break-inside: auto;
            page-break-inside: auto;
        }

        .print-area thead {
            display: table-header-group;
        }

        .print-area tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        /* Jangan cetak elemen interaktif */
        button,
        input,
        select,
        form {
            display: none !important;
        }
    }
</style>


</body>
</html>