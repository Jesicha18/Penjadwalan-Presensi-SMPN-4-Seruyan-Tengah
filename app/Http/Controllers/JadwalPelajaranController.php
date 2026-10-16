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
    /** Data solver dibangun ulang setiap generate; tidak bergantung pada ID kelas/hari tertentu. */
    private array $slots = [];
    private array $daySlots = [];
    private array $days = [];
    private array $mappings = [];
    private array $mappingInfo = [];
    private array $classMappings = [];
    private array $mappingDemand = [];
    private array $classDemand = [];
    private array $classSlotIds = [];
    private array $teacherDemand = [];
    private array $state = [];
    private int $nodes = 0;
    private int $maxNodes = 1000000;
    private float $deadline = 0;
    private bool $searchLimitReached = false;

    private array $defaultDayOrder = [
        'senin' => 1, 'selasa' => 2, 'rabu' => 3,
        'kamis' => 4, 'jumat' => 5, 'sabtu' => 6,
        'minggu' => 7,
    ];

    public function index(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => ['nullable', 'regex:/^\d{4}\/\d{4}$/', function ($attribute, $value, $fail) {
                if ($value) {
                    [$start, $end] = explode('/', $value);
                    if ((int) $end !== (int) $start + 1) $fail('Tahun ajaran harus berurutan, contoh 2026/2027.');
                }
            }],
            'semester' => ['nullable', 'in:Ganjil,Genap'],
        ]);

        $years = JadwalPelajaran::whereNotNull('tahun_ajaran')->distinct()->orderByDesc('tahun_ajaran')->pluck('tahun_ajaran')->all();
        if (!$years) $years = [date('Y') . '/' . (date('Y') + 1)];
        $year = $request->input('tahun_ajaran', session('tahun_ajaran_aktif', $years[0]));
        $semester = $request->input('semester', session('semester_aktif', 'Ganjil'));
        session(['tahun_ajaran_aktif' => $year, 'semester_aktif' => $semester]);

        $totalKelas = Kelas::count();
        $totalGuru = Guru::count();
        $totalMapel = MataPelajaran::count();
        $totalMapping = MappingPengampu::count();
        $totalSlot = SlotWaktu::count();

        // Nama variabel ini dipertahankan agar kompatibel dengan view jadwal.index yang sudah ada.
        $tahunAjaran = $year;
        $listTahunAjaran = $years;
        return view('jadwal.index', compact('tahunAjaran', 'semester', 'listTahunAjaran', 'totalKelas', 'totalGuru', 'totalMapel', 'totalMapping', 'totalSlot'));
    }

    public function show(Request $request)
    {
        $years = JadwalPelajaran::whereNotNull('tahun_ajaran')->distinct()->orderByDesc('tahun_ajaran')->pluck('tahun_ajaran')->all();
        if (!$years) $years = [date('Y') . '/' . (date('Y') + 1)];
        $year = $request->input('tahun_ajaran', session('tahun_ajaran_aktif', $years[0]));
        $semester = $request->input('semester', session('semester_aktif', 'Ganjil'));
        session(['tahun_ajaran_aktif' => $year, 'semester_aktif' => $semester]);

        $kelasList = Kelas::where('is_active', 1)->orderBy('nama_kelas')->get();
$urutanHari = [
    'senin'  => 1,
    'selasa' => 2,
    'rabu'   => 3,
    'kamis'  => 4,
    'jumat'  => 5,
    'sabtu'  => 6,
];

$slotWaktuList = SlotWaktu::get()
    ->sortBy(function ($slot) use ($urutanHari) {
        $hari = strtolower(trim((string) $slot->hari));

        return sprintf(
            '%02d-%08d-%s',
            $urutanHari[$hari] ?? 99,
            (int) $slot->urutan,
            (string) $slot->jam_mulai
        );
    })
    ->values();        $jadwalList = JadwalPelajaran::with(['mataPelajaran', 'guru', 'kelas', 'slotWaktu'])
            ->where('tahun_ajaran', $year)->where('semester', $semester)->get();

        $matriksJadwal = [];
        foreach ($jadwalList as $jadwal) {
            $slot = $jadwal->slotWaktu;
            $day = strtolower(trim((string) ($slot->hari ?? $jadwal->hari ?? '')));
            $start = substr(trim((string) ($slot->jam_mulai ?? $jadwal->jam_mulai ?? '')), 0, 5);
            $classId = $jadwal->kelas_id;
            $cell = [
                'id_jadwal' => $jadwal->id,
                'slot_waktu_id' => $jadwal->slot_waktu_id,
                'mapel' => $jadwal->mataPelajaran->nama_mapel ?? '-',
                'guru' => $jadwal->guru->nama ?? '-',
            ];         
            $matriksJadwal[$day][$start][$classId] = $cell;
            if ($jadwal->slot_waktu_id) $matriksJadwal['by_slot'][$jadwal->slot_waktu_id][$classId] = $cell;
        }

        // Pertahankan nama variabel yang biasa dipakai view lama.
        $tahunAjaran = $year;
        $listTahunAjaran = $years;
        return view('jadwal-pelajaran.show', compact('slotWaktuList', 'kelasList', 'matriksJadwal', 'tahunAjaran', 'semester', 'listTahunAjaran'));
    }

    public function setFilter(Request $request)
    {
        $data = $request->validate([
            'tahun_ajaran' => ['required', 'regex:/^\d{4}\/\d{4}$/', function ($attribute, $value, $fail) {
                [$start, $end] = explode('/', $value);
                if ((int) $end !== (int) $start + 1) $fail('Tahun ajaran harus berurutan.');
            }],
            'semester' => ['required', 'in:Ganjil,Genap'],
        ]);
        session(['tahun_ajaran_aktif' => $data['tahun_ajaran'], 'semester_aktif' => $data['semester']]);
        return redirect()->route('jadwal-pelajaran.show', $data);
    }

    public function generate(Request $request)
    {
        $year = $request->input('tahun_ajaran', session('tahun_ajaran_aktif')) ?: (date('Y') . '/' . (date('Y') + 1));
        $semester = $request->input('semester', session('semester_aktif', 'Ganjil'));
        $validator = Validator::make(['tahun_ajaran' => $year, 'semester' => $semester], [
            'tahun_ajaran' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
            'semester' => ['required', 'in:Ganjil,Genap'],
        ]);
        if ($validator->fails()) return $this->generateError((string) $year, (string) $semester, $validator->errors()->first());
        [$yearStart, $yearEnd] = explode('/', $year);
        if ((int) $yearEnd !== (int) $yearStart + 1) return $this->generateError($year, $semester, 'Tahun ajaran harus berurutan, contoh 2026/2027.');
        session(['tahun_ajaran_aktif' => $year, 'semester_aktif' => $semester]);

        @set_time_limit(300);
        $this->resetSolver();
        $this->deadline = microtime(true) + 240;

        $classes = Kelas::where('is_active', 1)->orderBy('nama_kelas')->get();
        if ($classes->isEmpty()) return $this->generateError($year, $semester, 'Tidak ada kelas aktif.');

        // Slot diambil dinamis dari database. Semua slot dengan jenis jp dapat digunakan.
        $allSlots = SlotWaktu::where('jenis', 'jp')->get();
        if ($allSlots->isEmpty()) return $this->generateError($year, $semester, 'Tidak ada slot berjenis JP pada tabel slot_waktus.');
        $slotRows = $allSlots->sortBy(function ($slot) {
            $day = strtolower(trim((string) $slot->hari));
            $dayOrder = $this->defaultDayOrder[$day] ?? 99;
            return sprintf('%02d-%08d-%s', $dayOrder, (int) $slot->urutan, (string) $slot->jam_mulai);
        })->values();

        foreach ($slotRows as $slot) {
            $id = (int) $slot->getKey();
            $day = strtolower(trim((string) $slot->hari));
            if ($day === '') return $this->generateError($year, $semester, "Slot ID {$id} belum memiliki hari.");
            $this->slots[$id] = [
                'id' => $id, 'hari' => $day, 'hari_asli' => trim((string) $slot->hari),
                'urutan' => (int) $slot->urutan,
                'jam_mulai' => (string) $slot->jam_mulai,
                'jam_selesai' => (string) $slot->jam_selesai,
            ];
            $this->daySlots[$day][] = $id;
        }
        foreach ($this->daySlots as $day => &$ids) {
            usort($ids, fn ($a, $b) => ($this->slots[$a]['urutan'] <=> $this->slots[$b]['urutan']) ?: strcmp($this->slots[$a]['jam_mulai'], $this->slots[$b]['jam_mulai']));
            $this->days[] = $day;
        }
        unset($ids);
        usort($this->days, fn ($a, $b) => (($this->defaultDayOrder[$a] ?? 99) <=> ($this->defaultDayOrder[$b] ?? 99)) ?: strcmp($a, $b));

        $slotCount = count($this->slots);
        $activeClassIds = $classes->pluck('id_kelas')->map(fn ($id) => (int) $id)->all();
        $mappingRows = MappingPengampu::with(['mataPelajaran', 'guru', 'kelas'])
            ->where('jumlah_jp', '>', 0)->get()
            ->filter(fn ($mapping) => in_array((int) $mapping->kelas_id, $activeClassIds, true))
            ->values();
        if ($mappingRows->isEmpty()) return $this->generateError($year, $semester, 'Data mapping pengampu belum tersedia untuk kelas aktif.');

        foreach ($mappingRows as $mapping) {
            $key = (string) $mapping->getKey();
            $classId = (int) $mapping->kelas_id;
            $teacherId = (int) $mapping->guru_id;
            $subjectId = (int) $mapping->mata_pelajaran_id;
            $demand = (int) $mapping->jumlah_jp;
            if ($classId <= 0 || $teacherId <= 0 || $subjectId <= 0 || $demand <= 0) {
                return $this->generateError($year, $semester, "Mapping {$key} memiliki kelas/guru/mapel atau jumlah JP yang tidak valid.");
            }
            if (!$mapping->guru || !$mapping->mataPelajaran || !$mapping->kelas) {
                return $this->generateError($year, $semester, "Mapping {$key} memiliki relasi guru, kelas, atau mata pelajaran yang tidak valid.");
            }
            $subjectName = mb_strtolower(trim((string) ($mapping->mataPelajaran->nama_mapel ?? '')));
            $priority = (bool) ($mapping->mataPelajaran->prioritas_jam_pagi ?? false)
                || str_contains($subjectName, 'matematika')
                || str_contains($subjectName, 'pjok')
                || str_contains($subjectName, 'pendidikan jasmani');

            $this->mappings[$key] = $mapping;
            $this->mappingInfo[$key] = [
                'class_id' => $classId, 'guru_id' => $teacherId, 'mapel_id' => $subjectId,
                'nama_mapel' => $subjectName, 'priority_morning' => $priority,
            ];
            $this->mappingDemand[$key] = $demand;
            $this->classMappings[$classId][] = $key;
            $this->classDemand[$classId] = ($this->classDemand[$classId] ?? 0) + $demand;
            $this->teacherDemand[$teacherId] = ($this->teacherDemand[$teacherId] ?? 0) + $demand;
        }

        // PJOK dan Agama wajib masing-masing dijadwalkan sebagai satu blok 3 JP per kelas.
        $requiredTypes = ['pjok' => 'PJOK', 'agama' => 'Agama'];
        foreach ($classes as $class) {
            $classId = (int) $class->id_kelas;

            foreach ($requiredTypes as $type => $label) {
                $requiredKeys = [];
                $totalDemand = 0;

                foreach ($this->classMappings[$classId] ?? [] as $key) {
                    if ($this->requiredBlockType((string) $key) !== $type) continue;
                    $requiredKeys[] = (string) $key;
                    $totalDemand += (int) ($this->mappingDemand[$key] ?? 0);
                }

                if ($totalDemand !== 3) {
                    return $this->generateError(
                        $year,
                        $semester,
                        "Mapping {$label} kelas {$class->nama_kelas} harus berjumlah tepat 3 JP per minggu. Saat ini: {$totalDemand} JP."
                    );
                }

                if (count($requiredKeys) !== 1 || (int) ($this->mappingDemand[$requiredKeys[0]] ?? 0) !== 3) {
                    return $this->generateError(
                        $year,
                        $semester,
                        "Gabungkan mapping {$label} kelas {$class->nama_kelas} menjadi satu mapping dengan jumlah_jp = 3 agar dapat dijadwalkan dalam satu blok."
                    );
                }
            }
        }

        foreach ($classes as $class) {
            $id = (int) $class->id_kelas;
            $demand = $this->classDemand[$id] ?? 0;

            if ($demand <= 0 || $demand > $slotCount) {
                return $this->generateError(
                    $year,
                    $semester,
                    "Kelas {$class->nama_kelas} membutuhkan {$demand} JP, sedangkan slot JP tersedia {$slotCount}. Periksa mapping dan slot JP."
                );
            }

            if ($demand < count($this->days)) {
                return $this->generateError(
                    $year,
                    $semester,
                    "Kelas {$class->nama_kelas} membutuhkan {$demand} JP, terlalu sedikit untuk dijadwalkan pada semua hari belajar."
                );
            }

            // Pilih tepat sebanyak kebutuhan JP, dengan minimal satu slot per hari.
            $this->classSlotIds[$id] = $this->selectClassSlots($demand);
        }
// Inisialisasi kebutuhan dan status slot guru untuk mencegah bentrok lintas kelas.

        // Inisialisasi state yang dapat di-undo secara deterministik.
        foreach ($classes as $class) {
            $id = (int) $class->id_kelas;
            $this->state['classAssignments'][$id] = [];
            $this->state['classFilled'][$id] = 0;
            $this->state['classDays'][$id] = [];
        }
        foreach ($this->mappingDemand as $key => $_) {
            $this->state['mappingScheduled'][$key] = 0;
            $this->state['mappingDays'][$key] = [];
        }
        foreach ($this->teacherDemand as $teacherId => $_) {
            $this->state['teacherBusy'][$teacherId] = [];
            $this->state['teacherScheduled'][$teacherId] = 0;
        }

        // Quick infeasibility checks: every class needs at least one JP on each day with JP slots.
        foreach ($classes as $class) {
            $classId = (int) $class->id_kelas;
            if ($slotCount < count($this->days)) {
                return $this->generateError($year, $semester, 'Jumlah slot JP lebih sedikit daripada jumlah hari belajar yang memiliki slot. Setiap kelas tidak mungkin terisi pada semua hari tersebut.');
            }
            foreach ($this->classMappings[$classId] ?? [] as $key) {
                if ($this->mappingDemand[$key] > $slotCount) {
                    return $this->generateError($year, $semester, "JP mapping {$key} melebihi kapasitas slot mingguan.");
                }
            }
        }

        $success = $this->solveWithRestarts();
        if (!$success) {
            $message = $this->searchLimitReached
                ? 'Pencarian backtracking mencapai batas sebelum menemukan susunan yang memenuhi constraint.'
                : 'Tidak ditemukan jadwal yang memenuhi seluruh constraint pada konfigurasi saat ini.';
            return $this->generateError($year, $semester, $message . " Node diperiksa: {$this->nodes}. Jadwal lama tidak dihapus. Periksa total JP, slot JP, serta aturan maksimal 3 JP mapel per hari dan 3 JP berurutan.");
        }

        if (!$this->validateFinalSchedule()) {
            return $this->generateError($year, $semester, 'Jadwal hasil solver gagal validasi akhir. Jadwal lama tetap dipertahankan.');
        }

        try {
            DB::transaction(function () use ($year, $semester) {
                $insert = [];
                foreach ($this->state['classAssignments'] as $classId => $assignments) {
                    foreach ($assignments as $slotId => $mappingKey) {
                        $mapping = $this->mappings[$mappingKey] ?? null;
                        $slot = $this->slots[$slotId] ?? null;
                        if (!$mapping || !$slot) throw new \RuntimeException("Mapping/slot tidak ditemukan untuk slot {$slotId}.");
                        $insert[] = [
                            'mata_pelajaran_id' => (int) $mapping->mata_pelajaran_id,
                            'guru_id' => (int) $mapping->guru_id,
                            'kelas_id' => (int) $classId,
                            'slot_waktu_id' => (int) $slotId,
                            'hari' => $slot['hari_asli'],
                            'jam_mulai' => $slot['jam_mulai'],
                            'jam_selesai' => $slot['jam_selesai'],
                            'tahun_ajaran' => $year, 'semester' => $semester,
                            'created_at' => now(), 'updated_at' => now(),
                        ];
                    }
                }
                JadwalPelajaran::where('tahun_ajaran', $year)->where('semester', $semester)->delete();
                foreach (array_chunk($insert, 500) as $chunk) JadwalPelajaran::insert($chunk);
            });
        } catch (Throwable $e) {
            report($e);
            return $this->generateError($year, $semester, 'Gagal menyimpan jadwal. Jadwal sebelumnya dipertahankan jika transaksi database gagal. Periksa storage/logs/laravel.log.');
        }

        $total = array_sum($this->state['classFilled']);
        return redirect()->route('jadwal-pelajaran.show', ['tahun_ajaran' => $year, 'semester' => $semester])
            ->with('success', "Generate berhasil: {$total} JP terjadwal. Node pencarian: {$this->nodes}.");
    }

    private function resetSolver(): void
    {
        $this->slots = $this->daySlots = $this->days = $this->mappings = $this->mappingInfo = [];
        $this->classMappings = $this->mappingDemand = $this->classDemand = $this->classSlotIds = $this->teacherDemand = $this->state = [];
        $this->nodes = 0;
        $this->searchLimitReached = false;
    }

    private function generateError(string $year, string $semester, string $message)
    {
        return redirect()->route('jadwal-pelajaran.show', ['tahun_ajaran' => $year, 'semester' => $semester])->with('error', $message);
    }

    /** Metode sequential lama dipertahankan untuk referensi; generate memakai solveWithRestarts(). */
    private function solveSequential(): bool
    {
        foreach ($this->classSlotIds as $classId => $slotIds) {
            $keys = $this->classMappings[$classId] ?? [];

            // Dahulukan mapel prioritas pagi, lalu mapping dengan kebutuhan JP lebih besar.
            usort($keys, function ($a, $b) {
                $pa = !empty($this->mappingInfo[$a]['priority_morning']) ? 1 : 0;
                $pb = !empty($this->mappingInfo[$b]['priority_morning']) ? 1 : 0;
                if ($pa !== $pb) return $pb <=> $pa;
                return ($this->mappingDemand[$b] ?? 0) <=> ($this->mappingDemand[$a] ?? 0);
            });

            foreach ($keys as $key) {
                $needed = (int) ($this->mappingDemand[$key] ?? 0);
                for ($n = 0; $n < $needed; $n++) {
                    $candidates = [];
                    foreach ($slotIds as $slotId) {
                        if (isset($this->state['classAssignments'][$classId][$slotId])) continue;
                        $teacherId = (int) $this->mappingInfo[$key]['guru_id'];
                        // Constraint wajib: satu guru tidak boleh mengajar di dua kelas pada slot yang sama.
                        if (isset($this->state['teacherBusy'][$teacherId][$slotId])) continue;
                        if ($this->wouldExceedSubjectBlock((int) $classId, (string) $key, (int) $slotId)) continue;

                        $day = $this->slots[$slotId]['hari'];
                        $mapelId = (int) $this->mappingInfo[$key]['mapel_id'];
                        $sameSubjectToday = 0;
                        foreach ($this->daySlots[$day] ?? [] as $daySlotId) {
                            $existingKey = $this->state['classAssignments'][$classId][$daySlotId] ?? null;
                            if ($existingKey !== null && (int) ($this->mappingInfo[$existingKey]['mapel_id'] ?? 0) === $mapelId) {
                                $sameSubjectToday++;
                            }
                        }
                        if ($sameSubjectToday >= 3) continue;

                        $dayLoad = (int) ($this->state['classDays'][$classId][$day] ?? 0);
                        $daySubjectLoad = $sameSubjectToday;
                        $dayOrder = $this->defaultDayOrder[$day] ?? 99;
                        $position = array_search($slotId, $this->daySlots[$day] ?? [], true);
                        $priority = !empty($this->mappingInfo[$key]['priority_morning']);

                        // Nilai lebih kecil dipilih lebih dahulu: sebar mapel ant hari,
                        // seimbangkan beban harian, dan dahulukan pagi untuk Matematika/PJOK.
                        $score = ($daySubjectLoad * 10000) + ($dayLoad * 100)
                            + ($priority ? ((int) ($position === false ? 99 : $position) * 10) : (int) $position)
                            + $dayOrder / 100;
                        $candidates[] = ['slot_id' => (int) $slotId, 'score' => $score, 'day' => $day];
                    }

                    if (!$candidates) {
                        return false;
                    }
                    usort($candidates, fn ($a, $b) => $a['score'] <=> $b['score']);
                    $chosen = $candidates[0];
                    $slotId = $chosen['slot_id'];
                    $day = $chosen['day'];

                    $this->state['classAssignments'][$classId][$slotId] = (string) $key;
                    $this->state['classFilled'][$classId] = ($this->state['classFilled'][$classId] ?? 0) + 1;
                    $this->state['classDays'][$classId][$day] = ($this->state['classDays'][$classId][$day] ?? 0) + 1;
                    $this->state['mappingScheduled'][$key] = ($this->state['mappingScheduled'][$key] ?? 0) + 1;
                    $this->state['mappingDays'][$key][$day] = ($this->state['mappingDays'][$key][$day] ?? 0) + 1;
                    $teacherId = (int) $this->mappingInfo[$key]['guru_id'];
                    $this->state['teacherBusy'][$teacherId][$slotId] = true;
                    $this->state['teacherScheduled'][$teacherId] = ($this->state['teacherScheduled'][$teacherId] ?? 0) + 1;
                    $this->nodes++;
                }
            }
        }

        return $this->validateFinalSchedule();
    }

    /**
     * Jalankan beberapa percobaan CSP dari state bersih.
     * Urutan kandidat diacak di antara percobaan agar solver tidak terus
     * mengulang jalur deterministik yang cepat buntu karena konflik guru.
     * Semua constraint keras tetap diperiksa oleh solveGlobal/canPlace.
     */
    private function solveWithRestarts(): bool
    {
        $maxAttempts = 8;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            if ($attempt > 1) {
                foreach ($this->classDemand as $classId => $_) {
                    $this->state['classAssignments'][$classId] = [];
                    $this->state['classFilled'][$classId] = 0;
                    $this->state['classDays'][$classId] = [];
                }
                foreach ($this->mappingDemand as $key => $_) {
                    $this->state['mappingScheduled'][$key] = 0;
                    $this->state['mappingDays'][$key] = [];
                }
                foreach ($this->teacherDemand as $teacherId => $_) {
                    $this->state['teacherBusy'][$teacherId] = [];
                    $this->state['teacherScheduled'][$teacherId] = 0;
                }
            }

            // Tempatkan PJOK dan Agama sebagai blok 3 JP berdekatan terlebih dahulu.
            // Setelah blok wajib aman, backtracking mengisi mapel lainnya.
            if ($this->solveRequiredBlocksFirst()) {
                return true;
            }

            // Jika batas waktu/node tercapai, restart tidak akan menambah manfaat.
            if ($this->searchLimitReached || $this->nodes >= $this->maxNodes || microtime(true) >= $this->deadline) {
                $this->searchLimitReached = true;
                return false;
            }
        }

        return false;
    }

    /**
     * Jadwalkan blok PJOK dan Agama (masing-masing 3 JP) untuk semua kelas sebelum mapel lain.
     * Blok tetap menjadi keputusan backtracking: jika kombinasi blok membuat
     * jadwal mapel lain buntu, blok dibatalkan dan dicoba pada waktu lain.
     */
    private function solveRequiredBlocksFirst(): bool
    {
        $items = [];
        foreach ($this->classMappings as $classId => $keys) {
            foreach ($keys as $key) {
                if (!$this->isRequiredBlockMapping((string) $key)) continue;
                if ((int) ($this->mappingDemand[$key] ?? 0) !== 3) return false;
                $items[] = ['class_id' => (int) $classId, 'key' => (string) $key];
            }
        }

        // Jadwalkan dahulu PJOK dengan guru yang memiliki beban lebih tinggi,
        // karena slot gurunya biasanya lebih sulit disediakan.
        usort($items, function ($a, $b) {
            $teacherA = (int) ($this->mappingInfo[$a['key']]['guru_id'] ?? 0);
            $teacherB = (int) ($this->mappingInfo[$b['key']]['guru_id'] ?? 0);
            return ($this->teacherDemand[$teacherB] ?? 0) <=> ($this->teacherDemand[$teacherA] ?? 0);
        });

        return $this->placeRequiredBlocksRecursive($items, 0);
    }

    private function placeRequiredBlocksRecursive(array $items, int $index): bool
    {
        if ($this->nodes >= $this->maxNodes || microtime(true) >= $this->deadline) {
            $this->searchLimitReached = true;
            return false;
        }
        if ($index >= count($items)) return $this->solveGlobal();

        $classId = (int) $items[$index]['class_id'];
        $key = (string) $items[$index]['key'];
        $candidates = [];

        foreach ($this->days as $day) {
            $daySlotIds = $this->daySlots[$day] ?? [];
            for ($start = 0; $start + 3 <= count($daySlotIds); $start++) {
                $window = array_slice($daySlotIds, $start, 3);
                if (!$this->slotsContinuous($window)) {
                    continue;
                }
                // Slot istirahat tidak ada di daySlots. Karena itu JP 2, JP 3,
                // dan JP 5 tetap dianggap berdekatan walau jamnya dipisahkan
                // istirahat 15 menit. Jangan gunakan slotsContinuous() di sini.

                $available = true;
                $teacherId = (int) ($this->mappingInfo[$key]['guru_id'] ?? 0);
                foreach ($window as $slotId) {
                    if (isset($this->state['classAssignments'][$classId][$slotId])
                        || isset($this->state['teacherBusy'][$teacherId][$slotId])) {
                        $available = false;
                        break;
                    }
                }
                if (!$available) continue;

                $candidates[] = $this->buildCandidate($key, $day, $window);
            }
        }

        // Acak hanya kandidat yang setara supaya restart dapat mencoba kombinasi lain.
        shuffle($candidates);
        usort($candidates, fn ($a, $b) => $b['score'] <=> $a['score']);

        foreach ($candidates as $candidate) {
            if ($this->nodes >= $this->maxNodes || microtime(true) >= $this->deadline) {
                $this->searchLimitReached = true;
                return false;
            }
            $snapshot = $this->applyCandidate($classId, $candidate);
            $this->nodes++;

            if ($this->placeRequiredBlocksRecursive($items, $index + 1)) return true;

            $this->undoCandidate($classId, $candidate, $snapshot);
            if ($this->searchLimitReached) return false;
        }

        return false;
    }

    /**
     * CSP slot-by-slot dengan MRV.
     * Berbeda dari solver blok lama, variabelnya adalah satu sel kelas-slot.
     * Ini mengurangi percobaan kombinasi blok dan membolehkan mapel tersebar
     * jika diperlukan, sambil tetap menjaga batas JP harian dan konflik guru.
     */
    private function solveGlobal(): bool
    {
        if (++$this->nodes > $this->maxNodes || microtime(true) > $this->deadline) {
            $this->searchLimitReached = true;
            return false;
        }

        $bestClassId = null;
        $bestSlotId = null;
        $bestDomain = null;
        $bestDomainCount = PHP_INT_MAX;
        $bestTieScore = PHP_INT_MIN;

        /*
         * Optimasi pencarian:
         * Sebelumnya solver menghitung domain untuk SEMUA slot kosong pada
         * SEMUA kelas setiap node. Biaya ini sangat besar dan membuat proses
         * mencapai deadline sebelum jumlah node tinggi.
         *
         * Sekarang, untuk setiap kelas yang masih membutuhkan JP, cari slot
         * kosong pertama yang memiliki domain legal. Pilih kelas-slot dengan
         * domain terkecil di antara kandidat tersebut. Ini tetap menggunakan
         * heuristik fail-first/MRV, tetapi jauh lebih hemat pemeriksaan.
         * Slot tanpa kandidat dilewati karena slot tersebut dapat tetap kosong.
         */
        foreach ($this->classSlotIds as $classId => $slotIds) {
            if (($this->state['classFilled'][$classId] ?? 0) >= ($this->classDemand[$classId] ?? 0)) {
                continue;
            }

            foreach ($slotIds as $slotId) {
                if (isset($this->state['classAssignments'][$classId][$slotId])) {
                    continue;
                }

                $domain = $this->legalMappingsForSlot((int) $classId, (int) $slotId);
                $count = count($domain);

                // Slot ini belum bisa diisi pada state saat ini; coba slot berikutnya.
                if ($count === 0) {
                    continue;
                }

                $tieScore = 0;
                $day = $this->slots[$slotId]['hari'] ?? '';
                $position = array_search($slotId, $this->daySlots[$day] ?? [], true);
                foreach ($domain as $domainKey) {
                    $remaining = ($this->mappingDemand[$domainKey] ?? 0)
                        - ($this->state['mappingScheduled'][$domainKey] ?? 0);
                    $tieScore += ($remaining * 10);
                    if (!empty($this->mappingInfo[$domainKey]['priority_morning'])) {
                        $tieScore += ($position === 0 ? 1000 : ($position === 1 ? 500 : 0));
                    }
                }

                if ($count < $bestDomainCount || ($count === $bestDomainCount && $tieScore > $bestTieScore)) {
                    $bestClassId = (int) $classId;
                    $bestSlotId = (int) $slotId;
                    $bestDomain = $domain;
                    $bestDomainCount = $count;
                    $bestTieScore = $tieScore;
                }

                // Hanya slot kosong pertama yang memiliki pilihan legal dari
                // kelas ini yang dipakai untuk perbandingan MRV antar-kelas.
                break;
            }
        }

        // Tidak ada sel yang masih dapat diisi: valid jika seluruh demand terpenuhi.
        if ($bestClassId === null || $bestSlotId === null) {
            return $this->validateFinalSchedule();
        }

        $day = $this->slots[$bestSlotId]['hari'];
        $candidates = [];
        foreach ($bestDomain as $key) {
            $candidates[] = $this->buildCandidate($key, $day, [$bestSlotId]);
        }
        shuffle($candidates);
        usort($candidates, fn ($a, $b) => $b['score'] <=> $a['score']);

        foreach ($candidates as $candidate) {
            if ($this->nodes >= $this->maxNodes || microtime(true) > $this->deadline) {
                $this->searchLimitReached = true;
                return false;
            }

            $snapshot = $this->applyCandidate($bestClassId, $candidate);
            if ($this->forwardCheckAll() && $this->solveGlobal()) {
                return true;
            }
            $this->undoCandidate($bestClassId, $candidate, $snapshot);

            if ($this->searchLimitReached) {
                return false;
            }
        }

        return false;
    }

    /** Kembalikan mapping yang boleh mengisi satu slot untuk kelas tertentu. */
    private function legalMappingsForSlot(int $classId, int $slotId): array
    {
        $slot = $this->slots[$slotId] ?? null;
        if (!$slot) return [];
        $day = $slot['hari'];
        $legal = [];

        foreach ($this->classMappings[$classId] ?? [] as $key) {
            $remaining = ($this->mappingDemand[$key] ?? 0)
                - ($this->state['mappingScheduled'][$key] ?? 0);
            if ($remaining <= 0) continue;

            if (!$this->canPlace($classId, (string) $key, [$slotId])) continue;
            if ($this->wouldExceedSubjectBlock($classId, (string) $key, $slotId)) continue;

            $legal[] = (string) $key;
        }

        return $legal;
    }

    /**
     * Kembalikan semua slot JP sebagai domain kandidat untuk kelas.
     * Jangan memilih subset tetap sebanyak demand: jika tersedia 42 slot dan
     * kebutuhan kelas 41 JP, tiap kelas harus boleh memilih sendiri slot mana
     * yang dikosongkan. Subset tetap yang sama untuk semua kelas bisa membuat
     * jadwal mustahil karena memaksa semua kelas memakai 41 slot identik.
     */
    private function selectClassSlots(int $demand): array
    {
        $ids = array_map('intval', array_keys($this->slots));
        usort($ids, function ($a, $b) {
            $sa = $this->slots[$a];
            $sb = $this->slots[$b];
            $dayCompare = ($this->defaultDayOrder[$sa['hari']] ?? 99)
                <=> ($this->defaultDayOrder[$sb['hari']] ?? 99);
            return $dayCompare ?: (($sa['urutan'] <=> $sb['urutan']) ?: strcmp($sa['jam_mulai'], $sb['jam_mulai']));
        });
        return $ids;
    }

    /** Menolak jika menempatkan mapel ini akan membentuk lebih dari 3 JP berurutan. */
    private function wouldExceedSubjectBlock(int $classId, string $key, int $slotId): bool
    {
        $info = $this->mappingInfo[$key] ?? null;
        if (!$info) return true;
        $subjectId = (int) $info['mapel_id'];
        $day = $this->slots[$slotId]['hari'];
        $ids = $this->daySlots[$day] ?? [];
        $position = array_search($slotId, $ids, true);
        if ($position === false) return true;

        $length = 1;
        for ($i = $position - 1; $i >= 0; $i--) {
            $leftId = $ids[$i];
            $rightId = $ids[$i + 1];
            if (!$this->adjacentContinuous($leftId, $rightId)) break;
            $existingKey = $this->state['classAssignments'][$classId][$leftId] ?? null;
            if ($existingKey === null || (int) ($this->mappingInfo[$existingKey]['mapel_id'] ?? 0) !== $subjectId) break;
            $length++;
        }
        for ($i = $position + 1; $i < count($ids); $i++) {
            $leftId = $ids[$i - 1];
            $rightId = $ids[$i];
            if (!$this->adjacentContinuous($leftId, $rightId)) break;
            $existingKey = $this->state['classAssignments'][$classId][$rightId] ?? null;
            if ($existingKey === null || (int) ($this->mappingInfo[$existingKey]['mapel_id'] ?? 0) !== $subjectId) break;
            $length++;
        }
        return $length > 3;
    }

    /** Count legal candidates without constructing scored candidate arrays. */
    private function countCandidatesForMapping(int $classId, string $key, int $stopAfter): int
    {
        $demand = $this->mappingDemand[$key] ?? 0;
        $scheduled = $this->state['mappingScheduled'][$key] ?? 0;
        $classRemaining = ($this->classDemand[$classId] ?? 0) - ($this->state['classFilled'][$classId] ?? 0);
        $remaining = min($demand - $scheduled, $classRemaining);
        if ($remaining <= 0) return 0;

        $maxLength = min(3, $remaining);
        $count = 0;
        foreach ($this->days as $day) {
            $daySlotIds = $this->daySlots[$day] ?? [];
            for ($length = $maxLength; $length >= 1; $length--) {
                for ($start = 0, $n = count($daySlotIds); $start + $length <= $n; $start++) {
                    $ids = array_slice($daySlotIds, $start, $length);
                    if (!$this->slotsContinuous($ids) || !$this->canPlace($classId, $key, $ids)) continue;
                    $count++;
                    if ($count > $stopAfter) return $count;
                }
            }
        }
        return $count;
    }

    private function getCandidatesForMapping(int $classId, string $key): array
    {
        $demand = $this->mappingDemand[$key] ?? 0;
        $scheduled = $this->state['mappingScheduled'][$key] ?? 0;
        $remaining = min($demand - $scheduled, ($this->classDemand[$classId] ?? 0) - ($this->state['classFilled'][$classId] ?? 0));
        if ($remaining <= 0) return [];

        // Kandidat dapat berisi 1, 2, atau 3 JP berurutan.
        // Tiga JP berurutan diperbolehkan sesuai aturan sekolah.
        $maxLength = min(3, $remaining);
        $candidates = [];
        foreach ($this->days as $day) {
            $daySlotIds = $this->daySlots[$day] ?? [];
            for ($length = $maxLength; $length >= 1; $length--) {
                for ($start = 0; $start + $length <= count($daySlotIds); $start++) {
                    $ids = array_slice($daySlotIds, $start, $length);
                    if (!$this->slotsContinuous($ids) || !$this->canPlace($classId, $key, $ids)) continue;
                    $candidates[] = $this->buildCandidate($key, $day, $ids);
                }
            }
        }
        $unique = [];
        foreach ($candidates as $candidate) $unique[implode(',', $candidate['slot_ids'])] = $candidate;
        return array_values($unique);
    }

    private function buildCandidate(string $key, string $day, array $ids): array
    {
        $info = $this->mappingInfo[$key];
        $length = count($ids);
        $classId = (int) $info['class_id'];
        $dayLoad = $this->state['classDays'][$classId][$day] ?? 0;
        $subjectAlready = count($this->getSubjectIndicesOnDay($classId, (int) $info['mapel_id'], $day)) > 0;
        $distinctSubjects = $this->countDistinctSubjectsOnDay($classId, $day);
        $firstIndex = array_search($ids[0], $this->daySlots[$day], true);
        $score = match ($length) { 3 => 26000, 2 => 18000, default => 5000 };
        $remaining = $this->mappingDemand[$key] - $this->state['mappingScheduled'][$key];
        if ($length === min(3, $remaining)) $score += 15000;
        if ($dayLoad === 0) $score += 12000;
        $score -= $dayLoad * 1000;
        if ($subjectAlready) {
            $score += 14000; // utamakan melanjutkan mapel yang sudah ada hari itu
        } else {
            // Soft preference: usahakan 3 mapel berbeda per hari.
            // Mapel ke-4 tetap diperbolehkan bila diperlukan agar semua JP terpenuhi.
            $score -= $distinctSubjects * 4500;
            if ($distinctSubjects === 2) $score += 3500; // mapel ke-3 sangat diutamakan
            if ($distinctSubjects >= 3) $score -= 2500; // mapel ke-4 pilihan terakhir
        }
        // Prioritas pagi adalah soft constraint: membantu pemilihan,
        // tetapi tidak mengalahkan constraint wajib seperti konflik guru.
        if ($info['priority_morning']) {
            if ($firstIndex === 0) $score += 2500;
            elseif ($firstIndex === 1) $score += 1500;
            elseif ($firstIndex === 2) $score += 750;
            elseif ($firstIndex !== false) $score -= $firstIndex * 100;
        }
        $score -= ($this->defaultDayOrder[$day] ?? 99);
        return ['mapping_key' => $key, 'slot_ids' => $ids, 'day' => $day, 'length' => $length, 'score' => $score];
    }

    private function canPlace(int $classId, string $key, array $ids): bool
    {
        if (!$ids || count($ids) !== 1) return false;
        $slotId = (int) $ids[0];
        $info = $this->mappingInfo[$key] ?? null;
        $slot = $this->slots[$slotId] ?? null;
        if (!$info || !$slot || (int) $info['class_id'] !== $classId) return false;

        // Kelas hanya dijadwalkan pada subset slot yang sesuai kebutuhan JP.
        if (!in_array($slotId, $this->classSlotIds[$classId] ?? [], true)) return false;
        if (isset($this->state['classAssignments'][$classId][$slotId])) return false;
        if (isset($this->state['teacherBusy'][$info['guru_id']][$slotId])) return false;

        $keyRemaining = ($this->mappingDemand[$key] ?? 0)
            - ($this->state['mappingScheduled'][$key] ?? 0);
        if ($keyRemaining <= 0) return false;

        $day = $slot['hari'];
        if (($this->state['mappingDays'][$key][$day] ?? 0) >= 3) return false;

        // Batas keras hanya 4 mapel berbeda per kelas per hari.
        // Algoritma memberi skor lebih tinggi untuk 3 mapel, tetapi mapel ke-4
        // tetap boleh digunakan jika diperlukan untuk memenuhi seluruh kebutuhan JP.
        $subjectAlreadyToday = count($this->getSubjectIndicesOnDay($classId, (int) $info['mapel_id'], $day)) > 0;
        $distinctSubjectsToday = $this->countDistinctSubjectsOnDay($classId, $day);
        if (!$subjectAlreadyToday && $distinctSubjectsToday >= 4) return false;

        // Maksimal 3 JP untuk mapel yang sama per hari pada kelas ini.
        $sameSubjectToday = 0;
        foreach ($this->daySlots[$day] ?? [] as $daySlotId) {
            $existingKey = $this->state['classAssignments'][$classId][$daySlotId] ?? null;
            if ($existingKey !== null && (int) ($this->mappingInfo[$existingKey]['mapel_id'] ?? 0) === (int) $info['mapel_id']) {
                $sameSubjectToday++;
            }
        }
        if ($sameSubjectToday >= 3) return false;

        // CONSTRAINT WAJIB: mapel yang sama dalam kelas dan hari yang sama
        // harus berada dalam satu kelompok slot yang berdekatan. Slot istirahat
        // tidak ada di daySlots, sehingga JP sebelum dan sesudah istirahat tetap
        // dianggap berdekatan. Contoh: JP 2, JP 3, JP 5 boleh; JP 2 lalu JP 9
        // dengan mapel lain di antaranya tidak boleh.
        if (!$this->subjectCanStayGrouped($classId, (string) $key, $slotId)) return false;

        // PJOK dan Agama boleh terpisah oleh istirahat, tetapi semua 3 JP harus
        // tetap berada pada hari yang sama.
        if ($this->isRequiredBlockMapping((string) $key)
            && !$this->requiredBlockCanStillFitSameDay($classId, (string) $key, $slotId)) return false;

        return true;
    }

    private function applyCandidate(int $classId, array $candidate): array
    {
        $key = $candidate['mapping_key'];
        $info = $this->mappingInfo[$key];
        $teacherId = $info['guru_id'];
        $snapshot = [
            'classFilled' => $this->state['classFilled'][$classId],
            'classDays' => $this->state['classDays'][$classId],
            'mappingScheduled' => $this->state['mappingScheduled'][$key],
            'mappingDays' => $this->state['mappingDays'][$key],
            'teacherScheduled' => $this->state['teacherScheduled'][$teacherId],
        ];
        foreach ($candidate['slot_ids'] as $slotId) {
            $day = $this->slots[$slotId]['hari'];
            $this->state['classAssignments'][$classId][$slotId] = $key;
            $this->state['teacherBusy'][$teacherId][$slotId] = true;
            $this->state['classDays'][$classId][$day] = ($this->state['classDays'][$classId][$day] ?? 0) + 1;
            $this->state['mappingDays'][$key][$day] = ($this->state['mappingDays'][$key][$day] ?? 0) + 1;
        }
        $count = count($candidate['slot_ids']);
        $this->state['classFilled'][$classId] += $count;
        $this->state['mappingScheduled'][$key] += $count;
        $this->state['teacherScheduled'][$teacherId] += $count;
        return $snapshot;
    }

    private function undoCandidate(int $classId, array $candidate, array $snapshot): void
    {
        $key = $candidate['mapping_key'];
        $teacherId = $this->mappingInfo[$key]['guru_id'];
        foreach ($candidate['slot_ids'] as $slotId) {
            unset($this->state['classAssignments'][$classId][$slotId]);
            unset($this->state['teacherBusy'][$teacherId][$slotId]);
        }
        $this->state['classFilled'][$classId] = $snapshot['classFilled'];
        $this->state['classDays'][$classId] = $snapshot['classDays'];
        $this->state['mappingScheduled'][$key] = $snapshot['mappingScheduled'];
        $this->state['mappingDays'][$key] = $snapshot['mappingDays'];
        $this->state['teacherScheduled'][$teacherId] = $snapshot['teacherScheduled'];
    }

    private function forwardCheckAll(): bool
    {
        foreach ($this->classDemand as $classId => $target) {
            $filled = $this->state['classFilled'][$classId] ?? 0;
            $remaining = $target - $filled;
            if ($remaining < 0) return false;
            $freeSlots = 0;
            foreach ($this->classSlotIds[$classId] ?? [] as $slotId) if (!isset($this->state['classAssignments'][$classId][$slotId])) $freeSlots++;
            if ($freeSlots < $remaining) return false;
            $missingDays = $this->missingDays((int) $classId);
            if ($remaining < count($missingDays)) return false;
            foreach ($missingDays as $day) {
                $hasFree = false;
                foreach ($this->classSlotIds[$classId] ?? [] as $slotId) {
                    if (($this->slots[$slotId]['hari'] ?? null) === $day && !isset($this->state['classAssignments'][$classId][$slotId])) { $hasFree = true; break; }
                }
                if (!$hasFree) return false;
            }
            foreach ($this->classMappings[$classId] ?? [] as $key) {
                $left = $this->mappingDemand[$key] - $this->state['mappingScheduled'][$key];
                if ($left < 0 || $left > $freeSlots) return false;
                if ($left > 0 && $this->isRequiredBlockMapping((string) $key)
                    && !$this->requiredBlockCanStillFitSameDay((int) $classId, (string) $key)) return false;
                // Hindari membangun ulang seluruh kandidat untuk semua mapping pada
                // setiap node; pemeriksaan mahal ini membuat solver sangat lambat.
                // Jika mapping benar-benar tidak punya kandidat, MRV akan mendeteksinya.
            }
        }
        foreach ($this->teacherDemand as $teacherId => $demand) {
            $left = $demand - ($this->state['teacherScheduled'][$teacherId] ?? 0);
            if ($left < 0) return false;
            $free = 0;
            foreach ($this->slots as $slotId => $_) if (!isset($this->state['teacherBusy'][$teacherId][$slotId])) $free++;
            if ($free < $left) return false;
        }

        // Forward-check berkala: setiap 12 node, pastikan mapping yang belum selesai masih
        // memiliki cukup slot yang secara nyata dapat dipakai. Ini mencegah solver
        // masuk jauh ke cabang yang sudah mustahil, tanpa membangun semua domain
        // pada setiap node (yang justru membuat pencarian sangat lambat).
        if (($this->nodes % 12) === 0) {
            foreach ($this->mappingDemand as $key => $demand) {
                $left = $demand - ($this->state['mappingScheduled'][$key] ?? 0);
                if ($left <= 0) continue;
                $classId = (int) ($this->mappingInfo[$key]['class_id'] ?? 0);
                $possible = 0;
                foreach ($this->classSlotIds[$classId] ?? [] as $slotId) {
                    if (isset($this->state['classAssignments'][$classId][$slotId])) continue;
                    if (!$this->canPlace($classId, (string) $key, [(int) $slotId])) continue;
                    if ($this->wouldExceedSubjectBlock($classId, (string) $key, (int) $slotId)) continue;
                    $possible++;
                    if ($possible >= $left) break;
                }
                if ($possible < $left) return false;
            }
        }
        return true;
    }

    private function missingDays(int $classId): array
    {
        $missing = [];
        foreach ($this->days as $day) if (($this->state['classDays'][$classId][$day] ?? 0) === 0) $missing[] = $day;
        return $missing;
    }

    private function allClassesCoverAllDays(): bool
    {
        foreach ($this->classDemand as $classId => $target) {
            if (($this->state['classFilled'][$classId] ?? 0) !== $target || $this->missingDays((int) $classId)) return false;
            if (count($this->state['classAssignments'][$classId] ?? []) !== $target) return false;
        }
        return true;
    }

    private function validateFinalSchedule(): bool
    {
        if (!$this->allClassesCoverAllDays()) return false;
        foreach ($this->mappingDemand as $key => $demand) {
            if (($this->state['mappingScheduled'][$key] ?? 0) !== $demand) return false;
            foreach ($this->days as $day) if (($this->state['mappingDays'][$key][$day] ?? 0) > 3) return false;
        }
        foreach ($this->teacherDemand as $teacherId => $demand) if (($this->state['teacherScheduled'][$teacherId] ?? 0) !== $demand) return false;
        if (!$this->validateMaxSubjectBlocksAllClasses()) return false;
        // Validasi akhir: maksimal 4 mapel berbeda per kelas per hari.
        foreach (array_keys($this->classDemand) as $classId) {
            foreach ($this->days as $day) {
                if ($this->countDistinctSubjectsOnDay((int) $classId, (string) $day) > 4) return false;
            }
        }
        if (!$this->validateRequiredBlocksAllClasses()) return false;
        // Validasi akhir: guru tidak boleh mengajar pada lebih dari satu kelas di slot yang sama.
        $teacherSlotSeen = [];
        foreach ($this->state['classAssignments'] as $classId => $assignments) {
            foreach ($assignments as $slotId => $key) {
                $teacherId = (int) ($this->mappingInfo[$key]['guru_id'] ?? 0);
                if ($teacherId <= 0) return false;
                if (isset($teacherSlotSeen[$teacherId][$slotId])) return false;
                $teacherSlotSeen[$teacherId][$slotId] = (int) $classId;
            }
        }
        return true;
    }

    private function isPjokMapping(string $key): bool
    {
        $name = mb_strtolower(trim((string) ($this->mappingInfo[$key]['nama_mapel'] ?? '')));
        return str_contains($name, 'pjok')
            || str_contains($name, 'pendidikan jasmani')
            || str_contains($name, 'olahraga dan kesehatan');
    }

    private function isAgamaMapping(string $key): bool
    {
        $name = mb_strtolower(trim((string) ($this->mappingInfo[$key]['nama_mapel'] ?? '')));
        return str_contains($name, 'agama')
            || trim($name) === 'pai'
            || str_starts_with($name, 'pai ');
    }

    /** Kategori mapel yang wajib dijadwalkan dalam blok utuh 3 JP. */
    private function requiredBlockType(string $key): ?string
    {
        if ($this->isPjokMapping($key)) return 'pjok';
        if ($this->isAgamaMapping($key)) return 'agama';
        return null;
    }

    private function isRequiredBlockMapping(string $key): bool
    {
        return $this->requiredBlockType($key) !== null;
    }

    /**
     * Memastikan PJOK/Agama masih dapat menempati satu rentang 3 slot JP
     * pada hari yang sama. Slot istirahat tidak masuk daySlots, sehingga
     * jeda istirahat tidak memutus blok 3 JP.
     */
    private function requiredBlockCanStillFitSameDay(int $classId, string $key, ?int $candidateSlotId = null): bool
    {
        $type = $this->requiredBlockType($key);
        if ($type === null) return false;

        $placed = [];
        foreach ($this->state['classAssignments'][$classId] ?? [] as $slotId => $existingKey) {
            if ($this->requiredBlockType((string) $existingKey) === $type) {
                $placed[] = (int) $slotId;
            }
        }

        if ($candidateSlotId !== null) {
            if (in_array($candidateSlotId, $placed, true)) return false;
            $placed[] = $candidateSlotId;
        }
        if (count($placed) > 3) return false;

        $placedDays = [];
        foreach ($placed as $slotId) {
            $day = $this->slots[$slotId]['hari'] ?? null;
            if ($day === null) return false;
            $placedDays[] = $day;
        }
        if (count(array_unique($placedDays)) > 1) return false;

        $teacherId = (int) ($this->mappingInfo[$key]['guru_id'] ?? 0);
        $candidateDays = $placedDays ? [$placedDays[0]] : $this->days;

        foreach ($candidateDays as $day) {
            $dayIds = array_values($this->daySlots[$day] ?? []);
            $count = count($dayIds);
            for ($i = 0; $i <= $count - 3; $i++) {
                $window = array_slice($dayIds, $i, 3);

                // Blok harus berurutan berdasarkan waktu, bukan sekadar urutan slot.
                if (!$this->slotsContinuous($window)) {
                    continue;
                }

                if (array_diff($placed, $window)) {
                    continue;
                }

                $validWindow = true;
                foreach ($window as $slotId) {
                    if (in_array((int) $slotId, $placed, true)) continue;
                    if (isset($this->state['classAssignments'][$classId][$slotId])) {
                        $validWindow = false;
                        break;
                    }
                    if ($teacherId > 0 && isset($this->state['teacherBusy'][$teacherId][$slotId])) {
                        $validWindow = false;
                        break;
                    }
                }
                if ($validWindow) return true;
            }
        }

        return false;
    }

    /** Validasi akhir: PJOK dan Agama masing-masing harus berupa blok utuh 3 JP. */
    private function validateRequiredBlocksAllClasses(): bool
    {
        $requiredTypes = ['pjok', 'agama'];

        foreach (array_keys($this->classDemand) as $classId) {
            foreach ($requiredTypes as $type) {
                $blockSlots = [];
                foreach ($this->state['classAssignments'][$classId] ?? [] as $slotId => $key) {
                    if ($this->requiredBlockType((string) $key) === $type) {
                        $blockSlots[] = (int) $slotId;
                    }
                }

                if (count($blockSlots) !== 3) return false;

                $days = [];
                foreach ($blockSlots as $slotId) {
                    $day = $this->slots[$slotId]['hari'] ?? null;
                    if ($day === null) return false;
                    $days[] = $day;
                }
                if (count(array_unique($days)) !== 1) return false;

                $day = $days[0];
                $dayIds = array_values($this->daySlots[$day] ?? []);
                $positions = [];
                foreach ($blockSlots as $slotId) {
                    $position = array_search($slotId, $dayIds, true);
                    if ($position === false) return false;
                    $positions[] = $position;
                }
                sort($positions);

                // Harus menempati 3 slot JP berurutan; slot istirahat tidak dihitung.
                if ($positions[1] !== $positions[0] + 1 || $positions[2] !== $positions[1] + 1) {
                    return false;
                }
            }
        }
        return true;
    }

    private function validateMaxSubjectBlocksAllClasses(): bool
    {
        foreach (array_keys($this->classDemand) as $classId) {
            foreach ($this->daySlots as $day => $slotIds) {
                $lastSubject = null; $lastSlot = null; $length = 0;
                foreach ($slotIds as $slotId) {
                    if ($lastSlot !== null && !$this->adjacentContinuous($lastSlot, $slotId)) { $lastSubject = null; $length = 0; }
                    $key = $this->state['classAssignments'][$classId][$slotId] ?? null;
                    if ($key === null) { $lastSubject = null; $length = 0; $lastSlot = $slotId; continue; }
                    $subjectId = $this->mappingInfo[$key]['mapel_id'] ?? null;
                    if ($subjectId === null) return false;
                    if ($subjectId === $lastSubject) $length++; else { $lastSubject = $subjectId; $length = 1; }
                    if ($length > 3) return false;
                    $lastSlot = $slotId;
                }
            }
        }
        return true;
    }

    /**
     * Constraint keras: satu mata pelajaran per kelas per hari harus membentuk
     * satu kelompok berdekatan dalam urutan slot JP (istirahat diabaikan).
     * Slot yang sudah terisi mapel lain tidak boleh memisahkan kelompok tersebut.
     */
    private function subjectCanStayGrouped(int $classId, string $key, int $candidateSlotId): bool
    {
        $info = $this->mappingInfo[$key] ?? null;
        $candidateSlot = $this->slots[$candidateSlotId] ?? null;
        if (!$info || !$candidateSlot) return false;

        $subjectId = (int) $info['mapel_id'];
        $day = (string) $candidateSlot['hari'];
        $dayIds = array_values($this->daySlots[$day] ?? []);
        $candidatePosition = array_search($candidateSlotId, $dayIds, true);
        if ($candidatePosition === false) return false;

        $positions = [];
        foreach ($dayIds as $position => $slotId) {
            $existingKey = $this->state['classAssignments'][$classId][$slotId] ?? null;
            if ($existingKey !== null && (int) ($this->mappingInfo[$existingKey]['mapel_id'] ?? 0) === $subjectId) {
                $positions[] = (int) $position;
            }
        }

        // Mapel ini belum ada pada hari tersebut; boleh memulai kelompok baru.
        if (!$positions) return true;

        $min = min($positions);
        $max = max($positions);

        // Tambahan JP hanya boleh memperpanjang salah satu ujung kelompok atau
        // mengisi celah kosong di dalam kelompok yang sedang dibangun.
        if ($candidatePosition < $min - 1 || $candidatePosition > $max + 1) return false;

        $newMin = min($min, $candidatePosition);
        $newMax = max($max, $candidatePosition);
        for ($position = $newMin; $position <= $newMax; $position++) {
            $slotId = $dayIds[$position];
            if ($slotId === $candidateSlotId) continue;
            $existingKey = $this->state['classAssignments'][$classId][$slotId] ?? null;
            if ($existingKey === null) continue;
            $existingSubjectId = (int) ($this->mappingInfo[$existingKey]['mapel_id'] ?? 0);
            if ($existingSubjectId !== $subjectId) return false;
        }

        return true;
    }

    /** Menghitung jumlah mapel berbeda yang sudah terjadwal untuk satu kelas pada satu hari. */
    private function countDistinctSubjectsOnDay(int $classId, string $day): int
    {
        $subjectIds = [];
        foreach ($this->daySlots[$day] ?? [] as $slotId) {
            $key = $this->state['classAssignments'][$classId][$slotId] ?? null;
            if ($key === null) continue;
            $subjectId = (int) ($this->mappingInfo[$key]['mapel_id'] ?? 0);
            if ($subjectId > 0) $subjectIds[$subjectId] = true;
        }
        return count($subjectIds);
    }

    private function getSubjectIndicesOnDay(int $classId, int $subjectId, string $day): array
    {
        $indices = [];
        foreach ($this->daySlots[$day] ?? [] as $index => $slotId) {
            $key = $this->state['classAssignments'][$classId][$slotId] ?? null;
            if ($key !== null && (int) ($this->mappingInfo[$key]['mapel_id'] ?? 0) === $subjectId) $indices[] = $index;
        }
        return $indices;
    }

    private function adjacentContinuous(int $previousId, int $nextId): bool
    {
        $previous = $this->slots[$previousId] ?? null;
        $next = $this->slots[$nextId] ?? null;
        if (!$previous || !$next || $previous['hari'] !== $next['hari']) return false;
        return substr(trim($previous['jam_selesai']), 0, 8) === substr(trim($next['jam_mulai']), 0, 8);
    }

    private function slotsContinuous(array $ids): bool
    {
        if (!$ids) return false;
        for ($i = 1; $i < count($ids); $i++) if (!$this->adjacentContinuous((int) $ids[$i - 1], (int) $ids[$i])) return false;
        return true;
    }

    private function dayRangeContinuous(string $day, int $first, int $last): bool
    {
        $ids = $this->daySlots[$day] ?? [];
        if ($first < 0 || $last >= count($ids) || $first > $last) return false;
        for ($i = $first + 1; $i <= $last; $i++) if (!$this->adjacentContinuous($ids[$i - 1], $ids[$i])) return false;
        return true;
    }

    
public function tukarJadwal(Request $request)
{
    $data = $request->validate([
        'jadwal_id' => ['required', 'integer', 'exists:jadwal_pelajarans,id'],
        'slot_tujuan_id' => ['required', 'integer', 'exists:slot_waktus,id'],
        'tahun_ajaran' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
        'semester' => ['required', 'in:Ganjil,Genap'],
    ]);

    [$yearStart, $yearEnd] = explode('/', $data['tahun_ajaran']);

    if ((int) $yearEnd !== (int) $yearStart + 1) {
        return back()->with('error', 'Tahun ajaran tidak valid.');
    }

    // Fitur pengubahan jadwal hanya untuk Waka dan admin.
    $role = strtolower((string) (auth()->user()->role ?? ''));

    if (!in_array($role, ['waka', 'admin'], true)) {
        abort(403, 'Kamu tidak memiliki izin untuk mengubah jadwal.');
    }

    try {
        DB::transaction(function () use ($data) {
            $jadwal = JadwalPelajaran::whereKey($data['jadwal_id'])
                ->where('tahun_ajaran', $data['tahun_ajaran'])
                ->where('semester', $data['semester'])
                ->lockForUpdate()
                ->firstOrFail();

            $slotAsal = SlotWaktu::findOrFail($jadwal->slot_waktu_id);
            $slotTujuan = SlotWaktu::findOrFail($data['slot_tujuan_id']);

            // Perubahan hanya boleh menggunakan slot pelajaran.
            if (
                strtolower(trim((string) $slotAsal->jenis)) !== 'jp' ||
                strtolower(trim((string) $slotTujuan->jenis)) !== 'jp'
            ) {
                throw new \RuntimeException(
                    'Jadwal hanya dapat dipindahkan ke slot berjenis JP.'
                );
            }

            if ((int) $slotAsal->getKey() === (int) $slotTujuan->getKey()) {
                throw new \RuntimeException(
                    'Pilih slot tujuan yang berbeda dari posisi sekarang.'
                );
            }

            // Cari jadwal lain pada kelas yang sama dan slot tujuan.
            $jadwalTujuan = JadwalPelajaran::where(
                    'tahun_ajaran',
                    $data['tahun_ajaran']
                )
                ->where('semester', $data['semester'])
                ->where('kelas_id', $jadwal->kelas_id)
                ->where('slot_waktu_id', $slotTujuan->getKey())
                ->where('id', '!=', $jadwal->id)
                ->lockForUpdate()
                ->first();

            $idJadwalTujuan = $jadwalTujuan?->id;

            // Pastikan guru jadwal yang dipindahkan tidak bentrok
            // dengan kelas lain pada slot tujuan.
            $bentrokGuruTujuan = JadwalPelajaran::where(
                    'tahun_ajaran',
                    $data['tahun_ajaran']
                )
                ->where('semester', $data['semester'])
                ->where('slot_waktu_id', $slotTujuan->getKey())
                ->where('guru_id', $jadwal->guru_id)
                ->where('id', '!=', $jadwal->id)
                ->when(
                    $idJadwalTujuan !== null,
                    fn ($query) => $query->where('id', '!=', $idJadwalTujuan)
                )
                ->exists();

            if ($bentrokGuruTujuan) {
                throw new \RuntimeException(
                    'Guru pada jadwal ini sudah mengajar di kelas lain pada slot tujuan.'
                );
            }

            // Jika slot tujuan terisi, periksa apakah guru jadwal tujuan
            // akan bentrok ketika dipindahkan ke slot asal.
            if ($jadwalTujuan) {
                $bentrokGuruAsal = JadwalPelajaran::where(
                        'tahun_ajaran',
                        $data['tahun_ajaran']
                    )
                    ->where('semester', $data['semester'])
                    ->where('slot_waktu_id', $slotAsal->getKey())
                    ->where('guru_id', $jadwalTujuan->guru_id)
                    ->whereNotIn('id', [$jadwal->id, $jadwalTujuan->id])
                    ->exists();

                if ($bentrokGuruAsal) {
                    throw new \RuntimeException(
                        'Guru pada jadwal tujuan sudah mengajar di kelas lain pada slot asal.'
                    );
                }
            }

            // Simpan posisi awal untuk pertukaran.
            $asal = [
                'slot_waktu_id' => $slotAsal->getKey(),
                'hari' => $slotAsal->hari,
                'jam_mulai' => $slotAsal->jam_mulai,
                'jam_selesai' => $slotAsal->jam_selesai,
            ];

            // Pindahkan jadwal pertama ke slot tujuan.
            $jadwal->slot_waktu_id = $slotTujuan->getKey();
            $jadwal->hari = $slotTujuan->hari;
            $jadwal->jam_mulai = $slotTujuan->jam_mulai;
            $jadwal->jam_selesai = $slotTujuan->jam_selesai;
            $jadwal->save();

            if ($jadwalTujuan) {
                // Slot tujuan sudah terisi kelas yang sama:
                // tukar kedua jadwal.
                $jadwalTujuan->slot_waktu_id = $asal['slot_waktu_id'];
                $jadwalTujuan->hari = $asal['hari'];
                $jadwalTujuan->jam_mulai = $asal['jam_mulai'];
                $jadwalTujuan->jam_selesai = $asal['jam_selesai'];
                $jadwalTujuan->save();
            }
        });

        session([
            'tahun_ajaran_aktif' => $data['tahun_ajaran'],
            'semester_aktif' => $data['semester'],
        ]);

        return redirect()
            ->route('jadwal-pelajaran.show', [
                'tahun_ajaran' => $data['tahun_ajaran'],
                'semester' => $data['semester'],
            ])
            ->with('success', 'Perubahan jadwal berhasil disimpan.');

    } catch (Throwable $e) {
        if ($e instanceof \RuntimeException) {
            return back()->with('error', $e->getMessage());
        }

        report($e);

        return back()->with(
            'error',
            'Gagal mengubah jadwal. Periksa log Laravel untuk mengetahui detail kesalahannya.'
        );
    }
}

}
