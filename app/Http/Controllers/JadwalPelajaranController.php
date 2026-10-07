<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\SlotWaktu;
use App\Models\MappingPengampu;

class JadwalPelajaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATA CSP
    |--------------------------------------------------------------------------
    */

    private array $cspSlots = [];
    private array $cspDaySlots = [];
    private array $cspMappings = [];
    private array $cspClassMappings = [];

    /*
    | Kebutuhan JP setiap mapping.
    */
    private array $cspMappingDemand = [];

    /*
    | Total kebutuhan JP setiap kelas.
    */
    private array $cspTotalClassDemand = [];

    /*
    | Total kebutuhan JP setiap guru.
    */
    private array $cspTotalTeacherDemand = [];

    /*
    | Target total JP setiap kelas.
    */
    private array $cspClassTarget = [];

    /*
    | State pencarian Backtracking.
    */
    private array $cspState = [];

    /*
    | Statistik pencarian.
    */
    private int $cspNodes = 0;

    /*
    | Batas keamanan pencarian.
    */
    private int $cspMaxNodes = 1000000;

    /*
    |--------------------------------------------------------------------------
    | URUTAN HARI
    |--------------------------------------------------------------------------
    |
    | Aturan sekolah:
    | Senin - Sabtu.
    |
    */

    private array $cspDayOrder = [
        'senin'  => 1,
        'selasa' => 2,
        'rabu'   => 3,
        'kamis'  => 4,
        'jumat'  => 5,
        'sabtu'  => 6,
    ];


    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $listTahunAjaran = JadwalPelajaran::distinct()
            ->pluck('tahun_ajaran')
            ->toArray();

        if (empty($listTahunAjaran)) {
            $listTahunAjaran = [
                date('Y') . '/' . (date('Y') + 1)
            ];
        }

        $tahunAjaran = $request->input(
            'tahun_ajaran',
            session(
                'tahun_ajaran_aktif',
                $listTahunAjaran[0]
            )
        );

        $semester = $request->input(
            'semester',
            session(
                'semester_aktif',
                'Ganjil'
            )
        );

        session([
            'tahun_ajaran_aktif' => $tahunAjaran,
            'semester_aktif' => $semester,
        ]);

        return view(
            'jadwal.index',
            compact(
                'tahunAjaran',
                'semester',
                'listTahunAjaran'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW / MATRIX JADWAL
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {
        $listTahunAjaran = JadwalPelajaran::distinct()
            ->pluck('tahun_ajaran')
            ->toArray();

        if (empty($listTahunAjaran)) {
            $listTahunAjaran = [
                date('Y') . '/' . (date('Y') + 1)
            ];
        }

        $defaultTahun = $request->input(
            'tahun_ajaran',
            $listTahunAjaran[0]
        );

        $tahunAjaran = $request->input(
            'tahun_ajaran',
            $defaultTahun
        );

        $semester = $request->input(
            'semester',
            'Ganjil'
        );

        $kelasList = Kelas::where(
            'is_active',
            1
        )->get();

        /*
        | Semua slot tetap ditampilkan di matrix.
        | Termasuk JP, istirahat, dan terkunci.
        */
        $slotWaktuList = SlotWaktu::orderBy(
            'urutan'
        )->get();

        $jadwalList = JadwalPelajaran::with([
            'mataPelajaran',
            'guru',
            'kelas',
            'slotWaktu'
        ])
        ->where(
            'tahun_ajaran',
            $tahunAjaran
        )
        ->where(
            'semester',
            $semester
        )
        ->get();

        $matriksJadwal = [];

        foreach ($jadwalList as $j) {

            $hariSource =
                $j->slotWaktu->hari
                ?? $j->hari
                ?? '';

            $hariLower = strtolower(
                trim($hariSource)
            );

            $jamSource =
                $j->slotWaktu->jam_mulai
                ?? $j->jam_mulai
                ?? '';

            $jamSlot = substr(
                trim($jamSource),
                0,
                5
            );

            $matriksJadwal[
                $hariLower
            ][
                $jamSlot
            ][
                $j->kelas_id
            ] = [
                'mapel' =>
                    $j->mataPelajaran->nama_mapel
                    ?? '-',

                'guru' =>
                    $j->guru->nama
                    ?? '-',
            ];

            if ($j->slot_waktu_id) {

                $matriksJadwal[
                    'by_slot'
                ][
                    $j->slot_waktu_id
                ][
                    $j->kelas_id
                ] = [
                    'mapel' =>
                        $j->mataPelajaran->nama_mapel
                        ?? '-',

                    'guru' =>
                        $j->guru->nama
                        ?? '-',
                ];
            }
        }

        return view(
            'jadwal-pelajaran.show',
            compact(
                'slotWaktuList',
                'kelasList',
                'matriksJadwal',
                'tahunAjaran',
                'semester',
                'listTahunAjaran'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SET FILTER
    |--------------------------------------------------------------------------
    */

    public function setFilter(Request $request)
    {
        $tahunAjaran = $request->input(
            'tahun_ajaran'
        );

        $semester = $request->input(
            'semester',
            'Ganjil'
        );

        session([
            'tahun_ajaran_aktif' => $tahunAjaran,
            'semester_aktif' => $semester,
        ]);

        return redirect()->route(
            'jadwal-pelajaran.show',
            [
                'tahun_ajaran' => $tahunAjaran,
                'semester' => $semester,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE JADWAL
    |--------------------------------------------------------------------------
    |
    | Semua data dibaca dari database.
    |
    | Controller TIDAK menentukan:
    | - MTK berapa JP
    | - Bahasa Indonesia berapa JP
    | - Guru tertentu mengajar mapel tertentu
    | - Jumlah kelas tertentu
    |
    | Semua berasal dari mapping_pengampus.
    |
    |--------------------------------------------------------------------------
    |
    | HARD CONSTRAINT
    |
    | 1. Hanya slot jenis "jp" yang dapat digunakan.
    | 2. Istirahat tidak dihitung sebagai JP.
    | 3. Terkunci tidak dihitung sebagai JP.
    | 4. Guru tidak boleh bentrok.
    | 5. Kelas tidak boleh bentrok.
    | 6. Semua jumlah_jp mapping harus terpenuhi.
    | 7. Setiap kelas yang mempunyai mapping harus memiliki
    |    minimal satu JP pada setiap hari Senin-Sabtu.
    | 8. Mapel tidak boleh muncul kembali setelah dipisahkan
    |    oleh mapel lain atau slot JP kosong.
    | 9. Maksimal satu block mapel adalah 4 JP.
    |
    | SOFT PREFERENCE
    |
    | 1. 2 JP berurutan lebih disukai.
    | 2. 1 JP tetap diperbolehkan.
    | 3. 3 JP diperbolehkan.
    | 4. 4 JP diperbolehkan.
    | 5. Untuk total 4 JP, 2+2 lebih disukai.
    | 6. Untuk total 5 JP, 2+2+1 lebih disukai.
    | 7. Untuk total 6 JP, 2+2+2 lebih disukai.
    |
    */

    public function generate(Request $request)
    {
        $tahunAjaran = session(
            'tahun_ajaran_aktif',
            $request->input('tahun_ajaran')
        );

        $semester = session(
            'semester_aktif',
            $request->input(
                'semester',
                'Ganjil'
            )
        );

        if (!$tahunAjaran) {
            $tahunAjaran =
                date('Y') . '/' . (date('Y') + 1);
        }


        /*
        |--------------------------------------------------------------------------
        | KELAS AKTIF
        |--------------------------------------------------------------------------
        */

        $kelasList = Kelas::where(
            'is_active',
            1
        )->get();

        if ($kelasList->isEmpty()) {

            return $this->generateError(
                $tahunAjaran,
                $semester,
                'Tidak ada kelas aktif.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SLOT JP
        |--------------------------------------------------------------------------
        |
        | Hanya "jp" masuk ke domain CSP.
        |
        */

        $slotCollection = SlotWaktu::where(
            'jenis',
            'jp'
        )
        ->get()
        ->sortBy(
            function ($slot) {

                $hari = strtolower(
                    trim($slot->hari)
                );

                return [
                    $this->cspDayOrder[$hari] ?? 99,
                    (int) $slot->urutan,
                ];
            }
        )
        ->values();

        if ($slotCollection->isEmpty()) {

            return $this->generateError(
                $tahunAjaran,
                $semester,
                'Tidak ada slot JP yang tersedia.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BENTUK DOMAIN SLOT
        |--------------------------------------------------------------------------
        */

        $this->cspSlots = [];
        $this->cspDaySlots = [];

        foreach ($slotCollection as $slot) {

            $slotId = $slot->getKey();

            $hari = strtolower(
                trim($slot->hari)
            );

            $this->cspSlots[$slotId] = [
                'id' =>
                    $slotId,

                'hari' =>
                    $hari,

                'urutan' =>
                    (int) $slot->urutan,

                'jam_mulai' =>
                    $slot->jam_mulai,

                'jam_selesai' =>
                    $slot->jam_selesai,
            ];

            $this->cspDaySlots[
                $hari
            ][] = $slotId;
        }


        /*
        |--------------------------------------------------------------------------
        | HARI WAJIB
        |--------------------------------------------------------------------------
        |
        | Mengambil langsung dari konfigurasi hari.
        |
        */

        $hariWajib = array_keys(
            $this->cspDayOrder
        );

        foreach ($hariWajib as $hari) {

            if (
                empty(
                    $this->cspDaySlots[$hari]
                    ?? []
                )
            ) {

                return $this->generateError(
                    $tahunAjaran,
                    $semester,
                    "Slot JP hari {$hari} belum tersedia."
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | MAPPING PENGAMPU
        |--------------------------------------------------------------------------
        */

        $mappingCollection =
            MappingPengampu::with([
                'mataPelajaran',
                'guru',
                'kelas',
            ])
            ->where(
                'jumlah_jp',
                '>',
                0
            )
            ->get();

        $activeClassIds =
            $kelasList
                ->pluck('id_kelas')
                ->map(
                    fn ($id) => (int) $id
                )
                ->toArray();

        /*
        | Hanya mapping untuk kelas aktif.
        */
        $mappingCollection =
            $mappingCollection
                ->filter(
                    function ($mapping)
                    use ($activeClassIds) {

                        return in_array(
                            (int) $mapping->kelas_id,
                            $activeClassIds,
                            true
                        );
                    }
                )
                ->values();

        if (
            $mappingCollection->isEmpty()
        ) {

            return $this->generateError(
                $tahunAjaran,
                $semester,
                'Data mapping pengampu belum tersedia.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | RESET DATA CSP
        |--------------------------------------------------------------------------
        */

        $this->cspMappings = [];
        $this->cspClassMappings = [];
        $this->cspMappingDemand = [];
        $this->cspTotalClassDemand = [];
        $this->cspTotalTeacherDemand = [];
        $this->cspClassTarget = [];


        /*
        |--------------------------------------------------------------------------
        | BENTUK DATA MAPPING
        |--------------------------------------------------------------------------
        |
        | Tidak ada ID guru/mapel yang di-hardcode.
        |
        */

        foreach (
            $mappingCollection as $mapping
        ) {

            $mappingKey =
                (string) $mapping->getKey();

            $classId =
                (int) $mapping->kelas_id;

            $guruId =
                (int) $mapping->guru_id;

            $jumlahJp =
                (int) $mapping->jumlah_jp;

            if ($jumlahJp <= 0) {
                continue;
            }

            /*
            | Mapping harus mempunyai guru.
            */
            if (!$mapping->guru_id) {
                continue;
            }

            /*
            | Mapping harus mempunyai mapel.
            */
            if (!$mapping->mata_pelajaran_id) {
                continue;
            }

            $this->cspMappings[
                $mappingKey
            ] = $mapping;

            $this->cspMappingDemand[
                $mappingKey
            ] = $jumlahJp;

            $this->cspClassMappings[
                $classId
            ][] = $mappingKey;

            $this->cspTotalClassDemand[
                $classId
            ] =
                (
                    $this->cspTotalClassDemand[
                        $classId
                    ] ?? 0
                )
                +
                $jumlahJp;

            $this->cspTotalTeacherDemand[
                $guruId
            ] =
                (
                    $this->cspTotalTeacherDemand[
                        $guruId
                    ] ?? 0
                )
                +
                $jumlahJp;
        }


        /*
        |--------------------------------------------------------------------------
        | TARGET JP KELAS
        |--------------------------------------------------------------------------
        */

        $jumlahSlotTersedia =
            count($this->cspSlots);

        foreach ($kelasList as $kelas) {

            $classId =
                (int) $kelas->id_kelas;

            $demand =
                $this->cspTotalClassDemand[
                    $classId
                ] ?? 0;

            /*
            | Kelas tanpa mapping tidak perlu
            | dibuatkan jadwal.
            */
            if ($demand <= 0) {
                continue;
            }

            /*
            | Karena setiap kelas wajib mempunyai
            | minimal 1 JP pada setiap hari.
            */
            $jumlahHariWajib =
                count($hariWajib);

            if (
                $demand
                <
                $jumlahHariWajib
            ) {

                return $this->generateError(
                    $tahunAjaran,
                    $semester,
                    "Kelas {$kelas->nama_kelas} memiliki "
                    . "{$demand} JP. Minimal {$jumlahHariWajib} JP "
                    . "diperlukan untuk memenuhi distribusi "
                    . "Senin-Sabtu."
                );
            }

            /*
            | Kebutuhan kelas tidak boleh melebihi
            | jumlah slot JP yang tersedia dalam seminggu.
            */
            if (
                $demand
                >
                $jumlahSlotTersedia
            ) {

                return $this->generateError(
                    $tahunAjaran,
                    $semester,
                    "Kelas {$kelas->nama_kelas} memiliki "
                    . "kebutuhan {$demand} JP, melebihi "
                    . "jumlah slot JP yang tersedia "
                    . "dalam satu minggu."
                );
            }

            $this->cspClassTarget[
                $classId
            ] = $demand;
        }


        /*
        |--------------------------------------------------------------------------
        | CEK BEBAN GURU
        |--------------------------------------------------------------------------
        |
        | Satu guru tidak mungkin mengajar lebih banyak
        | dari total slot JP yang tersedia dalam seminggu.
        |
        */

        foreach (
            $this->cspTotalTeacherDemand
            as $guruId => $demand
        ) {

            if (
                $demand
                >
                $jumlahSlotTersedia
            ) {

                $guru = null;

                foreach (
                    $this->cspMappings as $mapping
                ) {

                    if (
                        (int) $mapping->guru_id
                        ===
                        (int) $guruId
                    ) {

                        $guru =
                            $mapping->guru;

                        break;
                    }
                }

                $namaGuru =
                    $guru->nama
                    ?? "Guru ID {$guruId}";

                return $this->generateError(
                    $tahunAjaran,
                    $semester,
                    "Beban {$namaGuru} sebesar {$demand} JP "
                    . "melebihi {$jumlahSlotTersedia} slot JP "
                    . "yang tersedia dalam satu minggu."
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | STATE AWAL
        |--------------------------------------------------------------------------
        */

        $this->cspState = [
            'classAssignments' => [],
            'teacherBusy' => [],
            'mappingScheduled' => [],
            'teacherScheduled' => [],
            'classFilled' => [],
            'classDays' => [],
            'mappingDays' => [],
        ];


        /*
        |--------------------------------------------------------------------------
        | INIT CLASS
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspClassTarget as $classId => $target
        ) {

            $this->cspState[
                'classAssignments'
            ][$classId] = [];

            $this->cspState[
                'classFilled'
            ][$classId] = 0;

            $this->cspState[
                'classDays'
            ][$classId] = [];
        }


        /*
        |--------------------------------------------------------------------------
        | INIT MAPPING
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspMappingDemand as $mappingKey => $demand
        ) {

            $this->cspState[
                'mappingScheduled'
            ][$mappingKey] = 0;

            $this->cspState[
                'mappingDays'
            ][$mappingKey] = [];
        }


        /*
        |--------------------------------------------------------------------------
        | INIT GURU
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspTotalTeacherDemand as $guruId => $demand
        ) {

            $this->cspState[
                'teacherBusy'
            ][$guruId] = [];

            $this->cspState[
                'teacherScheduled'
            ][$guruId] = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | RESET NODE
        |--------------------------------------------------------------------------
        */

        $this->cspNodes = 0;

        @set_time_limit(300);


        /*
        |--------------------------------------------------------------------------
        | BACKTRACKING
        |--------------------------------------------------------------------------
        */

        $berhasil =
            $this->backtrackBlockCSP();

        if (!$berhasil) {

            return $this->generateError(
                $tahunAjaran,
                $semester,
                'Jadwal tidak dapat dibuat. '
                . 'CSP + Backtracking tidak menemukan '
                . 'solusi yang memenuhi seluruh constraint. '
                . 'Node pencarian: '
                . $this->cspNodes
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI FINAL
        |--------------------------------------------------------------------------
        */

        if (
            !$this->validateFinalSchedule()
        ) {

            return $this->generateError(
                $tahunAjaran,
                $semester,
                'Solusi ditemukan tetapi gagal validasi akhir.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        try {

            DB::transaction(
                function () use (
                    $tahunAjaran,
                    $semester
                ) {

                    JadwalPelajaran::where(
                        'tahun_ajaran',
                        $tahunAjaran
                    )
                    ->where(
                        'semester',
                        $semester
                    )
                    ->delete();

                    $insertData = [];

                    foreach (
                        $this->cspState[
                            'classAssignments'
                        ] as $classId => $assignments
                    ) {

                        foreach (
                            $assignments as $slotId => $mappingKey
                        ) {

                            if (
                                !isset(
                                    $this->cspMappings[
                                        $mappingKey
                                    ]
                                )
                            ) {
                                continue;
                            }

                            if (
                                !isset(
                                    $this->cspSlots[
                                        $slotId
                                    ]
                                )
                            ) {
                                continue;
                            }

                            $mapping =
                                $this->cspMappings[
                                    $mappingKey
                                ];

                            $slot =
                                $this->cspSlots[
                                    $slotId
                                ];

                            /*
                            | Safety:
                            | Hanya slot JP yang masuk database.
                            */
                            $insertData[] = [
                                'mata_pelajaran_id' =>
                                    (int)
                                    $mapping->mata_pelajaran_id,

                                'guru_id' =>
                                    (int)
                                    $mapping->guru_id,

                                'kelas_id' =>
                                    (int)
                                    $classId,

                                'slot_waktu_id' =>
                                    (int)
                                    $slotId,

                                'hari' =>
                                    $slot['hari'],

                                'jam_mulai' =>
                                    $slot['jam_mulai'],

                                'jam_selesai' =>
                                    $slot['jam_selesai'],

                                'tahun_ajaran' =>
                                    $tahunAjaran,

                                'semester' =>
                                    $semester,

                                'created_at' =>
                                    now(),

                                'updated_at' =>
                                    now(),
                            ];
                        }
                    }

                    if (!empty($insertData)) {

                        JadwalPelajaran::insert(
                            $insertData
                        );
                    }
                }
            );

        } catch (\Throwable $e) {

            return $this->generateError(
                $tahunAjaran,
                $semester,
                'Gagal menyimpan jadwal ke database: '
                . $e->getMessage()
            );
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $totalTerjadwal = 0;

        foreach (
            $this->cspState['classFilled']
            as $filled
        ) {

            $totalTerjadwal += $filled;
        }

        return redirect()
            ->route(
                'jadwal-pelajaran.show',
                [
                    'tahun_ajaran' =>
                        $tahunAjaran,

                    'semester' =>
                        $semester,
                ]
            )
            ->with(
                'success',
                "Generate jadwal berhasil. "
                . "{$totalTerjadwal} JP berhasil "
                . "disimpan ke database dengan "
                . "CSP + Backtracking."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ERROR REDIRECT
    |--------------------------------------------------------------------------
    */

    private function generateError(
        string $tahunAjaran,
        string $semester,
        string $message
    ) {
        return redirect()
            ->route(
                'jadwal-pelajaran.show',
                [
                    'tahun_ajaran' =>
                        $tahunAjaran,

                    'semester' =>
                        $semester,
                ]
            )
            ->with(
                'error',
                $message
            );
    }


    /*
    |--------------------------------------------------------------------------
    | BACKTRACKING
    |--------------------------------------------------------------------------
    */

    private function backtrackBlockCSP(): bool
    {
        $this->cspNodes++;

        if (
            $this->cspNodes >
            $this->cspMaxNodes
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | CEK SELESAI
        |--------------------------------------------------------------------------
        */

        $selesai = true;

        foreach (
            $this->cspClassTarget as $classId => $target
        ) {

            $filled =
                $this->cspState[
                    'classFilled'
                ][$classId] ?? 0;

            if ($filled < $target) {

                $selesai = false;

                break;
            }
        }

        if ($selesai) {

            return $this->validateFinalSchedule();
        }


        /*
        |--------------------------------------------------------------------------
        | MRV
        |--------------------------------------------------------------------------
        |
        | Pilih kelas dengan kandidat paling sedikit.
        |
        */

        $selectedClassId = null;
        $selectedCandidates = [];
        $minimumCandidates = PHP_INT_MAX;

        foreach (
            $this->cspClassTarget as $classId => $target
        ) {

            $filled =
                $this->cspState[
                    'classFilled'
                ][$classId] ?? 0;

            if ($filled >= $target) {
                continue;
            }

            $candidates =
                $this->getBlockCandidates(
                    $classId
                );

            if (empty($candidates)) {
                return false;
            }

            $jumlahCandidates =
                count($candidates);

            if (
                $jumlahCandidates
                <
                $minimumCandidates
            ) {

                $minimumCandidates =
                    $jumlahCandidates;

                $selectedClassId =
                    $classId;

                $selectedCandidates =
                    $candidates;
            }
        }

        if (
            $selectedClassId === null
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | SORT SCORE
        |--------------------------------------------------------------------------
        */

        usort(
            $selectedCandidates,
            function ($a, $b) {

                return
                    $b['score']
                    <=>
                    $a['score'];
            }
        );


        /*
        |--------------------------------------------------------------------------
        | COBA CANDIDATE
        |--------------------------------------------------------------------------
        */

        foreach (
            $selectedCandidates as $candidate
        ) {

            $snapshot =
                $this->applyBlockCandidate(
                    $selectedClassId,
                    $candidate
                );

            if (
                $this->forwardCheck()
            ) {

                if (
                    $this->backtrackBlockCSP()
                ) {

                    return true;
                }
            }

            $this->undoBlockCandidate(
                $selectedClassId,
                $candidate,
                $snapshot
            );

            if (
                $this->cspNodes >
                $this->cspMaxNodes
            ) {

                return false;
            }
        }

        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | CARI BLOCK CANDIDATE
    |--------------------------------------------------------------------------
    */

    private function getBlockCandidates(
        int $classId,
        ?string $onlyDay = null,
        ?string $onlyMappingKey = null
    ): array {

        $candidates = [];

        $target =
            $this->cspClassTarget[
                $classId
            ] ?? 0;

        $filled =
            $this->cspState[
                'classFilled'
            ][$classId] ?? 0;

        $remainingClass =
            $target - $filled;

        if ($remainingClass <= 0) {
            return [];
        }


        /*
        |--------------------------------------------------------------------------
        | HARI
        |--------------------------------------------------------------------------
        */

        if ($onlyDay !== null) {

            $days = [
                strtolower(
                    trim($onlyDay)
                )
            ];

        } else {

            $days = array_keys(
                $this->cspDaySlots
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MAPPING
        |--------------------------------------------------------------------------
        */

        $mappingKeys =
            $this->cspClassMappings[
                $classId
            ] ?? [];

        if ($onlyMappingKey !== null) {

            $mappingKeys =
                array_values(
                    array_filter(
                        $mappingKeys,
                        fn ($key) =>
                            (string) $key
                            ===
                            (string) $onlyMappingKey
                    )
                );
        }


        /*
        |--------------------------------------------------------------------------
        | LOOP MAPPING
        |--------------------------------------------------------------------------
        */

        foreach (
            $mappingKeys as $mappingKey
        ) {

            if (
                !isset(
                    $this->cspMappings[
                        $mappingKey
                    ]
                )
            ) {
                continue;
            }

            $demand =
                $this->cspMappingDemand[
                    $mappingKey
                ] ?? 0;

            $scheduled =
                $this->cspState[
                    'mappingScheduled'
                ][$mappingKey] ?? 0;

            $remainingMapping =
                $demand - $scheduled;

            if ($remainingMapping <= 0) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | PANJANG BLOCK DINAMIS
            |--------------------------------------------------------------------------
            |
            | Maksimal 4 JP per block.
            |
            | 2 JP diprioritaskan.
            | 1 JP tetap tersedia.
            |
            */

            $possibleLengths = [];

            for (
                $length = 1;
                $length <= 4;
                $length++
            ) {

                if (
                    $length <= $remainingMapping
                    &&
                    $length <= $remainingClass
                ) {

                    $possibleLengths[] =
                        $length;
                }
            }

            if (empty($possibleLengths)) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | LOOP HARI
            |--------------------------------------------------------------------------
            */

            foreach ($days as $hari) {

                $daySlots =
                    $this->cspDaySlots[
                        $hari
                    ] ?? [];

                if (empty($daySlots)) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | MAPEL SUDAH ADA DI HARI
                |--------------------------------------------------------------------------
                */

                $existingIndices =
                    $this->getMapelIndicesOnDay(
                        $classId,
                        $mappingKey,
                        $hari
                    );


                /*
                | Jika mapel sudah ada,
                | hanya boleh memperpanjang block yang ada.
                */
                if (!empty($existingIndices)) {

                    $firstIndex =
                        min($existingIndices);

                    $lastIndex =
                        max($existingIndices);

                    /*
                    | Existing block harus contiguous.
                    */
                    if (
                        (
                            $lastIndex
                            -
                            $firstIndex
                            +
                            1
                        )
                        !==
                        count($existingIndices)
                    ) {

                        continue;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | EXTEND KE KIRI
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $possibleLengths as $length
                    ) {

                        $startIndex =
                            $firstIndex
                            -
                            $length;

                        if ($startIndex < 0) {
                            continue;
                        }

                        $blockSlotIds =
                            array_slice(
                                $daySlots,
                                $startIndex,
                                $length
                            );

                        if (
                            count($blockSlotIds)
                            !==
                            $length
                        ) {
                            continue;
                        }

                        if (
                            !$this->canPlaceBlock(
                                $classId,
                                $mappingKey,
                                $blockSlotIds
                            )
                        ) {
                            continue;
                        }

                        $candidates[] =
                            $this->makeCandidate(
                                $classId,
                                $mappingKey,
                                $blockSlotIds,
                                $length
                            );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | EXTEND KE KANAN
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $possibleLengths as $length
                    ) {

                        $startIndex =
                            $lastIndex + 1;

                        if (
                            $startIndex
                            >=
                            count($daySlots)
                        ) {
                            continue;
                        }

                        $blockSlotIds =
                            array_slice(
                                $daySlots,
                                $startIndex,
                                $length
                            );

                        if (
                            count($blockSlotIds)
                            !==
                            $length
                        ) {
                            continue;
                        }

                        if (
                            !$this->canPlaceBlock(
                                $classId,
                                $mappingKey,
                                $blockSlotIds
                            )
                        ) {
                            continue;
                        }

                        $candidates[] =
                            $this->makeCandidate(
                                $classId,
                                $mappingKey,
                                $blockSlotIds,
                                $length
                            );
                    }

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | MAPEL BELUM ADA DI HARI
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $possibleLengths as $length
                    ) {

                        for (
                            $startIndex = 0;
                            $startIndex < count($daySlots);
                            $startIndex++
                        ) {

                            if (
                                (
                                    $startIndex
                                    +
                                    $length
                                )
                                >
                                count($daySlots)
                            ) {
                                continue;
                            }

                            $blockSlotIds =
                                array_slice(
                                    $daySlots,
                                    $startIndex,
                                    $length
                                );

                            if (
                                count($blockSlotIds)
                                !==
                                $length
                            ) {
                                continue;
                            }

                            if (
                                !$this->canPlaceBlock(
                                    $classId,
                                    $mappingKey,
                                    $blockSlotIds
                                )
                            ) {
                                continue;
                            }

                            $candidates[] =
                                $this->makeCandidate(
                                    $classId,
                                    $mappingKey,
                                    $blockSlotIds,
                                    $length
                                );
                        }
                    }
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HILANGKAN DUPLIKAT
        |--------------------------------------------------------------------------
        */

        $unique = [];

        foreach ($candidates as $candidate) {

            $key =
                $candidate['mapping_key']
                . '|'
                . implode(
                    ',',
                    $candidate['slot_ids']
                );

            $unique[$key] =
                $candidate;
        }

        return array_values($unique);
    }


    /*
    |--------------------------------------------------------------------------
    | SCORE CANDIDATE
    |--------------------------------------------------------------------------
    |
    | Ini preference, BUKAN hard constraint.
    |
    | Prioritas:
    |
    | 1. Memenuhi hari yang belum terisi.
    | 2. 2 JP berurutan.
    | 3. Melanjutkan block mapel.
    | 4. Menyelesaikan kebutuhan mapping.
    | 5. Menghindari penumpukan di satu hari.
    | 6. Prioritas pagi jika tersedia.
    |
    */

    private function makeCandidate(
        int $classId,
        string $mappingKey,
        array $blockSlotIds,
        int $length
    ): array {

        $mapping =
            $this->cspMappings[
                $mappingKey
            ];

        $hari =
            $this->cspSlots[
                $blockSlotIds[0]
            ]['hari'];

        $dayFilled =
            $this->cspState[
                'classDays'
            ][$classId][$hari]
            ?? 0;

        $existingIndices =
            $this->getMapelIndicesOnDay(
                $classId,
                $mappingKey,
                $hari
            );

        $mapelAlreadyExists =
            !empty($existingIndices);

        $demand =
            $this->cspMappingDemand[
                $mappingKey
            ] ?? 0;

        $scheduled =
            $this->cspState[
                'mappingScheduled'
            ][$mappingKey] ?? 0;

        $remaining =
            $demand - $scheduled;

        $existingMappingDayLoad =
            $this->cspState[
                'mappingDays'
            ][$mappingKey][$hari]
            ?? 0;

        $score = 0;


        /*
        |--------------------------------------------------------------------------
        | 1. DISTRIBUSI BLOCK
        |--------------------------------------------------------------------------
        |
        | 2 JP = paling disukai.
        | 3 JP = masih bagus.
        | 4 JP = diperbolehkan.
        | 1 JP = cadangan.
        |
        */

        switch ($length) {

            case 2:
                $score += 50000;
                break;

            case 3:
                $score += 30000;
                break;

            case 4:
                $score += 20000;
                break;

            case 1:
                $score += 5000;
                break;
        }


        /*
        |--------------------------------------------------------------------------
        | 2. PREFERENSI 2 JP UNTUK MAPEL BESAR
        |--------------------------------------------------------------------------
        |
        | Untuk demand 4, 5, 6, dst.,
        | 2 JP menjadi pola utama.
        |
        */

        if (
            $demand >= 4
            &&
            $length === 2
            &&
            $existingMappingDayLoad === 0
        ) {

            $score += 15000;
        }


        /*
        |--------------------------------------------------------------------------
        | 3. 1 JP TIDAK DILARANG
        |--------------------------------------------------------------------------
        |
        | Hanya diberi penalti supaya dicoba belakangan.
        |
        */

        if ($length === 1) {

            $score -= 15000;
        }


        /*
        |--------------------------------------------------------------------------
        | 4. MENYELESAIKAN KEBUTUHAN MAPPING
        |--------------------------------------------------------------------------
        */

        if (
            $length === $remaining
        ) {

            $score += 10000;
        }


        /*
        |--------------------------------------------------------------------------
        | 5. SETIAP HARI DIUSAHAKAN TERISI
        |--------------------------------------------------------------------------
        */

        if ($dayFilled === 0) {

            $score += 80000;
        }


        /*
        |--------------------------------------------------------------------------
        | 6. JANGAN TERLALU MENUMPUK DI SATU HARI
        |--------------------------------------------------------------------------
        */

        $score -=
            $dayFilled * 3500;


        /*
        |--------------------------------------------------------------------------
        | 7. MELANJUTKAN BLOCK YANG SUDAH ADA
        |--------------------------------------------------------------------------
        */

        if ($mapelAlreadyExists) {

            $score += 25000;
        }


        /*
        |--------------------------------------------------------------------------
        | 8. JIKA SUDAH ADA 2 JP DI HARI INI
        |--------------------------------------------------------------------------
        |
        | Masih boleh ditambah sampai maksimal 4 JP.
        |
        */

        if (
            $existingMappingDayLoad === 2
            &&
            $length === 2
        ) {

            $score += 10000;
        }


        /*
        |--------------------------------------------------------------------------
        | 9. JANGAN TERLALU CEPAT MEMBUAT
        |    MAPEL BESAR MENUMPUK DI HARI SAMA
        |--------------------------------------------------------------------------
        */

        if (
            $demand >= 4
            &&
            $existingMappingDayLoad > 0
            &&
            !$mapelAlreadyExists
        ) {

            $score -=
                $existingMappingDayLoad * 8000;
        }


        /*
        |--------------------------------------------------------------------------
        | 10. PRIORITAS JAM PAGI
        |--------------------------------------------------------------------------
        */

        $prioritasPagi = false;

        if (
            isset(
                $mapping->is_prioritas_pagi
            )
        ) {

            $prioritasPagi =
                (bool)
                $mapping->is_prioritas_pagi;

        } elseif (
            isset(
                $mapping->prioritas_pagi
            )
        ) {

            $prioritasPagi =
                (bool)
                $mapping->prioritas_pagi;

        } elseif (
            $mapping->mataPelajaran
            &&
            isset(
                $mapping->mataPelajaran
                    ->prioritas_jam_pagi
            )
        ) {

            $prioritasPagi =
                (bool)
                $mapping->mataPelajaran
                    ->prioritas_jam_pagi;
        }

        if ($prioritasPagi) {

            $startUrutan =
                (int)
                $this->cspSlots[
                    $blockSlotIds[0]
                ]['urutan'];

            if ($startUrutan <= 3) {

                $score += 12000;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | 11. HARI LEBIH AWAL SEBAGAI TIE BREAKER
        |--------------------------------------------------------------------------
        */

        $score -=
            $this->cspDayOrder[
                $hari
            ] ?? 99;


        return [
            'mapping_key' =>
                $mappingKey,

            'slot_ids' =>
                $blockSlotIds,

            'length' =>
                $length,

            'hari' =>
                $hari,

            'score' =>
                $score,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | CEK BLOCK
    |--------------------------------------------------------------------------
    */

    private function canPlaceBlock(
        int $classId,
        string $mappingKey,
        array $blockSlotIds
    ): bool {

        if (empty($blockSlotIds)) {
            return false;
        }

        if (
            !isset(
                $this->cspMappings[
                    $mappingKey
                ]
            )
        ) {
            return false;
        }

        /*
        | Maksimal satu block = 4 JP.
        */
        if (
            count($blockSlotIds) > 4
        ) {
            return false;
        }

        $mapping =
            $this->cspMappings[
                $mappingKey
            ];

        $guruId =
            (int) $mapping->guru_id;

        $hari =
            $this->cspSlots[
                $blockSlotIds[0]
            ]['hari'];


        /*
        |--------------------------------------------------------------------------
        | CEK SETIAP SLOT
        |--------------------------------------------------------------------------
        */

        foreach (
            $blockSlotIds as $slotId
        ) {

            if (
                !isset(
                    $this->cspSlots[
                        $slotId
                    ]
                )
            ) {
                return false;
            }

            /*
            | Semua slot block harus berada
            | pada hari yang sama.
            */
            if (
                $this->cspSlots[
                    $slotId
                ]['hari']
                !==
                $hari
            ) {
                return false;
            }


            /*
            | KELAS BENTROK
            */
            if (
                isset(
                    $this->cspState[
                        'classAssignments'
                    ][$classId][$slotId]
                )
            ) {
                return false;
            }


            /*
            | GURU BENTROK
            */
            if (
                isset(
                    $this->cspState[
                        'teacherBusy'
                    ][$guruId][$slotId]
                )
            ) {
                return false;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CEK MAPEL SPLIT
        |--------------------------------------------------------------------------
        */

        if (
            !$this->isValidSubjectBlock(
                $classId,
                $mappingKey,
                $blockSlotIds
            )
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | MAKSIMAL 4 JP MAPEL PER HARI
        |--------------------------------------------------------------------------
        |
        | Ini bukan total kebutuhan mapel.
        | Hanya membatasi jumlah mapel yang sama
        | dalam satu hari.
        |
        */

        if (
            !$this->isValidDailyMappingLoad(
                $mappingKey,
                $blockSlotIds
            )
        ) {
            return false;
        }

        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | CEK MAPEL TIDAK SPLIT
    |--------------------------------------------------------------------------
    |
    | Valid:
    |
    | A - A - A
    | A - A - BREAK - A
    |
    | Tidak valid:
    |
    | A - B - A
    | A - kosong - A
    |
    | BREAK dan TERKUNCI tidak berada dalam domain CSP,
    | sehingga tidak dianggap sebagai pemisah.
    |
    */

    private function isValidSubjectBlock(
        int $classId,
        string $mappingKey,
        array $blockSlotIds
    ): bool {

        if (empty($blockSlotIds)) {
            return false;
        }

        $mapping =
            $this->cspMappings[
                $mappingKey
            ];

        $mataPelajaranId =
            (int)
            $mapping->mata_pelajaran_id;

        $hari =
            $this->cspSlots[
                $blockSlotIds[0]
            ]['hari'];

        $simulasi = [];


        /*
        |--------------------------------------------------------------------------
        | AMBIL ASSIGNMENT EXISTING
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspState[
                'classAssignments'
            ][$classId] ?? []
            as $slotId => $existingMappingKey
        ) {

            if (
                !isset(
                    $this->cspSlots[
                        $slotId
                    ]
                )
            ) {
                continue;
            }

            if (
                $this->cspSlots[
                    $slotId
                ]['hari']
                !==
                $hari
            ) {
                continue;
            }

            if (
                !isset(
                    $this->cspMappings[
                        $existingMappingKey
                    ]
                )
            ) {
                continue;
            }

            $existingMapping =
                $this->cspMappings[
                    $existingMappingKey
                ];

            $simulasi[
                $slotId
            ] =
                (int)
                $existingMapping
                    ->mata_pelajaran_id;
        }


        /*
        |--------------------------------------------------------------------------
        | TAMBAHKAN CANDIDATE
        |--------------------------------------------------------------------------
        */

        foreach (
            $blockSlotIds as $slotId
        ) {

            $simulasi[
                $slotId
            ] =
                $mataPelajaranId;
        }


        /*
        |--------------------------------------------------------------------------
        | URUTKAN SLOT BERDASARKAN URUTAN
        |--------------------------------------------------------------------------
        */

        uksort(
            $simulasi,
            function ($a, $b) {

                return
                    (
                        $this->cspSlots[
                            $a
                        ]['urutan']
                    )
                    <=>
                    (
                        $this->cspSlots[
                            $b
                        ]['urutan']
                    );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | CEK A-B-A
        |--------------------------------------------------------------------------
        */

        $lastMapel = null;
        $finishedMapel = [];

        foreach (
            $simulasi as $mapelId
        ) {

            /*
            | Mapel sama masih merupakan
            | block yang sama.
            */
            if (
                $lastMapel === $mapelId
            ) {
                continue;
            }

            /*
            | Mapel sebelumnya selesai.
            */
            if (
                $lastMapel !== null
            ) {

                $finishedMapel[
                    $lastMapel
                ] = true;
            }

            /*
            | Kalau mapel pernah selesai lalu
            | muncul kembali, berarti split.
            */
            if (
                isset(
                    $finishedMapel[
                        $mapelId
                    ]
                )
            ) {

                return false;
            }

            $lastMapel =
                $mapelId;
        }

        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | CARI INDEX MAPEL PADA HARI
    |--------------------------------------------------------------------------
    */

    private function getMapelIndicesOnDay(
        int $classId,
        string $mappingKey,
        string $hari
    ): array {

        if (
            !isset(
                $this->cspMappings[
                    $mappingKey
                ]
            )
        ) {
            return [];
        }

        $targetMapelId =
            (int)
            $this->cspMappings[
                $mappingKey
            ]->mata_pelajaran_id;

        $daySlots =
            $this->cspDaySlots[
                $hari
            ] ?? [];

        $indices = [];

        foreach (
            $daySlots as $index => $slotId
        ) {

            if (
                !isset(
                    $this->cspState[
                        'classAssignments'
                    ][$classId][$slotId]
                )
            ) {
                continue;
            }

            $existingMappingKey =
                $this->cspState[
                    'classAssignments'
                ][$classId][$slotId];

            if (
                !isset(
                    $this->cspMappings[
                        $existingMappingKey
                    ]
                )
            ) {
                continue;
            }

            $existingMapelId =
                (int)
                $this->cspMappings[
                    $existingMappingKey
                ]->mata_pelajaran_id;

            if (
                $existingMapelId
                ===
                $targetMapelId
            ) {

                $indices[] =
                    $index;
            }
        }

        return $indices;
    }


    /*
    |--------------------------------------------------------------------------
    | BEBAN MAPEL PER HARI
    |--------------------------------------------------------------------------
    |
    | Maksimal 4 JP mapel yang sama dalam satu hari.
    |
    */

    private function isValidDailyMappingLoad(
        string $mappingKey,
        array $blockSlotIds
    ): bool {

        if (empty($blockSlotIds)) {
            return false;
        }

        $hari =
            $this->cspSlots[
                $blockSlotIds[0]
            ]['hari'];

        $existing =
            $this->cspState[
                'mappingDays'
            ][$mappingKey][$hari]
            ?? 0;

        $newLoad =
            $existing
            +
            count($blockSlotIds);

        return $newLoad <= 4;
    }


    /*
    |--------------------------------------------------------------------------
    | APPLY
    |--------------------------------------------------------------------------
    */

    private function applyBlockCandidate(
        int $classId,
        array $candidate
    ): array {

        $mappingKey =
            $candidate['mapping_key'];

        $mapping =
            $this->cspMappings[
                $mappingKey
            ];

        $guruId =
            (int) $mapping->guru_id;

        $slotIds =
            $candidate['slot_ids'];

        $snapshot = [
            'classDays' =>
                $this->cspState[
                    'classDays'
                ][$classId] ?? [],

            'mappingDays' =>
                $this->cspState[
                    'mappingDays'
                ][$mappingKey] ?? [],
        ];


        foreach (
            $slotIds as $slotId
        ) {

            $hari =
                $this->cspSlots[
                    $slotId
                ]['hari'];

            $this->cspState[
                'classAssignments'
            ][$classId][$slotId]
                =
                $mappingKey;

            $this->cspState[
                'teacherBusy'
            ][$guruId][$slotId]
                =
                true;


            /*
            | Beban kelas per hari.
            */
            if (
                !isset(
                    $this->cspState[
                        'classDays'
                    ][$classId][$hari]
                )
            ) {

                $this->cspState[
                    'classDays'
                ][$classId][$hari]
                    =
                    0;
            }

            $this->cspState[
                'classDays'
            ][$classId][$hari]++;


            /*
            | Beban mapping per hari.
            */
            if (
                !isset(
                    $this->cspState[
                        'mappingDays'
                    ][$mappingKey][$hari]
                )
            ) {

                $this->cspState[
                    'mappingDays'
                ][$mappingKey][$hari]
                    =
                    0;
            }

            $this->cspState[
                'mappingDays'
            ][$mappingKey][$hari]++;
        }


        $jumlah =
            count($slotIds);

        $this->cspState[
            'mappingScheduled'
        ][$mappingKey]
            +=
            $jumlah;

        $this->cspState[
            'teacherScheduled'
        ][$guruId]
            +=
            $jumlah;

        $this->cspState[
            'classFilled'
        ][$classId]
            +=
            $jumlah;


        return $snapshot;
    }


    /*
    |--------------------------------------------------------------------------
    | UNDO
    |--------------------------------------------------------------------------
    */

    private function undoBlockCandidate(
        int $classId,
        array $candidate,
        array $snapshot
    ): void {

        $mappingKey =
            $candidate['mapping_key'];

        $mapping =
            $this->cspMappings[
                $mappingKey
            ];

        $guruId =
            (int) $mapping->guru_id;

        $slotIds =
            $candidate['slot_ids'];


        foreach (
            $slotIds as $slotId
        ) {

            $hari =
                $this->cspSlots[
                    $slotId
                ]['hari'];


            unset(
                $this->cspState[
                    'classAssignments'
                ][$classId][$slotId]
            );

            unset(
                $this->cspState[
                    'teacherBusy'
                ][$guruId][$slotId]
            );


            /*
            | Kurangi beban kelas.
            */
            if (
                isset(
                    $this->cspState[
                        'classDays'
                    ][$classId][$hari]
                )
            ) {

                $this->cspState[
                    'classDays'
                ][$classId][$hari]--;

                if (
                    $this->cspState[
                        'classDays'
                    ][$classId][$hari]
                    <= 0
                ) {

                    unset(
                        $this->cspState[
                            'classDays'
                        ][$classId][$hari]
                    );
                }
            }


            /*
            | Kurangi beban mapping.
            */
            if (
                isset(
                    $this->cspState[
                        'mappingDays'
                    ][$mappingKey][$hari]
                )
            ) {

                $this->cspState[
                    'mappingDays'
                ][$mappingKey][$hari]--;

                if (
                    $this->cspState[
                        'mappingDays'
                    ][$mappingKey][$hari]
                    <= 0
                ) {

                    unset(
                        $this->cspState[
                            'mappingDays'
                        ][$mappingKey][$hari]
                    );
                }
            }
        }


        $jumlah =
            count($slotIds);

        $this->cspState[
            'mappingScheduled'
        ][$mappingKey]
            -=
            $jumlah;

        $this->cspState[
            'teacherScheduled'
        ][$guruId]
            -=
            $jumlah;

        $this->cspState[
            'classFilled'
        ][$classId]
            -=
            $jumlah;


        /*
        | Kembalikan snapshot.
        */
        $this->cspState[
            'classDays'
        ][$classId]
            =
            $snapshot['classDays'];

        $this->cspState[
            'mappingDays'
        ][$mappingKey]
            =
            $snapshot['mappingDays'];
    }


    /*
    |--------------------------------------------------------------------------
    | FORWARD CHECKING
    |--------------------------------------------------------------------------
    */

    private function forwardCheck(): bool
    {
        /*
        |--------------------------------------------------------------------------
        | CEK KELAS
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspClassTarget as $classId => $target
        ) {

            $filled =
                $this->cspState[
                    'classFilled'
                ][$classId] ?? 0;

            $remaining =
                $target - $filled;

            /*
            | Kalau sudah penuh,
            | semua hari wajib harus terpenuhi.
            */
            if ($remaining <= 0) {

                if (
                    !$this->hasAllRequiredDays(
                        $classId
                    )
                ) {
                    return false;
                }

                continue;
            }


            /*
            | Sisa JP minimal harus cukup
            | untuk mengisi hari yang belum ada.
            */
            $missingDays =
                $this->getMissingDays(
                    $classId
                );

            if (
                $remaining
                <
                count($missingDays)
            ) {
                return false;
            }


            /*
            | Hitung slot kelas yang masih kosong.
            */
            $availableClassSlots = 0;

            foreach (
                $this->cspSlots as $slotId => $slot
            ) {

                if (
                    isset(
                        $this->cspState[
                            'classAssignments'
                        ][$classId][$slotId]
                    )
                ) {
                    continue;
                }

                $availableClassSlots++;
            }

            if (
                $availableClassSlots
                <
                $remaining
            ) {
                return false;
            }


            /*
            | Setiap hari kosong harus memiliki
            | setidaknya satu candidate.
            */
            foreach (
                $missingDays as $hari
            ) {

                $dayCandidates =
                    $this->getBlockCandidates(
                        $classId,
                        $hari
                    );

                if (
                    empty($dayCandidates)
                ) {
                    return false;
                }
            }


            /*
            | Setiap mapping yang belum selesai
            | harus masih memiliki candidate.
            */
            foreach (
                $this->cspClassMappings[
                    $classId
                ] ?? [] as $mappingKey
            ) {

                $demand =
                    $this->cspMappingDemand[
                        $mappingKey
                    ] ?? 0;

                $scheduled =
                    $this->cspState[
                        'mappingScheduled'
                    ][$mappingKey] ?? 0;

                $remainingMapping =
                    $demand - $scheduled;

                if (
                    $remainingMapping <= 0
                ) {
                    continue;
                }

                $mappingCandidates =
                    $this->getBlockCandidates(
                        $classId,
                        null,
                        $mappingKey
                    );

                if (
                    empty($mappingCandidates)
                ) {
                    return false;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CEK GURU
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspTotalTeacherDemand
            as $guruId => $demand
        ) {

            $scheduled =
                $this->cspState[
                    'teacherScheduled'
                ][$guruId] ?? 0;

            $remainingDemand =
                $demand - $scheduled;

            if (
                $remainingDemand <= 0
            ) {
                continue;
            }

            /*
            | Hitung slot yang secara umum
            | masih tersedia untuk guru.
            */
            $availableSlots = 0;

            foreach (
                $this->cspSlots
                as $slotId => $slot
            ) {

                if (
                    isset(
                        $this->cspState[
                            'teacherBusy'
                        ][$guruId][$slotId]
                    )
                ) {
                    continue;
                }

                $availableSlots++;
            }

            if (
                $availableSlots
                <
                $remainingDemand
            ) {
                return false;
            }
        }


        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | MISSING DAYS
    |--------------------------------------------------------------------------
    */

    private function getMissingDays(
        int $classId
    ): array {

        $missing = [];

        foreach (
            array_keys(
                $this->cspDayOrder
            ) as $hari
        ) {

            $jumlah =
                $this->cspState[
                    'classDays'
                ][$classId][$hari]
                ?? 0;

            if ($jumlah <= 0) {

                $missing[] =
                    $hari;
            }
        }

        return $missing;
    }


    /*
    |--------------------------------------------------------------------------
    | CEK SEMUA HARI WAJIB
    |--------------------------------------------------------------------------
    */

    private function hasAllRequiredDays(
        int $classId
    ): bool {

        return empty(
            $this->getMissingDays(
                $classId
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDASI FINAL
    |--------------------------------------------------------------------------
    */

    private function validateFinalSchedule(): bool
    {
        /*
        |--------------------------------------------------------------------------
        | CLASS
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspClassTarget as $classId => $target
        ) {

            $filled =
                $this->cspState[
                    'classFilled'
                ][$classId] ?? 0;

            /*
            | Total JP kelas harus tepat.
            */
            if (
                $filled
                !==
                $target
            ) {
                return false;
            }

            /*
            | Semua hari wajib harus terisi.
            */
            if (
                !$this->hasAllRequiredDays(
                    $classId
                )
            ) {
                return false;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | MAPPING
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspMappingDemand
            as $mappingKey => $demand
        ) {

            $scheduled =
                $this->cspState[
                    'mappingScheduled'
                ][$mappingKey] ?? 0;

            /*
            | Setiap mapping harus tepat jumlah_jp.
            */
            if (
                $scheduled
                !==
                $demand
            ) {
                return false;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | GURU
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspTotalTeacherDemand
            as $guruId => $demand
        ) {

            $scheduled =
                $this->cspState[
                    'teacherScheduled'
                ][$guruId] ?? 0;

            if (
                $scheduled
                !==
                $demand
            ) {
                return false;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | GURU DOUBLE BOOKING
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspState[
                'teacherBusy'
            ] as $guruId => $slots
        ) {

            $slotKeys =
                array_keys($slots);

            if (
                count($slotKeys)
                !==
                count(
                    array_unique(
                        $slotKeys
                    )
                )
            ) {
                return false;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CLASS DOUBLE BOOKING
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspState[
                'classAssignments'
            ] as $classId => $slots
        ) {

            $slotKeys =
                array_keys($slots);

            if (
                count($slotKeys)
                !==
                count(
                    array_unique(
                        $slotKeys
                    )
                )
            ) {
                return false;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | MAPEL SPLIT
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspClassTarget
            as $classId => $target
        ) {

            if (
                !$this->validateNoSubjectSplit(
                    $classId
                )
            ) {
                return false;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | MAXIMAL 4 JP PER BLOCK
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->cspClassTarget
            as $classId => $target
        ) {

            if (
                !$this->validateMaxSubjectBlock(
                    $classId
                )
            ) {
                return false;
            }
        }


        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDASI A-B-A
    |--------------------------------------------------------------------------
    */

    private function validateNoSubjectSplit(
        int $classId
    ): bool {

        foreach (
            $this->cspDaySlots
            as $hari => $slotIds
        ) {

            $lastMapel = null;
            $finishedMapel = [];

            foreach (
                $slotIds as $slotId
            ) {

                /*
                | JP kosong menjadi pemutus block.
                */
                if (
                    !isset(
                        $this->cspState[
                            'classAssignments'
                        ][$classId][$slotId]
                    )
                ) {

                    if (
                        $lastMapel !== null
                    ) {

                        $finishedMapel[
                            $lastMapel
                        ] = true;

                        $lastMapel = null;
                    }

                    continue;
                }

                $mappingKey =
                    $this->cspState[
                        'classAssignments'
                    ][$classId][$slotId];

                if (
                    !isset(
                        $this->cspMappings[
                            $mappingKey
                        ]
                    )
                ) {
                    continue;
                }

                $mapelId =
                    (int)
                    $this->cspMappings[
                        $mappingKey
                    ]->mata_pelajaran_id;


                /*
                | Mapel sama = block yang sama.
                */
                if (
                    $lastMapel
                    ===
                    $mapelId
                ) {
                    continue;
                }


                /*
                | Mapel sebelumnya selesai.
                */
                if (
                    $lastMapel !== null
                ) {

                    $finishedMapel[
                        $lastMapel
                    ] = true;
                }


                /*
                | Mapel muncul lagi setelah mapel lain.
                */
                if (
                    isset(
                        $finishedMapel[
                            $mapelId
                        ]
                    )
                ) {

                    return false;
                }

                $lastMapel =
                    $mapelId;
            }
        }

        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDASI MAKSIMAL 4 JP PER BLOCK
    |--------------------------------------------------------------------------
    */

    private function validateMaxSubjectBlock(
        int $classId
    ): bool {

        foreach (
            $this->cspDaySlots
            as $hari => $slotIds
        ) {

            $lastMapel = null;
            $blockLength = 0;

            foreach (
                $slotIds as $slotId
            ) {

                /*
                | JP kosong = block selesai.
                */
                if (
                    !isset(
                        $this->cspState[
                            'classAssignments'
                        ][$classId][$slotId]
                    )
                ) {

                    $lastMapel = null;
                    $blockLength = 0;

                    continue;
                }

                $mappingKey =
                    $this->cspState[
                        'classAssignments'
                    ][$classId][$slotId];

                if (
                    !isset(
                        $this->cspMappings[
                            $mappingKey
                        ]
                    )
                ) {
                    continue;
                }

                $mapelId =
                    (int)
                    $this->cspMappings[
                        $mappingKey
                    ]->mata_pelajaran_id;


                if (
                    $lastMapel
                    ===
                    $mapelId
                ) {

                    $blockLength++;

                } else {

                    $lastMapel =
                        $mapelId;

                    $blockLength = 1;
                }


                /*
                | Maksimal satu block = 4 JP.
                */
                if (
                    $blockLength > 4
                ) {
                    return false;
                }
            }
        }

        return true;
    }
}