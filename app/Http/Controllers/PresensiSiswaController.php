<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\PresensiSiswa;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PresensiSiswaController extends Controller
{
    /**
     * Mengambil jadwal yang dimiliki guru yang sedang login.
     */
    private function jadwalGuru(int $jadwalId): JadwalPelajaran
    {
        $guru = Guru::where(
            'user_id',
            Auth::user()->getAuthIdentifier()
        )->firstOrFail();

        return JadwalPelajaran::with([
            'kelas',
            'mataPelajaran',
            'slotWaktu',
        ])
            ->where('guru_id', $guru->id)
            ->where('id', $jadwalId)
            ->firstOrFail();
    }

    /**
     * Menampilkan daftar dan riwayat presensi siswa.
     */
    public function index(Request $request)
    {
        // Ambil data guru yang sedang login.
        $guru = Guru::where(
            'user_id',
            Auth::user()->getAuthIdentifier()
        )->firstOrFail();

        // Daftar kelas untuk filter.
        $daftarKelas = Kelas::orderBy('nama_kelas')->get();

        // Query catatan presensi milik jadwal guru yang login.
        $query = PresensiSiswa::with([
            'siswa.kelas',
            'jadwalPelajaran.mataPelajaran',
        ])->whereHas('jadwalPelajaran', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        });

        // Filter berdasarkan nama siswa.
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kelas.
        if ($request->filled('kelas_id')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('kelas_id', $request->input('kelas_id'));
            });
        }

        // Filter berdasarkan tanggal presensi.
        if ($request->filled('tanggal')) {
            $request->validate([
                'tanggal' => ['date'],
            ]);

            $query->whereDate(
                'tanggal',
                $request->input('tanggal')
            );
        }

        // Statistik dihitung berdasarkan hasil filter sebelum pagination.
        $totalCatatan = (clone $query)->count();

        $jumlahHadir = (clone $query)
            ->where('status', 'Hadir')
            ->count();

        $jumlahIzinSakit = (clone $query)
            ->whereIn('status', ['Izin', 'Sakit'])
            ->count();

        $jumlahAlfa = (clone $query)
            ->where('status', 'Alfa')
            ->count();

        // Urutkan data terbaru dan tampilkan 10 catatan per halaman.
        $listPresensiSiswa = $query
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('presensi.presensi-siswa-index', compact(
            'daftarKelas',
            'listPresensiSiswa',
            'totalCatatan',
            'jumlahHadir',
            'jumlahIzinSakit',
            'jumlahAlfa'
        ));
    }

    /**
     * Menampilkan form presensi siswa berdasarkan jadwal.
     */
    public function create(Request $request, int $jadwalId)
    {
        $request->validate([
            'tanggal' => ['nullable', 'date'],
        ]);

        $jadwal = $this->jadwalGuru($jadwalId);

        $tanggal = $request->input(
            'tanggal',
            now()->toDateString()
        );

        // Ambil siswa sesuai kelas pada jadwal mengajar.
        $siswas = Siswa::where(
            'kelas_id',
            $jadwal->kelas_id
        )
            ->orderBy('nama')
            ->get();

        // Ambil presensi yang sudah tersimpan pada tanggal tersebut.
        $presensiLama = PresensiSiswa::where(
            'jadwal_pelajaran_id',
            $jadwal->id
        )
            ->whereDate('tanggal', $tanggal)
            ->get()
            ->keyBy('siswa_id');

        return view('presensi.presensi-siswa', compact(
            'jadwal',
            'tanggal',
            'siswas',
            'presensiLama'
        ));
    }

    /**
     * Menyimpan atau memperbarui presensi siswa.
     */
    public function store(Request $request, int $jadwalId)
    {
        $jadwal = $this->jadwalGuru($jadwalId);

        $validated = $request->validate([
            'tanggal' => ['required', 'date'],

            'presensi' => ['required', 'array', 'min:1'],

            'presensi.*' => [
                'required',
                Rule::in(['Hadir', 'Izin', 'Sakit', 'Alfa']),
            ],
        ]);

        // Siswa yang boleh diabsen hanya siswa dari kelas jadwal ini.
        $siswas = Siswa::where(
            'kelas_id',
            $jadwal->kelas_id
        )->get();

        if ($siswas->isEmpty()) {
            return back()
                ->withInput()
                ->withErrors([
                    'presensi' => 'Belum ada siswa terdaftar di kelas ini.',
                ]);
        }

        // Pastikan semua siswa kelas memiliki status kehadiran.
        foreach ($siswas as $siswa) {
            if (!array_key_exists(
                $siswa->id,
                $validated['presensi']
            )) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'presensi' => 'Status kehadiran semua siswa harus diisi.',
                    ]);
            }
        }

        // Simpan seluruh presensi dalam satu transaksi database.
        DB::transaction(function () use (
            $siswas,
            $validated,
            $jadwal
        ) {
            foreach ($siswas as $siswa) {
                PresensiSiswa::updateOrCreate(
                    [
                        'jadwal_pelajaran_id' => $jadwal->id,
                        'siswa_id' => $siswa->id,
                        'tanggal' => $validated['tanggal'],
                    ],
                    [
                        'status' => $validated['presensi'][$siswa->id],
                    ]
                );
            }
        });

        return redirect()->route(
            'guru.presensi-siswa.create',
            [
                'jadwalId' => $jadwal->id,
                'tanggal' => $validated['tanggal'],
            ]
        )->with(
            'success',
            'Presensi siswa berhasil disimpan.'
        );
    }

    /**
     * Menampilkan halaman edit presensi siswa.
     */
    public function edit(int $presensiId)
    {
        $presensi = PresensiSiswa::with(['siswa.kelas'])
            ->findOrFail($presensiId);

        return view(
            'presensi.edit-presensi-siswa',
            compact('presensi')
        );
    }

    /**
     * Memperbarui data presensi siswa.
     */
    public function update(Request $request, int $presensiId)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'status' => [
                'required',
                Rule::in(['Hadir', 'Izin', 'Sakit', 'Alfa']),
            ],
        ]);

        $presensi = PresensiSiswa::findOrFail($presensiId);

        $presensi->tanggal = $validated['tanggal'];
        $presensi->status = $validated['status'];
        $presensi->save();

        return redirect()->route('presensi.rekap', [
            'tab' => 'siswa',
            'bulan' => date('m', strtotime($presensi->tanggal)),
            'tahun' => date('Y', strtotime($presensi->tanggal)),
        ])->with(
            'success',
            'Presensi siswa berhasil diperbarui.'
        );
    }
}
