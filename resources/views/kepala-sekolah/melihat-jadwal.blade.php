
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriks Jadwal Pelajaran - SIPAS</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-smpn4.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        @media print {
            @page {
                size: A4 landscape;
                margin: 5mm;
            }

            aside, .no-print, header, nav, form {
                display: none !important;
            }

            html, body {
                height: auto !important;
                overflow: visible !important;
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .main-wrapper {
                display: block !important;
                height: auto !important;
                overflow: visible !important;
            }

            main {
                padding: 0 !important;
                overflow: visible !important;
                height: auto !important;
                margin: 0 !important;
                width: 100% !important;
            }

            .print-card {
                border: none !important;
                box-shadow: none !important;
                overflow: visible !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .overflow-x-auto {
                overflow: visible !important;
            }

            .day-section {
                page-break-inside: avoid;
                break-inside: avoid;
                margin-bottom: 12px !important;
            }

            table {
                width: 100% !important;
                table-layout: fixed !important;
                font-size: 8px !important;
                page-break-inside: auto;
                border-collapse: collapse !important;
            }

            th, td {
                padding: 4px !important;
                overflow-wrap: anywhere;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            .print-heading {
                display: block !important;
            }
        }

        .print-heading { display: none; }
    </style>
</head>

<body class="bg-[#F8FAFC] antialiased text-slate-800">
<div class="flex h-screen overflow-hidden main-wrapper">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0F5EA3] text-white flex flex-col justify-between p-5 shrink-0 shadow-xl select-none overflow-y-auto no-print">
        <div>
            <div class="flex items-center space-x-3 mb-8 px-2">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md p-1 shrink-0">
                    <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-xs font-bold tracking-wider text-white">SMPN 4 SERUYAN</h1>
                    <p class="text-[10px] text-blue-200 truncate max-w-[130px] font-medium">
                        {{ Auth::user()->email ?? 'kepsek@smpn4.sch.id' }}
                    </p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Menu Utama</p>
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard.kepala-sekolah') }}"
                           class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                            <span>Dashboard Utama</span>
                        </a>
                        <a href="{{ route('kepala-sekolah.profile') }}"
                           class="flex items-center space-x-3 px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium transition-all">
                            <span>Profil Saya</span>
                        </a>
                    </nav>
                </div>

                <div>
                    <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest px-3 mb-2.5 opacity-80">Rincian Data</p>
                    <nav class="space-y-1">
                        <a href="{{ route('kepala-sekolah.guru') }}" class="block px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium">Total Guru</a>
                        <a href="{{ route('kepala-sekolah.kelas') }}" class="block px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium">Total Kelas</a>
                        <a href="{{ route('kepala-sekolah.mapel') }}" class="block px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium">Mata Pelajaran</a>
                        <a href="{{ route('kepala-sekolah.user') }}" class="block px-3.5 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-xl text-xs font-medium">Pengguna Sistem</a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-3.5 py-2.5 text-rose-200 hover:bg-rose-500/20 hover:text-rose-100 rounded-xl text-xs font-semibold transition-all">
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
        <div class="w-full space-y-6">

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 no-print">
                <div>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Jadwal Pelajaran</h2>
                    <p class="text-xs text-slate-400 mt-1">Monitoring jadwal seluruh kelas</p>
                </div>

                <div class="flex items-center gap-3">
                    <button onclick="window.print()" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all shadow-sm">
                        Cetak Jadwal
                    </button>
                    <a href="{{ route('dashboard.kepala-sekolah') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold border border-slate-200">
                        Kembali
                    </a>
                </div>
            </div>

            <!-- FILTER -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm no-print">
                <form method="GET" action="{{ route('kepala-sekolah.jadwal.cetak') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800">
                            @foreach($listTahunAjaran as $yr)
                                <option value="{{ $yr }}" {{ $tahunAjaran == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Semester</label>
                        <select name="semester" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800">
                            <option value="Ganjil" {{ $semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ $semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-[#0F5EA3] hover:bg-blue-700 text-white py-3 px-6 rounded-xl text-xs font-bold shadow-sm">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- JUDUL CETAK -->
            <div class="print-heading text-center mb-4">
                <h1 class="text-lg font-extrabold">JADWAL PELAJARAN SMPN 4 SERUYAN TENGAH</h1>
                <p class="text-xs">Tahun Ajaran: {{ $tahunAjaran }} | Semester: {{ $semester }}</p>
            </div>

            <!-- MATRIKS -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden print-card">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider"> Jadwal Pelajaran</h3>
                    <p class="text-[11px] text-slate-400 mt-1">Tahun Ajaran: {{ $tahunAjaran }} | Semester: {{ $semester }}</p>
                </div>

                <div class="overflow-x-auto p-6">
                    @php
                        $daysGrouped = [];

                        foreach ($slotWaktuList as $slot) {
                            $dayName = strtolower(trim((string) ($slot->hari ?? '')));
                            $daysGrouped[$dayName][] = $slot;
                        }

                        $namaHari = [
                            'senin' => 'Senin',
                            'selasa' => 'Selasa',
                            'rabu' => 'Rabu',
                            'kamis' => 'Kamis',
                            'jumat' => 'Jumat',
                            'sabtu' => 'Sabtu',
                            'minggu' => 'Minggu',
                        ];

                        $kolomJenis = [
                            'jenis_tampilan',
                            'jenis_slot',
                            'jenis',
                            'tipe_slot',
                            'tipe',
                            'kategori_slot',
                            'kategori',
                            'jenis_waktu',
                            'tipe_waktu',
                            'status_slot',
                        ];

                        $kolomKeterangan = [
                            'keterangan',
                            'alasan',
                            'deskripsi',
                            'catatan',
                            'keterangan_slot',
                            'alasan_penguncian',
                            'catatan_slot',
                        ];
                    @endphp

                    @forelse($daysGrouped as $day => $slots)
                        <div class="day-section mb-8 last:mb-0">
                            <h4 class="text-xs font-black uppercase tracking-wider text-blue-600 bg-blue-50 px-4 py-2.5 rounded-xl mb-3 border border-blue-100 inline-block">
                                {{ $namaHari[$day] ?? ucfirst($day) }}
                            </h4>

                            <div class="overflow-x-auto border border-slate-100 rounded-xl">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50 text-[10px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                            <th class="p-3 w-32 border-r border-slate-100 text-center">Jam</th>
                                            @foreach($kelasList as $kelas)
                                                <th class="p-3 text-center border-r border-slate-100 last:border-r-0">
                                                    {{ $kelas->nama_kelas }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                        @foreach($slots as $slot)
                                            @php
                                                $timeKey = substr((string) $slot->jam_mulai, 0, 5);
                                                $timeEnd = substr((string) $slot->jam_selesai, 0, 5);

                                                $atributSlot = $slot->getAttributes();

                                                $jenisSlot = '';
                                                foreach ($kolomJenis as $kolom) {
                                                    if (isset($atributSlot[$kolom]) && trim((string) $atributSlot[$kolom]) !== '') {
                                                        $jenisSlot = strtolower(trim((string) $atributSlot[$kolom]));
                                                        break;
                                                    }
                                                }

                                                if (
                                                    $jenisSlot === '' &&
                                                    (
                                                        !empty($atributSlot['is_terkunci']) ||
                                                        !empty($atributSlot['terkunci']) ||
                                                        !empty($atributSlot['is_locked'])
                                                    )
                                                ) {
                                                    $jenisSlot = 'terkunci';
                                                }

                                                $keteranganSlot = '';
                                                foreach ($kolomKeterangan as $kolom) {
                                                    if (isset($atributSlot[$kolom]) && trim((string) $atributSlot[$kolom]) !== '') {
                                                        $keteranganSlot = trim((string) $atributSlot[$kolom]);
                                                        break;
                                                    }
                                                }

                                                $isIstirahat = in_array($jenisSlot, ['istirahat', 'break']);
                                                $isUpacara = in_array($jenisSlot, ['upacara']);
                                                $isIshoma = in_array($jenisSlot, ['ishoma']);
                                                $isTerkunci = in_array($jenisSlot, ['terkunci', 'locked']);

                                                $barisKhusus = $isIstirahat || $isUpacara || $isIshoma || $isTerkunci;
                                            @endphp

                                            <tr class="{{ $barisKhusus ? '' : 'hover:bg-slate-50/50' }}">
                                                <td class="p-3 border-r border-slate-100 text-center font-mono text-[11px] font-bold text-slate-600 bg-slate-50/70">
                                                    {{ $timeKey }} – {{ $timeEnd }}
                                                </td>

                                                @foreach($kelasList as $kelas)
                                                    @php
                                                        $cell = $matriksJadwal[$day][$timeKey][$kelas->id_kelas] ?? null;
                                                    @endphp

                                                    @if($isUpacara)
                                                        <td class="p-3 border-r border-slate-100 last:border-r-0 text-center bg-blue-50">
                                                            <div class="font-extrabold text-blue-700">Upacara</div>
                                                            <div class="text-[10px] text-blue-600 mt-1">Kegiatan sekolah</div>
                                                        </td>

                                                    @elseif($isIstirahat || $isIshoma)
                                                        <td class="p-3 border-r border-slate-100 last:border-r-0 text-center bg-amber-50">
                                                            <div class="font-extrabold text-amber-700">
                                                                {{ $isIshoma ? 'Istirahat / Ishoma' : 'Istirahat' }}
                                                            </div>
                                                            <div class="text-[10px] text-amber-600 mt-1">Tidak ada kegiatan belajar</div>
                                                        </td>

                                                    @elseif($isTerkunci)
                                                        <td class="p-3 border-r border-slate-100 last:border-r-0 text-center bg-slate-100">
                                                            <div class="flex flex-col items-center gap-1">
                                                                <span class="inline-flex items-center gap-1 rounded-lg bg-white border border-slate-200 px-2 py-1 font-extrabold text-slate-600">
                                                                    <span aria-hidden="true"></span>
                                                                    Slot Dikunci
                                                                </span>

                                                                @if($keteranganSlot !== '')
                                                                    <span class="text-[10px] text-slate-600 leading-relaxed">
                                                                        {{ $keteranganSlot }}
                                                                    </span>
                                                                @else
                                                                    <span class="text-[10px] text-slate-500 leading-relaxed">
                                                                        Tidak digunakan untuk penjadwalan pelajaran
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>

                                                    @elseif($cell)
                                                        <td class="p-3 border-r border-slate-100 last:border-r-0 text-center align-middle">
                                                            <div class="font-extrabold text-slate-900">
                                                                {{ $cell['mapel'] }}
                                                            </div>
                                                            <div class="text-[10px] text-slate-500 font-medium mt-1">
                                                                {{ $cell['guru'] }}
                                                            </div>
                                                        </td>

                                                    @else
                                                        <td class="p-3 border-r border-slate-100 last:border-r-0 text-center">
                                                            <span class="text-slate-300">-</span>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-slate-400 font-medium">
                            Belum ada slot waktu yang terdaftar.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
