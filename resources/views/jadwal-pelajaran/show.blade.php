<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriks Jadwal Pelajaran Per Kelas</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <div class="max-w-7xl mx-auto px-4 py-8">
        
        <!-- Header, Navigasi & Filter Tahun Ajaran -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Jadwal Pelajaran Per Kelas</h1>
                <p class="text-sm text-gray-500">Periode Aktif: <span class="font-medium text-gray-700">{{ $tahunAjaran }}</span> | Semester: <span class="font-medium text-gray-700">{{ $semester }}</span></p>
            </div>

            <!-- Form Filter Pilihan Tahun Ajaran & Semester -->
<!-- Pastikan dibungkus tag form yang mengarah ke route show -->
            <form action="{{ route('jadwal-pelajaran.show') }}" method="GET" class="flex items-center gap-2">
                
                <!-- Dropdown Tahun Ajaran -->
                <select name="tahun_ajaran" class="form-select">
                    @foreach($listTahunAjaran as $ta)
                        <option value="{{ $ta }}" {{ $tahunAjaran == $ta ? 'selected' : '' }}>
                            {{ $ta }}
                        </option>
                    @endforeach
                </select>

                <!-- Dropdown Semester -->
                <select name="semester" class="form-select">
                    <option value="Ganjil" {{ $semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="Genap" {{ $semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                </select>

                <!-- Tombol Pilih (Pastikan type="submit") -->
                <button type="submit" class="btn btn-primary">Pilih</button>
            </form>

            <div class="flex items-center gap-3">
                <!-- Tombol Cetak -->
                <button onclick="window.print()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg shadow-sm flex items-center gap-1.5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Jadwal
                </button>
                <a href="{{ route('jadwal.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-4 py-2 rounded-lg shadow-sm transition">
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
                                                    @php
                                                        $hariLower = strtolower(trim($hari));
                                                        $jamSlot = substr($slot->jam_mulai, 0, 5);
                                                    @endphp
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
        <style>
@media print {
    /* Sembunyikan elemen yang tidak perlu dicetak */
    form, nav, header, aside, .no-print, button {
        display: none !important;
    }
    
    /* Atur agar body putih bersih dan tabel pas di kertas */
    body {
        background-color: white !important;
        color: black !important;
    }

    /* Pastikan kontainer tabel full lebar kertas */
    .max-w-7xl {
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    /* Hilangkan bayangan/shadow box agar cetakan rapi */
    div, table {
        box-shadow: none !important;
    }
}
</style>

    </div>
</body>
</html>