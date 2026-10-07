<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Menampilkan halaman awal menu siswa (berisi daftar pilihan kelas).
     */
    public function index()
    {
        $kelas = Kelas::withCount('siswa')->orderBy('tingkat', 'asc')->orderBy('nama_kelas', 'asc')->get(); 
        
        return view('siswa.index', [
            'kelas' => $kelas,
            'selectedKelas' => null,
            'siswaList' => null
        ]);
    }

    /**
     * Menampilkan daftar siswa berdasarkan kelas yang diklik.
     */
    public function indexByKelas($id_kelas)
    {
        $selectedKelas = Kelas::findOrFail($id_kelas);
        $siswaList = Siswa::where('kelas_id', $id_kelas)->get(); 
        $kelas = Kelas::withCount('siswa')->orderBy('tingkat', 'asc')->orderBy('nama_kelas', 'asc')->get();

        return view('siswa.index', compact('kelas', 'selectedKelas', 'siswaList'));
    }

    public function create(Request $request)
    {
        $kelasList = Kelas::orderBy('tingkat', 'asc')->orderBy('nama_kelas', 'asc')->get();
        $selectedKelasId = $request->query('kelas_id');
        
        return view('siswa.create', compact('kelasList', 'selectedKelasId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|unique:siswa,nis',
            'kelas_id' => 'required'
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.by-kelas', $request->kelas_id)->with('success', 'Data siswa berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit data siswa.
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelasList = Kelas::orderBy('tingkat', 'asc')->orderBy('nama_kelas', 'asc')->get();

        return view('siswa.edit', compact('siswa', 'kelasList'));
    }

    /**
     * Memperbarui data siswa di database.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|unique:siswa,nis,' . $id . ',id',
            'kelas_id' => 'required'
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.by-kelas', $siswa->kelas_id)->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelasId = $siswa->kelas_id;
        $siswa->delete();

        return redirect()->route('siswa.by-kelas', $kelasId)->with('success', 'Data siswa berhasil dihapus!');
    }

    /**
     * Menampilkan form halaman import Excel berdasarkan ID kelas.
     */
    public function import($id)
    {
        $kelas = Kelas::findOrFail($id); 
        
        return view('siswa.import', compact('kelas'));
    }

    /**
     * Memproses file Excel/CSV yang di-upload ke kelas tertentu.
     */
    public function storeImport(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls',
        ]);

        $kelas = Kelas::findOrFail($id);
        $file = $request->file('file');

        $kelasIdKey = $kelas->id ?? $kelas->id_kelas;
        $namaKelas = $kelas->nama_kelas ?? ($kelas->nama ?? 'Kelas');

        if (($handle = fopen($file->getRealPath(), 'r')) !== FALSE) {
            
            $header = fgetcsv($handle, 1000, ',');

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if (empty(array_filter($data))) {
                    continue;
                }

                $nis = $data[0] ?? null;
                $nama = $data[1] ?? null;
                $rawGender = trim($data[2] ?? '');
                $status = $data[3] ?? 'Aktif';

                $jenisKelamin = null;
                $lowerGender = strtolower($rawGender);
                if (in_array($lowerGender, ['l', 'laki-laki', 'laki laki', 'male'])) {
                    $jenisKelamin = 'L';
                } elseif (in_array($lowerGender, ['p', 'perempuan', 'female'])) {
                    $jenisKelamin = 'P';
                }

                if ($nis && $nama && $jenisKelamin) {
                    \App\Models\Siswa::query()->from('siswa')->updateOrCreate(
                        ['nis' => $nis],
                        [
                            'nama' => $nama,
                            'jenis_kelamin' => $jenisKelamin,
                            'status' => $status,
                            'kelas_id' => $kelasIdKey
                        ]
                    );
                }
            }
            fclose($handle);
        }

        return redirect()->route('siswa.by-kelas', $kelasIdKey)->with('success', 'Data siswa berhasil diimport ke kelas ' . $namaKelas . '!');
    }

    /**
     * Download Template CSV untuk Import.
     */
    public function downloadTemplate()
    {
        $fileName = "template_import_siswa.csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['nis', 'nama', 'jenis_kelamin', 'status'];

        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, ['12345', 'Contoh Nama Siswa', 'L', 'Aktif']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Menampilkan halaman manajemen kenaikan kelas.
     */
    public function naikKelasIndex(Request $request)
    {
        $kelasList = Kelas::orderBy('tingkat', 'asc')->orderBy('nama_kelas', 'asc')->get();
        $selectedKelasId = $request->get('kelas_id');
        $siswaList = [];
        $listKelasTujuan = collect();

        if ($selectedKelasId) {
            $siswaList = Siswa::where('kelas_id', $selectedKelasId)->get();
            $kelasAsal = Kelas::find($selectedKelasId);

            if ($kelasAsal) {
                // Tentukan tingkat tujuan berdasarkan tingkat kelas asal
                $tingkatTujuan = $kelasAsal->tingkat + 1;
                
                // Ambil hanya kelas yang tingkatnya di atas kelas asal dengan urutan tingkat & nama kelas
                $listKelasTujuan = Kelas::where('tingkat', $tingkatTujuan)
                                        ->orderBy('tingkat', 'asc')
                                        ->orderBy('nama_kelas', 'asc')
                                        ->get();
            }
        }

        return view('siswa.naik-kelas', compact('kelasList', 'selectedKelasId', 'siswaList', 'listKelasTujuan'));
    }

    /**
     * Memproses siswa yang naik kelas secara massal
     */
    public function prosesNaikKelas(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'kelas_tujuan_id' => 'required',
        ]);

        $kelasTujuanId = $request->kelas_tujuan_id;

        foreach ($request->siswa_ids as $siswaId) {
            $siswa = Siswa::with('kelas')->find($siswaId);

            if ($kelasTujuanId === 'lulus') {
                // Pastikan hanya kelas 9 yang bisa lulus
                if ($siswa->kelas && $siswa->kelas->tingkat != 9) {
                    return back()->with('error', 'Hanya siswa tingkat 9 yang dapat diluluskan!');
                }
                $siswa->update(['status' => 'Alumni', 'kelas_id' => null]);
            } else {
                $kelasTujuan = Kelas::find($kelasTujuanId);
                
                // Validasi tingkat: Kelas 7 -> 8, Kelas 8 -> 9
                if ($siswa->kelas && $kelasTujuan) {
                    if ($siswa->kelas->tingkat == 7 && $kelasTujuan->tingkat != 8) {
                        return back()->with('error', 'Siswa kelas 7 hanya bisa naik ke tingkat 8!');
                    }
                    if ($siswa->kelas->tingkat == 8 && $kelasTujuan->tingkat != 9) {
                        return back()->with('error', 'Siswa kelas 8 hanya bisa naik ke tingkat 9!');
                    }
                    if ($siswa->kelas->tingkat == 9) {
                        return back()->with('error', 'Siswa kelas 9 harus dipindahkan ke menu kelulusan/alumni!');
                    }
                }

                $siswa->update([
                    'kelas_id' => $kelasTujuanId,
                    'status' => 'Aktif'
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Data kenaikan kelas berhasil diproses.');
    }
}