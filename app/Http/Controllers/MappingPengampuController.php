<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MappingPengampu;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Kelas;

class MappingPengampuController extends Controller
{
public function index()
{
    // Mengambil data mapping dan memastikan relasi guru serta mata pelajaran benar-benar ada (tidak kosong/null)
        $mappings = MappingPengampu::with(['guru', 'mataPelajaran', 'kelas'])
        ->orderBy('id', 'asc')
        ->get();

    // Daftar jabatan struktural yang mendapatkan ekuivalensi 12 JP (disesuaikan dengan nilai yang disimpan di database)
    $jabatanEkuivalensi12 = [
        'wakasek kurikulum',
        'wakasek kesiswaan',
        'wakasek sarana & prasarana',
        'pengelola laboratorium',
        'pengelola perpustakaan'
    ];

    // Hitung total JP per guru dari tabel mapping
    $rekapGuru = Guru::all()->map(function($guru) use ($jabatanEkuivalensi12) {
        $totalJp = MappingPengampu::where('guru_id', $guru->id)->sum('jumlah_jp');
        
        // Bersihkan teks jabatan guru dari database untuk dicocokkan
        $jabatanClean = strtolower(trim($guru->jabatan_struktural ?? ''));

        // Cek apakah jabatan guru termasuk dalam daftar ekuivalensi 12 JP
        $punyaTugasTambahan = in_array($jabatanClean, $jabatanEkuivalensi12);
        $batasMaksimal = $punyaTugasTambahan ? 12 : 24;

        // Tentukan status beban
        if ($totalJp == $batasMaksimal) {
            $statusBeban = 'Pas'; // 🟢
        } elseif ($totalJp < $batasMaksimal) {
            $statusBeban = 'Kurang'; // 🟡
        } else {
            $statusBeban = 'Kelebihan'; // 🔴
        }

        return [
            'guru' => $guru,
            'total_jp' => $totalJp,
            'batas_maksimal' => $batasMaksimal,
            'status_beban' => $statusBeban,
            'keterangan_tugas' => $guru->jabatan_struktural ?: 'Guru Mapel Biasa'
            
        ];
        
    });
    
    $mapping = MappingPengampu::with(['guru', 'mataPelajaran', 'kelas'])->get();

    // Perbaikan: Sertakan 'rekapGuru' dan 'mapping' ke dalam compact agar tidak terjadi Undefined Variable
    return view('mapping.index', compact('mappings', 'rekapGuru', 'mapping'));
}


    public function create()
    {
        $gurus = Guru::all();
        $mapels = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('mapping.create', compact('gurus', 'mapels', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'mata_pelajaran_id' => 'required',
            'kelas_id' => 'required',
            'jumlah_jp' => 'required|integer|min:1', // Diubah dari alokasi_jp menjadi jumlah_jp
        ]);

        $existingMapping = MappingPengampu::where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->first();

        if ($existingMapping) {
            return redirect()->back()->withErrors([
                'mata_pelajaran_id' => 'Gagal! Mata pelajaran ini di kelas tersebut sudah diampu oleh ' . $existingMapping->guru->nama . '.'
            ])->withInput();
        }

        MappingPengampu::create($request->all());

        return redirect()->route('mapping.index')->with('success', 'Mapping pengampu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapping = MappingPengampu::findOrFail($id);
        $gurus = Guru::all();
        $mapels = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('mapping.edit', compact('mapping', 'gurus', 'mapels', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guru_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'kelas_id' => 'required',
            'jumlah_jp' => 'required|integer|min:1', // Diubah dari alokasi_jp menjadi jumlah_jp
        ]);

        $existingMapping = MappingPengampu::where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingMapping) {
            return redirect()->back()->withErrors([
                'mata_pelajaran_id' => 'Gagal! Mata pelajaran ini di kelas tersebut sudah diampu oleh guru lain.'
            ])->withInput();
        }

        $mapping = MappingPengampu::findOrFail($id);
        $mapping->update($request->all());

        return redirect()->route('mapping.index')->with('success', 'Mapping pengampu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapping = MappingPengampu::findOrFail($id);
        $mapping->delete();

        return redirect()->route('mapping.index')->with('success', 'Mapping pengampu berhasil dihapus.');
    }
}