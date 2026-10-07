<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BebanMengajar;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class BebanMengajarController extends Controller
{
    // Menampilkan daftar beban mengajar
    public function index()
    {
        $bebanList = BebanMengajar::with(['guru', 'kelas', 'mataPelajaran'])
            ->orderBy('kelas_id')
            ->get();

        return view('beban-mengajar.index', compact('bebanList'));
    }

    // Form tambah beban mengajar
    public function create()
    {
        $guruList = Guru::all();
        $kelasList = Kelas::all();
        $mapelList = MataPelajaran::all();

        return view('beban-mengajar.create', compact('guruList', 'kelasList', 'mapelList'));
    }

    // Simpan beban mengajar baru
    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => ['required', 'exists:gurus,id'],
            'kelas_id' => ['required', 'exists:kelas,id_kelas'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajaran,id_mata_pelajaran'],
            'jam_per_minggu' => ['required', 'integer', 'min:1', 'max:40'],
        ]);

        // Cek duplikat kombinasi guru+kelas+mapel
        $sudahAda = BebanMengajar::where('guru_id', $request->guru_id)
            ->where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->exists();

        if ($sudahAda) {
            return back()->withErrors([
                'guru_id' => 'Kombinasi guru, kelas, dan mata pelajaran ini sudah ada. Edit data yang sudah ada jika ingin mengubah jam/minggu.',
            ])->withInput();
        }

        BebanMengajar::create($request->only('guru_id', 'kelas_id', 'mata_pelajaran_id', 'jam_per_minggu'));

        return redirect()->route('beban-mengajar.index')->with('success', 'Beban mengajar berhasil ditambahkan.');
    }

    // Form edit
    public function edit(BebanMengajar $bebanMengajar)
    {
        $guruList = Guru::all();
        $kelasList = Kelas::all();
        $mapelList = MataPelajaran::all();

        return view('beban-mengajar.edit', [
            'beban' => $bebanMengajar,
            'guruList' => $guruList,
            'kelasList' => $kelasList,
            'mapelList' => $mapelList,
        ]);
    }

    // Simpan perubahan
    public function update(Request $request, BebanMengajar $bebanMengajar)
    {
        $request->validate([
            'guru_id' => ['required', 'exists:guru,id_guru'],
            'kelas_id' => ['required', 'exists:kelas,id_kelas'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajaran,id_mata_pelajaran'],
            'jam_per_minggu' => ['required', 'integer', 'min:1', 'max:40'],
        ]);

        $sudahAda = BebanMengajar::where('guru_id', $request->guru_id)
            ->where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->where('id_beban_mengajar', '!=', $bebanMengajar->id_beban_mengajar)
            ->exists();

        if ($sudahAda) {
            return back()->withErrors([
                'guru_id' => 'Kombinasi guru, kelas, dan mata pelajaran ini sudah ada di baris lain.',
            ])->withInput();
        }

        $bebanMengajar->update($request->only('guru_id', 'kelas_id', 'mata_pelajaran_id', 'jam_per_minggu'));

        return redirect()->route('beban-mengajar.index')->with('success', 'Beban mengajar berhasil diperbarui.');
    }

    // Hapus
    public function destroy(BebanMengajar $bebanMengajar)
    {
        $bebanMengajar->delete();

        return redirect()->route('beban-mengajar.index')->with('success', 'Beban mengajar berhasil dihapus.');
    }
}