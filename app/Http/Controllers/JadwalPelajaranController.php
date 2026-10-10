<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\MappingPengampu;
use App\Models\SlotWaktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class JadwalPelajaranController extends Controller
{
    private array $cspSlots = [];
    private array $cspDaySlots = [];
    private array $cspMappings = [];
    private array $cspMappingInfo = [];
    private array $cspClassMappings = [];
    private array $cspMappingDemand = [];
    private array $cspTotalClassDemand = [];
    private array $cspTotalTeacherDemand = [];
    private array $cspClassTarget = [];
    private array $cspState = [];

    private int $cspNodes = 0;
    private int $cspMaxNodes = 300000;
    /** Urutan kelas untuk backtracking global lintas kelas. */
    private array $cspOrderedClassIds = [];

    private array $cspDayOrder = [
        'senin' => 1,
        'selasa' => 2,
        'rabu' => 3,
        'kamis' => 4,
        'jumat' => 5,
        'sabtu' => 6,
    ];

    private array $cspExpectedSlotsPerDay = [
        'senin' => 7,
        'selasa' => 8,
        'rabu' => 8,
        'kamis' => 8,
        'jumat' => 5,
        'sabtu' => 5,
    ];

    public function index(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => [
                'nullable',
                'regex:/^\d{4}\/\d{4}$/',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        [$awal, $akhir] = explode('/', $value);
                        if ((int) $akhir !== (int) $awal + 1) {
                            $fail('Tahun ajaran harus berurutan, contoh 2026/2027.');
                        }
                    }
                },
            ],
            'semester' => ['nullable', 'in:Ganjil,Genap'],
        ]);

        $listTahunAjaran = JadwalPelajaran::query()
            ->whereNotNull('tahun_ajaran')
            ->distinct()
            ->orderByDesc('tahun_ajaran')
            ->pluck('tahun_ajaran')
            ->toArray();

        if (empty($listTahunAjaran)) {
            $listTahunAjaran = [date('Y') . '/' . (date('Y') + 1)];
        }

        $tahunAjaran = $request->input(
            'tahun_ajaran',
            session('tahun_ajaran_aktif', $listTahunAjaran[0])
        );
        $semester = $request->input('semester', session('semester_aktif', 'Ganjil'));

        session([
            'tahun_ajaran_aktif' => $tahunAjaran,
            'semester_aktif' => $semester,
        ]);

        $totalKelas = Kelas::count();
        $totalGuru = Guru::count();
        $totalMapel = MataPelajaran::count();
        $totalMapping = MappingPengampu::count();
        $totalSlot = SlotWaktu::count();

        return view('jadwal.index', compact(
            'tahunAjaran', 'semester', 'listTahunAjaran',
            'totalKelas', 'totalGuru', 'totalMapel', 'totalMapping', 'totalSlot'
        ));
    }

    public function show(Request $request)
    {
        $listTahunAjaran = JadwalPelajaran::query()
            ->whereNotNull('tahun_ajaran')
            ->distinct()
            ->orderByDesc('tahun_ajaran')
            ->pluck('tahun_ajaran')
            ->toArray();

        if (empty($listTahunAjaran)) {
            $listTahunAjaran = [date('Y') . '/' . (date('Y') + 1)];
        }

        $tahunAjaran = $request->input(
            'tahun_ajaran',
            session('tahun_ajaran_aktif', $listTahunAjaran[0])
        );
        $semester = $request->input('semester', session('semester_aktif', 'Ganjil'));

        session([
            'tahun_ajaran_aktif' => $tahunAjaran,
            'semester_aktif' => $semester,
        ]);

        $kelasList = Kelas::where('is_active', 1)->orderBy('nama_kelas')->get();
        $slotWaktuList = SlotWaktu::orderBy('urutan')->get();
        $jadwalList = JadwalPelajaran::with([
            'mataPelajaran', 'guru', 'kelas', 'slotWaktu',
        ])
            ->where('tahun_ajaran', $tahunAjaran)
            ->where('semester', $semester)
            ->get();

        $matriksJadwal = [];
        foreach ($jadwalList as $jadwal) {
            $slot = $jadwal->slotWaktu;
            $hari = strtolower(trim($slot->hari ?? $jadwal->hari ?? ''));
            $jam = substr(trim($slot->jam_mulai ?? $jadwal->jam_mulai ?? ''), 0, 5);
            $kelasId = $jadwal->kelas_id;
            $data = [
                'mapel' => $jadwal->mataPelajaran->nama_mapel ?? '-',
                'guru' => $jadwal->guru->nama ?? '-',
            ];
            $matriksJadwal[$hari][$jam][$kelasId] = $data;
            if ($jadwal->slot_waktu_id) {
                $matriksJadwal['by_slot'][$jadwal->slot_waktu_id][$kelasId] = $data;
            }
        }

        return view('jadwal-pelajaran.show', compact(
            'slotWaktuList', 'kelasList', 'matriksJadwal',
            'tahunAjaran', 'semester', 'listTahunAjaran'
        ));
    }

    public function setFilter(Request $request)
    {
        $data = $request->validate([
            'tahun_ajaran' => [
                'required',
                'regex:/^\d{4}\/\d{4}$/',
                function ($attribute, $value, $fail) {
                    [$awal, $akhir] = explode('/', $value);
                    if ((int) $akhir !== (int) $awal + 1) {
                        $fail('Tahun ajaran harus berurutan.');
                    }
                },
            ],
            'semester' => ['required', 'in:Ganjil,Genap'],
        ]);

        session([
            'tahun_ajaran_aktif' => $data['tahun_ajaran'],
            'semester_aktif' => $data['semester'],
        ]);

        return redirect()->route('jadwal-pelajaran.show', $data);
    }

    public function generate(Request $request)
    {
        $tahunAjaran = $request->input('tahun_ajaran', session('tahun_ajaran_aktif'));
        $semester = $request->input('semester', session('semester_aktif', 'Ganjil'));

        if (!$tahunAjaran) {
            $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
        }

        $validator = Validator::make([
            'tahun_ajaran' => $tahunAjaran,
            'semester' => $semester,
        ], [
            'tahun_ajaran' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
            'semester' => ['required', 'in:Ganjil,Genap'],
        ]);

        if ($validator->fails()) {
            return $this->generateError((string) $tahunAjaran, (string) $semester, $validator->errors()->first());
        }

        [$tahunAwal, $tahunAkhir] = explode('/', $tahunAjaran);
        if ((int) $tahunAkhir !== (int) $tahunAwal + 1) {
            return $this->generateError($tahunAjaran, $semester, 'Tahun ajaran harus berurutan, contoh 2026/2027.');
        }

        session(['tahun_ajaran_aktif' => $tahunAjaran, 'semester_aktif' => $semester]);
        @set_time_limit(300);
        $this->resetCspState();

        $kelasList = Kelas::where('is_active', 1)->orderBy('nama_kelas')->get();
        if ($kelasList->isEmpty()) {
            return $this->generateError($tahunAjaran, $semester, 'Tidak ada kelas aktif.');
        }

        $activeClassIds = $kelasList->pluck('id_kelas')->map(fn ($id) => (int) $id)->all();

        $slotCollection = SlotWaktu::where('jenis', 'jp')->get()->sortBy(function ($slot) {
            $hari = strtolower(trim($slot->hari));
            return sprintf('%02d-%05d', $this->cspDayOrder[$hari] ?? 99, (int) $slot->urutan);
        })->values();

        foreach ($slotCollection as $slot) {
            $slotId = (int) $slot->getKey();
            $hari = strtolower(trim($slot->hari));
            if (!isset($this->cspDayOrder[$hari])) {
                continue;
            }
            $this->cspSlots[$slotId] = [
                'id' => $slotId,
                'hari' => $hari,
                'urutan' => (int) $slot->urutan,
                'jam_mulai' => $slot->jam_mulai,
                'jam_selesai' => $slot->jam_selesai,
            ];
            $this->cspDaySlots[$hari][] = $slotId;
        }

        foreach ($this->cspDaySlots as &$slotIds) {
            usort($slotIds, fn ($a, $b) => $this->cspSlots[$a]['urutan'] <=> $this->cspSlots[$b]['urutan']);
        }
        unset($slotIds);

        foreach ($this->cspExpectedSlotsPerDay as $hari => $expected) {
            $actual = count($this->cspDaySlots[$hari] ?? []);
            if ($actual !== $expected) {
                return $this->generateError(
                    $tahunAjaran, $semester,
                    "Slot JP hari {$hari} berjumlah {$actual}, seharusnya {$expected}. Periksa tabel slot_waktus."
                );
            }
        }

        $jumlahSlot = count($this->cspSlots);
        $expectedTotal = array_sum($this->cspExpectedSlotsPerDay);
        if ($jumlahSlot !== $expectedTotal) {
            return $this->generateError($tahunAjaran, $semester, "Total slot JP {$jumlahSlot}; seharusnya {$expectedTotal}.");
        }

        $mappingCollection = MappingPengampu::with(['mataPelajaran', 'guru', 'kelas'])
            ->where('jumlah_jp', '>', 0)
            ->get()
            ->filter(fn ($mapping) => in_array((int) $mapping->kelas_id, $activeClassIds, true))
            ->values();

        if ($mappingCollection->isEmpty()) {
            return $this->generateError($tahunAjaran, $semester, 'Data mapping pengampu belum tersedia.');
        }

        foreach ($mappingCollection as $mapping) {
            $mappingKey = (string) $mapping->getKey();
            $classId = (int) $mapping->kelas_id;
            $jumlahJp = (int) $mapping->jumlah_jp;

            if (!$mapping->guru_id || !$mapping->mata_pelajaran_id || !$mapping->kelas_id) {
                return $this->generateError($tahunAjaran, $semester, "Mapping {$mappingKey} belum memiliki kelas, guru, atau mapel.");
            }

            $mapel = $mapping->mataPelajaran;
            $guru = $mapping->guru;
            if (!$mapel || !$guru) {
                return $this->generateError($tahunAjaran, $semester, "Mapping {$mappingKey} memiliki relasi guru atau mata pelajaran yang tidak valid.");
            }

            // Simpan model hanya untuk proses penyimpanan; pencarian menggunakan scalar cache ini.
            $this->cspMappings[$mappingKey] = $mapping;
            $this->cspMappingInfo[$mappingKey] = [
                'guru_id' => (int) $mapping->guru_id,
                'mapel_id' => (int) $mapping->mata_pelajaran_id,
                'nama_mapel' => strtolower(trim((string) ($mapel->nama_mapel ?? ''))),
                'prioritas_pagi' => (bool) ($mapel->prioritas_jam_pagi ?? false),
            ];
            $this->cspMappingDemand[$mappingKey] = $jumlahJp;
            $this->cspClassMappings[$classId][] = $mappingKey;
            $this->cspTotalClassDemand[$classId] = ($this->cspTotalClassDemand[$classId] ?? 0) + $jumlahJp;
            $guruId = (int) $mapping->guru_id;
            $this->cspTotalTeacherDemand[$guruId] = ($this->cspTotalTeacherDemand[$guruId] ?? 0) + $jumlahJp;
        }

        foreach ($kelasList as $kelas) {
            $classId = (int) $kelas->id_kelas;
            $demand = $this->cspTotalClassDemand[$classId] ?? 0;
            if ($demand !== $jumlahSlot) {
                return $this->generateError(
                    $tahunAjaran, $semester,
                    "Kebutuhan kelas {$kelas->nama_kelas} adalah {$demand} JP, sedangkan slot tersedia {$jumlahSlot} JP. Sesuaikan mapping dengan kurikulum sebelum generate."
                );
            }
            $this->cspClassTarget[$classId] = $demand;
        }

        foreach ($this->cspTotalTeacherDemand as $guruId => $demand) {
            if ($demand > $jumlahSlot) {
                $guru = Guru::find($guruId);
                return $this->generateError($tahunAjaran, $semester, 'Total beban guru ' . ($guru->nama ?? "ID {$guruId}") . " adalah {$demand} JP, melebihi {$jumlahSlot} slot.");
            }
        }

        foreach ($this->cspClassTarget as $classId => $target) {
            $this->cspState['classAssignments'][$classId] = [];
            $this->cspState['classFilled'][$classId] = 0;
            $this->cspState['classDays'][$classId] = [];
        }
        foreach ($this->cspMappingDemand as $key => $demand) {
            $this->cspState['mappingScheduled'][$key] = 0;
            $this->cspState['mappingDays'][$key] = [];
        }
        foreach ($this->cspTotalTeacherDemand as $guruId => $demand) {
            $this->cspState['teacherBusy'][$guruId] = [];
            $this->cspState['teacherScheduled'][$guruId] = 0;
        }

        // Backtracking global: kelas disusun berurutan, tetapi bila kelas berikutnya
        // buntu, pencarian kembali ke pilihan kelas sebelumnya dan mencoba alternatif.
        $this->cspOrderedClassIds = $kelasList
            ->map(fn ($kelas) => (int) $kelas->id_kelas)
            ->values()
            ->all();

        $berhasil = !empty($this->cspOrderedClassIds)
            && $this->backtrackBlockCSP($this->cspOrderedClassIds[0], 0);

        if (!$berhasil) {
            $pesan = $this->cspNodes >= $this->cspMaxNodes
                ? 'Batas pencarian Backtracking global tercapai.'
                : 'Tidak ditemukan kombinasi jadwal global yang memenuhi seluruh batasan CSP.';
            return $this->generateError(
                $tahunAjaran, $semester,
                $pesan . " Node diperiksa: {$this->cspNodes}. Periksa mapping pengampu, ketersediaan guru, dan pembagian blok mapel. Jadwal lama tidak dihapus."
            );
        }

        if (!$this->validateFinalSchedule()) {
            return $this->generateError($tahunAjaran, $semester, 'Jadwal tidak lolos validasi akhir. Jadwal lama tetap dipertahankan.');
        }

        try {
            DB::transaction(function () use ($tahunAjaran, $semester) {
                $insertData = [];
                foreach ($this->cspState['classAssignments'] as $classId => $assignments) {
                    foreach ($assignments as $slotId => $mappingKey) {
                        $mapping = $this->cspMappings[$mappingKey] ?? null;
                        $slot = $this->cspSlots[$slotId] ?? null;
                        if (!$mapping || !$slot) {
                            throw new \RuntimeException('Mapping atau slot tidak ditemukan.');
                        }
                        $insertData[] = [
                            'mata_pelajaran_id' => (int) $mapping->mata_pelajaran_id,
                            'guru_id' => (int) $mapping->guru_id,
                            'kelas_id' => (int) $classId,
                            'slot_waktu_id' => (int) $slotId,
                            'hari' => $slot['hari'],
                            'jam_mulai' => $slot['jam_mulai'],
                            'jam_selesai' => $slot['jam_selesai'],
                            'tahun_ajaran' => $tahunAjaran,
                            'semester' => $semester,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                JadwalPelajaran::where('tahun_ajaran', $tahunAjaran)
                    ->where('semester', $semester)
                    ->delete();

                foreach (array_chunk($insertData, 500) as $chunk) {
                    JadwalPelajaran::insert($chunk);
                }
            });
        } catch (Throwable $e) {
            report($e);
            return $this->generateError($tahunAjaran, $semester, 'Gagal menyimpan jadwal. Periksa log Laravel.');
        }

        $totalTerjadwal = array_sum($this->cspState['classFilled']);
        return redirect()->route('jadwal-pelajaran.show', [
            'tahun_ajaran' => $tahunAjaran,
            'semester' => $semester,
        ])->with('success', "Generate berhasil: {$totalTerjadwal} JP. Node pencarian: {$this->cspNodes}.");
    }

    private function resetCspState(): void
    {
        $this->cspSlots = [];
        $this->cspDaySlots = [];
        $this->cspMappings = [];
        $this->cspMappingInfo = [];
        $this->cspClassMappings = [];
        $this->cspMappingDemand = [];
        $this->cspTotalClassDemand = [];
        $this->cspTotalTeacherDemand = [];
        $this->cspClassTarget = [];
        $this->cspState = [];
        $this->cspNodes = 0;
        $this->cspOrderedClassIds = [];
    }

    private function generateError(string $tahunAjaran, string $semester, string $message)
    {
        return redirect()->route('jadwal-pelajaran.show', [
            'tahun_ajaran' => $tahunAjaran,
            'semester' => $semester,
        ])->with('error', $message);
    }

    /**
     * Backtracking blok dengan urutan kelas. Ketika satu kelas selesai, lanjutkan
     * ke kelas berikutnya. Jika kelas berikutnya buntu, return false ke frame
     * sebelumnya agar pilihan slot sebelumnya dapat di-undo dan dicoba ulang.
     */
    private function backtrackBlockCSP(int $classId, int $classIndex = 0): bool
    {
        if (++$this->cspNodes > $this->cspMaxNodes) {
            return false;
        }

        $target = $this->cspClassTarget[$classId] ?? 0;
        $filled = $this->cspState['classFilled'][$classId] ?? 0;

        if ($filled === $target) {
            foreach ($this->cspClassMappings[$classId] ?? [] as $mappingKey) {
                if (($this->cspState['mappingScheduled'][$mappingKey] ?? 0)
                    !== ($this->cspMappingDemand[$mappingKey] ?? 0)) {
                    return false;
                }
            }
            if (!empty($this->getMissingDays($classId))
                || !$this->validateMaxSubjectBlock($classId)) {
                return false;
            }

            $nextIndex = $classIndex + 1;
            if (!isset($this->cspOrderedClassIds[$nextIndex])) {
                return true; // Semua kelas berhasil disusun.
            }

            return $this->backtrackBlockCSP(
                $this->cspOrderedClassIds[$nextIndex],
                $nextIndex
            );
        }

        $candidates = $this->getBlockCandidates($classId);
        if (!$candidates) {
            return false;
        }

        // Candidate scoring prefers earlier slots / morning-priority subjects,
        // while still allowing alternatives when a teacher is already busy.
        usort($candidates, fn ($a, $b) => $b['score'] <=> $a['score']);

        foreach ($candidates as $candidate) {
            $snapshot = $this->applyBlockCandidate($classId, $candidate);

            if ($this->forwardCheck($classId) && $this->backtrackBlockCSP($classId, $classIndex)) {
                return true;
            }

            $this->undoBlockCandidate($classId, $candidate, $snapshot);

            if ($this->cspNodes > $this->cspMaxNodes) {
                return false;
            }
        }

        return false;
    }

    private function getBlockCandidates(int $classId, ?string $onlyDay = null, ?string $onlyMappingKey = null): array
    {
        $remainingClass = ($this->cspClassTarget[$classId] ?? 0)
            - ($this->cspState['classFilled'][$classId] ?? 0);
        if ($remainingClass <= 0) {
            return [];
        }

        $mappingKeys = $this->cspClassMappings[$classId] ?? [];
        if ($onlyMappingKey !== null) {
            $mappingKeys = array_values(array_filter(
                $mappingKeys,
                fn ($key) => (string) $key === (string) $onlyMappingKey
            ));
        }

        $days = $onlyDay !== null
            ? [strtolower(trim($onlyDay))]
            : array_keys($this->cspDayOrder);
        $candidates = [];

        foreach ($mappingKeys as $mappingKey) {
            $demand = $this->cspMappingDemand[$mappingKey] ?? 0;
            $scheduled = $this->cspState['mappingScheduled'][$mappingKey] ?? 0;
            $remainingMapping = $demand - $scheduled;
            if ($remainingMapping <= 0) {
                continue;
            }

            // Blok utama maksimal 3 JP. Backtracking tetap dapat mencoba blok lebih kecil
            // jika blok utama tidak memungkinkan karena slot atau bentrok guru.
            $lengths = [];
            for ($length = min(3, $remainingMapping, $remainingClass); $length >= 1; $length--) {
                $lengths[] = $length;
            }

            foreach ($days as $hari) {
                $daySlots = $this->cspDaySlots[$hari] ?? [];
                if (!$daySlots) {
                    continue;
                }

                $starts = [];

                // Mode fleksibel: setiap blok tetap berurutan, tetapi mapel boleh
                // muncul lagi pada blok terpisah di hari yang sama jika diperlukan.
                // Total JP mapel per hari tetap dibatasi maksimal 3 oleh validator harian.
                foreach ($lengths as $length) {
                    for ($start = 0; $start + $length <= count($daySlots); $start++) {
                        $starts[] = [$start, $length];
                    }
                }

                foreach ($starts as [$start, $length]) {
                    $slotIds = array_slice($daySlots, $start, $length);
                    if (count($slotIds) !== $length || !$this->areSlotsContinuous($slotIds)) {
                        continue;
                    }
                    if (!$this->canPlaceBlock($classId, (string) $mappingKey, $slotIds)) {
                        continue;
                    }
                    $candidates[] = $this->makeCandidate(
                        $classId,
                        (string) $mappingKey,
                        $slotIds,
                        $length
                    );
                }
            }
        }

        $unique = [];
        foreach ($candidates as $candidate) {
            $key = $candidate['mapping_key'] . '|' . implode(',', $candidate['slot_ids']);
            $unique[$key] = $candidate;
        }

        return array_values($unique);
    }

    private function makeCandidate(int $classId, string $mappingKey, array $slotIds, int $length): array
    {
        $hari = $this->cspSlots[$slotIds[0]]['hari'];
        $dayFilled = $this->cspState['classDays'][$classId][$hari] ?? 0;
        $demand = $this->cspMappingDemand[$mappingKey] ?? 0;
        $scheduled = $this->cspState['mappingScheduled'][$mappingKey] ?? 0;
        $remaining = $demand - $scheduled;
        $existingDayLoad = $this->cspState['mappingDays'][$mappingKey][$hari] ?? 0;
        $existingIndices = $this->getMapelIndicesOnDay($classId, $mappingKey, $hari);
        $mapelAlreadyExists = !empty($existingIndices);
        $daySlotsForScore = $this->cspDaySlots[$hari] ?? [];
        $candidateIndices = [];
        foreach ($slotIds as $candidateSlotId) {
            $candidateIndex = array_search($candidateSlotId, $daySlotsForScore, true);
            if ($candidateIndex !== false) $candidateIndices[] = $candidateIndex;
        }
        $extendsExistingBlock = false;
        if ($mapelAlreadyExists && $candidateIndices) {
            $candidateFirst = min($candidateIndices);
            $candidateLast = max($candidateIndices);
            $existingFirst = min($existingIndices);
            $existingLast = max($existingIndices);
            $existingContinuous = ($existingLast - $existingFirst + 1) === count($existingIndices)
                && $this->areDayIndicesContinuous($hari, $existingFirst, $existingLast);
            $extendsExistingBlock = $existingContinuous && (
                ($candidateLast + 1 === $existingFirst && $this->areDayIndicesContinuous($hari, $candidateFirst, $existingLast))
                || ($existingLast + 1 === $candidateFirst && $this->areDayIndicesContinuous($hari, $existingFirst, $candidateLast))
            );
        }

        // Pola yang diutamakan:
        // 6 JP = 3+3; 5 JP = 3+2; 4 JP = 2+2;
        // 3 JP = 3 (alternatif 2+1); 2 JP = 2 (alternatif 1+1).
        // Panjang alternatif tetap dicoba oleh backtracking jika pilihan utama buntu.
        $preferredLength = match (true) {
            $remaining >= 5 => 3,
            $remaining === 4 => 2,
            $remaining === 3 => 3,
            $remaining === 2 => 2,
            default => 1,
        };

        $score = match ($length) {
            3 => 30000,
            2 => 22000,
            default => 5000,
        };
        if ($length === $preferredLength) {
            $score += 80000;
        }
        if ($length === $remaining) {
            $score += 12000;
        }
        if ($dayFilled === 0) {
            $score += 20000;
        }
        $score -= $dayFilled * 2000;

        // Utamakan menyambung ke blok mapel yang sudah ada. Pemisahan masih
        // diperbolehkan sebagai alternatif, tetapi skornya diturunkan.
        if ($extendsExistingBlock) {
            $score += 25000;
        } elseif ($mapelAlreadyExists) {
            $score -= 35000;
        } elseif ($existingDayLoad > 0) {
            $score -= 10000;
        }

        $info = $this->cspMappingInfo[$mappingKey] ?? [];
        $prioritasPagi = (bool) ($info['prioritas_pagi'] ?? false);
        $namaMapel = $info['nama_mapel'] ?? '';
        if (str_contains($namaMapel, 'matematika')
            || str_contains($namaMapel, 'pjok')
            || str_contains($namaMapel, 'pendidikan jasmani')) {
            $prioritasPagi = true;
        }

        if ($prioritasPagi) {
            $posisiAwal = array_search($slotIds[0], $this->cspDaySlots[$hari] ?? [], true);
            if ($posisiAwal === 0) {
                $score += 100000;
            } elseif ($posisiAwal === 1) {
                $score += 70000;
            } elseif ($posisiAwal === 2) {
                $score += 30000;
            } elseif ($posisiAwal !== false) {
                $score -= $posisiAwal * 5000;
            }
        }

        $score -= $this->cspDayOrder[$hari] ?? 99;

        return [
            'mapping_key' => $mappingKey,
            'slot_ids' => $slotIds,
            'length' => $length,
            'hari' => $hari,
            'score' => $score,
        ];
    }

    private function canPlaceBlock(int $classId, string $mappingKey, array $slotIds): bool
    {
        if (!$slotIds || count($slotIds) > 3 || !$this->areSlotsContinuous($slotIds)) {
            return false;
        }

        $info = $this->cspMappingInfo[$mappingKey] ?? null;
        if (!$info) {
            return false;
        }

        $guruId = $info['guru_id'];
        $hari = $this->cspSlots[$slotIds[0]]['hari'] ?? null;
        if ($hari === null) {
            return false;
        }

        foreach ($slotIds as $slotId) {
            if (!isset($this->cspSlots[$slotId]) || $this->cspSlots[$slotId]['hari'] !== $hari) {
                return false;
            }
            if (isset($this->cspState['classAssignments'][$classId][$slotId])) {
                return false;
            }
            if (isset($this->cspState['teacherBusy'][$guruId][$slotId])) {
                return false;
            }
        }

        $demand = $this->cspMappingDemand[$mappingKey] ?? 0;
        $scheduled = $this->cspState['mappingScheduled'][$mappingKey] ?? 0;
        if (count($slotIds) > $demand - $scheduled) {
            return false;
        }

        return $this->isValidDailyMappingLoad($mappingKey, $slotIds);
    }

    private function isValidSubjectBlock(int $classId, string $mappingKey, array $blockSlotIds): bool
    {
        if (!$blockSlotIds || !$this->areSlotsContinuous($blockSlotIds)) {
            return false;
        }

        $hari = $this->cspSlots[$blockSlotIds[0]]['hari'] ?? null;
        $targetMapelId = $this->cspMappingInfo[$mappingKey]['mapel_id'] ?? null;
        if ($hari === null || $targetMapelId === null) {
            return false;
        }

        $candidateLookup = array_fill_keys($blockSlotIds, true);
        $lastMapel = null;
        $lastSlotId = null;
        $finished = [];

        foreach ($this->cspDaySlots[$hari] ?? [] as $slotId) {
            // Perbedaan waktu menandakan jeda/istirahat. Mapel tidak boleh berlanjut
            // melewati jeda seolah-olah masih satu blok.
            if ($lastSlotId !== null && !$this->areAdjacentSlotsContinuous($lastSlotId, $slotId)) {
                if ($lastMapel !== null) {
                    $finished[$lastMapel] = true;
                }
                $lastMapel = null;
            }

            $currentMapel = null;
            if (isset($candidateLookup[$slotId])) {
                $currentMapel = $targetMapelId;
            } else {
                $existingKey = $this->cspState['classAssignments'][$classId][$slotId] ?? null;
                if ($existingKey !== null) {
                    $currentMapel = $this->cspMappingInfo[$existingKey]['mapel_id'] ?? null;
                }
            }

            if ($currentMapel === null) {
                if ($lastMapel !== null) {
                    $finished[$lastMapel] = true;
                    $lastMapel = null;
                }
                $lastSlotId = $slotId;
                continue;
            }

            if ($currentMapel === $lastMapel) {
                $lastSlotId = $slotId;
                continue;
            }

            if ($lastMapel !== null) {
                $finished[$lastMapel] = true;
            }
            if (isset($finished[$currentMapel])) {
                return false;
            }

            $lastMapel = $currentMapel;
            $lastSlotId = $slotId;
        }

        return true;
    }

    private function getMapelIndicesOnDay(int $classId, string $mappingKey, string $hari): array
    {
        $targetMapelId = $this->cspMappingInfo[$mappingKey]['mapel_id'] ?? null;
        if ($targetMapelId === null) {
            return [];
        }
        $indices = [];
        foreach ($this->cspDaySlots[$hari] ?? [] as $index => $slotId) {
            $existingKey = $this->cspState['classAssignments'][$classId][$slotId] ?? null;
            if ($existingKey === null) {
                continue;
            }
            $existingMapelId = $this->cspMappingInfo[$existingKey]['mapel_id'] ?? null;
            if ($existingMapelId === $targetMapelId) {
                $indices[] = $index;
            }
        }
        return $indices;
    }

    private function isValidDailyMappingLoad(string $mappingKey, array $slotIds): bool
    {
        if (!$slotIds || !$this->areSlotsContinuous($slotIds)) {
            return false;
        }

        $hari = $this->cspSlots[$slotIds[0]]['hari'];
        $existing = $this->cspState['mappingDays'][$mappingKey][$hari] ?? 0;

        // Satu mapel maksimal 3 JP per hari dan hanya dalam satu blok kontinu.
        return $existing + count($slotIds) <= 3;
    }

    private function applyBlockCandidate(int $classId, array $candidate): array
    {
        $mappingKey = $candidate['mapping_key'];
        $guruId = $this->cspMappingInfo[$mappingKey]['guru_id'];
        $slotIds = $candidate['slot_ids'];
        $snapshot = [
            'classDays' => $this->cspState['classDays'][$classId] ?? [],
            'mappingDays' => $this->cspState['mappingDays'][$mappingKey] ?? [],
        ];

        foreach ($slotIds as $slotId) {
            $hari = $this->cspSlots[$slotId]['hari'];
            $this->cspState['classAssignments'][$classId][$slotId] = $mappingKey;
            $this->cspState['teacherBusy'][$guruId][$slotId] = true;
            $this->cspState['classDays'][$classId][$hari] = ($this->cspState['classDays'][$classId][$hari] ?? 0) + 1;
            $this->cspState['mappingDays'][$mappingKey][$hari] = ($this->cspState['mappingDays'][$mappingKey][$hari] ?? 0) + 1;
        }

        $count = count($slotIds);
        $this->cspState['mappingScheduled'][$mappingKey] += $count;
        $this->cspState['teacherScheduled'][$guruId] += $count;
        $this->cspState['classFilled'][$classId] += $count;
        return $snapshot;
    }

    private function undoBlockCandidate(int $classId, array $candidate, array $snapshot): void
    {
        $mappingKey = $candidate['mapping_key'];
        $guruId = $this->cspMappingInfo[$mappingKey]['guru_id'];
        $slotIds = $candidate['slot_ids'];
        foreach ($slotIds as $slotId) {
            unset($this->cspState['classAssignments'][$classId][$slotId], $this->cspState['teacherBusy'][$guruId][$slotId]);
        }
        $count = count($slotIds);
        $this->cspState['mappingScheduled'][$mappingKey] -= $count;
        $this->cspState['teacherScheduled'][$guruId] -= $count;
        $this->cspState['classFilled'][$classId] -= $count;
        $this->cspState['classDays'][$classId] = $snapshot['classDays'];
        $this->cspState['mappingDays'][$mappingKey] = $snapshot['mappingDays'];
    }

    private function forwardCheck(int $activeClassId): bool
    {
        // Periksa kelayakan kelas yang sedang diisi. Kelas sebelumnya tetap
        // terpasang pada cabang pencarian saat ini, tetapi bisa diubah ketika
        // backtracking mengembalikan proses ke frame kelas sebelumnya.
        $classIdsToCheck = [$activeClassId];
        foreach ($classIdsToCheck as $classId) {
            $target = $this->cspClassTarget[$classId] ?? 0;
            $filled = $this->cspState['classFilled'][$classId] ?? 0;
            $remaining = $target - $filled;
            $missingDays = $this->getMissingDays((int) $classId);
            if ($remaining < count($missingDays)) {
                return false;
            }
            if ($remaining === 0) {
                if ($missingDays) return false;
                continue;
            }

            $freeClassSlots = 0;
            foreach ($this->cspSlots as $slotId => $_slot) {
                if (!isset($this->cspState['classAssignments'][$classId][$slotId])) {
                    $freeClassSlots++;
                }
            }
            if ($freeClassSlots < $remaining) {
                return false;
            }
            foreach ($missingDays as $hari) {
                $hasFreeSlot = false;
                foreach ($this->cspDaySlots[$hari] ?? [] as $slotId) {
                    if (!isset($this->cspState['classAssignments'][$classId][$slotId])) {
                        $hasFreeSlot = true;
                        break;
                    }
                }
                if (!$hasFreeSlot) return false;
            }

            foreach ($this->cspClassMappings[$classId] ?? [] as $mappingKey) {
                $demand = $this->cspMappingDemand[$mappingKey] ?? 0;
                $scheduled = $this->cspState['mappingScheduled'][$mappingKey] ?? 0;
                $remainingMapping = $demand - $scheduled;
                if ($remainingMapping < 0 || $remainingMapping > $freeClassSlots) {
                    return false;
                }
                // Forward checking untuk mapping yang hampir selesai. Jika sisa
                // 1-3 JP, harus masih ada setidaknya satu blok legal; cek lebih
                // awal menghindari pencarian panjang yang akhirnya pasti buntu.
                if (
                    $remainingMapping > 0
                    && $remainingMapping <= 3
                    && !$this->hasAnyCandidate((int) $classId, (string) $mappingKey)
                ) {
                    return false;
                }
            }
        }

        foreach ($this->cspTotalTeacherDemand as $guruId => $demand) {
            $scheduled = $this->cspState['teacherScheduled'][$guruId] ?? 0;
            $remaining = $demand - $scheduled;
            if ($remaining <= 0) continue;
            $freeTeacherSlots = 0;
            foreach ($this->cspSlots as $slotId => $_slot) {
                if (!isset($this->cspState['teacherBusy'][$guruId][$slotId])) {
                    $freeTeacherSlots++;
                }
            }
            if ($freeTeacherSlots < $remaining) return false;
        }
        return true;
    }

    /** Cek cepat: apakah mapping masih punya setidaknya satu blok legal. */
    private function hasAnyCandidate(int $classId, string $mappingKey): bool
    {
        $remainingClass = ($this->cspClassTarget[$classId] ?? 0)
            - ($this->cspState['classFilled'][$classId] ?? 0);
        $remainingMapping = ($this->cspMappingDemand[$mappingKey] ?? 0)
            - ($this->cspState['mappingScheduled'][$mappingKey] ?? 0);

        if ($remainingClass <= 0 || $remainingMapping <= 0) {
            return $remainingMapping <= 0;
        }

        $lengths = [];
        for ($length = min(3, $remainingClass, $remainingMapping); $length >= 1; $length--) {
            $lengths[] = $length;
        }

        $guruId = $this->cspMappingInfo[$mappingKey]['guru_id'] ?? null;
        foreach ($this->cspDaySlots as $hari => $daySlots) {
            $indices = $this->getMapelIndicesOnDay($classId, $mappingKey, $hari);
            $starts = [];

            if ($indices) {
                $first = min($indices);
                $last = max($indices);
                if (($last - $first + 1) !== count($indices)
                    || !$this->areDayIndicesContinuous($hari, $first, $last)) {
                    continue;
                }

                foreach ($lengths as $length) {
                    if ($first - $length >= 0) {
                        $starts[] = [$first - $length, $length];
                    }
                    if ($last + 1 + $length <= count($daySlots)) {
                        $starts[] = [$last + 1, $length];
                    }
                }
            } else {
                foreach ($lengths as $length) {
                    for ($start = 0; $start + $length <= count($daySlots); $start++) {
                        $starts[] = [$start, $length];
                    }
                }
            }

            foreach ($starts as [$start, $length]) {
                $slotIds = array_slice($daySlots, $start, $length);
                if (count($slotIds) !== $length || !$this->areSlotsContinuous($slotIds)) {
                    continue;
                }

                $legal = true;
                foreach ($slotIds as $slotId) {
                    if (isset($this->cspState['classAssignments'][$classId][$slotId])
                        || isset($this->cspState['teacherBusy'][$guruId][$slotId])) {
                        $legal = false;
                        break;
                    }
                }
                if (!$legal) {
                    continue;
                }
                if (($this->cspState['mappingDays'][$mappingKey][$hari] ?? 0) + $length > 3) {
                    continue;
                }
                return true;
            }
        }

        return false;
    }

    /** True jika dua slot JP berurutan tanpa jeda/istirahat di antaranya. */
    private function areAdjacentSlotsContinuous(int $previousSlotId, int $nextSlotId): bool
    {
        $previous = $this->cspSlots[$previousSlotId] ?? null;
        $next = $this->cspSlots[$nextSlotId] ?? null;
        if (!$previous || !$next || $previous['hari'] !== $next['hari']) {
            return false;
        }

        return substr((string) $previous['jam_selesai'], 0, 8)
            === substr((string) $next['jam_mulai'], 0, 8);
    }

    /** True jika seluruh slot dalam kandidat tersambung tanpa melewati istirahat. */
    private function areSlotsContinuous(array $slotIds): bool
    {
        if (count($slotIds) <= 1) {
            return !empty($slotIds) && isset($this->cspSlots[$slotIds[0]]);
        }

        for ($i = 1; $i < count($slotIds); $i++) {
            if (!$this->areAdjacentSlotsContinuous((int) $slotIds[$i - 1], (int) $slotIds[$i])) {
                return false;
            }
        }

        return true;
    }

    /** Memeriksa kesinambungan slot dari indeks awal sampai indeks akhir dalam satu hari. */
    private function areDayIndicesContinuous(string $hari, int $first, int $last): bool
    {
        $daySlots = $this->cspDaySlots[$hari] ?? [];
        if ($first < 0 || $last >= count($daySlots) || $first > $last) {
            return false;
        }

        for ($i = $first + 1; $i <= $last; $i++) {
            if (!$this->areAdjacentSlotsContinuous($daySlots[$i - 1], $daySlots[$i])) {
                return false;
            }
        }

        return true;
    }

    private function getMissingDays(int $classId): array
    {
        $missing = [];
        foreach (array_keys($this->cspDayOrder) as $hari) {
            if (($this->cspState['classDays'][$classId][$hari] ?? 0) <= 0) $missing[] = $hari;
        }
        return $missing;
    }

    private function validateFinalSchedule(): bool
    {
        foreach ($this->cspClassTarget as $classId => $target) {
            if (($this->cspState['classFilled'][$classId] ?? 0) !== $target) return false;
            if ($this->getMissingDays((int) $classId)) return false;
            if (count($this->cspState['classAssignments'][$classId] ?? []) !== $target) return false;
        }
        foreach ($this->cspMappingDemand as $key => $demand) {
            if (($this->cspState['mappingScheduled'][$key] ?? 0) !== $demand) return false;
        }
        foreach ($this->cspTotalTeacherDemand as $guruId => $demand) {
            if (($this->cspState['teacherScheduled'][$guruId] ?? 0) !== $demand) return false;
        }
        foreach ($this->cspClassTarget as $classId => $_target) {
            if (!$this->validateMaxSubjectBlock((int) $classId)) return false;
        }
        foreach ($this->cspMappingDemand as $mappingKey => $_demand) {
            foreach ($this->cspDayOrder as $hari => $_order) {
                if (($this->cspState['mappingDays'][$mappingKey][$hari] ?? 0) > 3) {
                    return false;
                }
            }
        }
        return $this->validateTeacherConflicts();
    }

    private function validateTeacherConflicts(): bool
    {
        $used = [];
        foreach ($this->cspState['classAssignments'] as $classId => $assignments) {
            foreach ($assignments as $slotId => $mappingKey) {
                $guruId = $this->cspMappingInfo[$mappingKey]['guru_id'] ?? null;
                if ($guruId === null || isset($used[$guruId][$slotId])) return false;
                $used[$guruId][$slotId] = true;
            }
        }
        return true;
    }

    private function validateNoSubjectSplit(int $classId): bool
    {
        foreach ($this->cspDaySlots as $hari => $slotIds) {
            $lastMapel = null;
            $lastSlotId = null;
            $finished = [];

            foreach ($slotIds as $slotId) {
                if ($lastSlotId !== null && !$this->areAdjacentSlotsContinuous($lastSlotId, $slotId)) {
                    if ($lastMapel !== null) {
                        $finished[$lastMapel] = true;
                    }
                    $lastMapel = null;
                }

                $mappingKey = $this->cspState['classAssignments'][$classId][$slotId] ?? null;
                if ($mappingKey === null) {
                    if ($lastMapel !== null) {
                        $finished[$lastMapel] = true;
                    }
                    $lastMapel = null;
                    $lastSlotId = $slotId;
                    continue;
                }

                $mapelId = $this->cspMappingInfo[$mappingKey]['mapel_id'] ?? null;
                if ($mapelId === null) {
                    return false;
                }
                if ($mapelId === $lastMapel) {
                    $lastSlotId = $slotId;
                    continue;
                }
                if ($lastMapel !== null) {
                    $finished[$lastMapel] = true;
                }
                if (isset($finished[$mapelId])) {
                    return false;
                }

                $lastMapel = $mapelId;
                $lastSlotId = $slotId;
            }
        }

        return true;
    }

    private function validateMaxSubjectBlock(int $classId): bool
    {
        foreach ($this->cspDaySlots as $slotIds) {
            $lastMapel = null;
            $lastSlotId = null;
            $length = 0;

            foreach ($slotIds as $slotId) {
                if ($lastSlotId !== null && !$this->areAdjacentSlotsContinuous($lastSlotId, $slotId)) {
                    $lastMapel = null;
                    $length = 0;
                }

                $mappingKey = $this->cspState['classAssignments'][$classId][$slotId] ?? null;
                if ($mappingKey === null) {
                    $lastMapel = null;
                    $lastSlotId = $slotId;
                    $length = 0;
                    continue;
                }

                $mapelId = $this->cspMappingInfo[$mappingKey]['mapel_id'] ?? null;
                if ($mapelId === null) {
                    return false;
                }

                if ($mapelId === $lastMapel) {
                    $length++;
                } else {
                    $lastMapel = $mapelId;
                    $length = 1;
                }

                if ($length > 3) {
                    return false;
                }
                $lastSlotId = $slotId;
            }
        }

        return true;
    }
}
