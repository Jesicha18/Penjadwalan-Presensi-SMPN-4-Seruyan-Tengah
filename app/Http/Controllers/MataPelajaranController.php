<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;

class MataPelajaranController extends Controller
{
    // Menampilkan daftar mata pelajaran
    public function index()
    {
        $mapelList = MataPelajaran::orderBy('nama_mapel')->get();
        return view('mapel.index', compact('mapelList'));
    }

    // Menampilkan form tambah mata pelajaran
    public function create()
    {
        return view('mapel.create');
    }

    // Menyimpan mata pelajaran baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => ['required', 'string', 'max:20', 'unique:mata_pelajaran,kode_mapel'],
            'nama_mapel' => ['required', 'string', 'max:100'],
        ], [
            'kode_mapel.unique' => 'Kode mapel ini sudah digunakan.',
        ]);

        // Mengambil data input dan menyertakan prioritas_jam_pagi (boolean 1/0)
        $data = $request->only('kode_mapel', 'nama_mapel');
        $data['prioritas_jam_pagi'] = $request->has('prioritas_jam_pagi') ? 1 : 0;

        MataPelajaran::create($data);

        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit(MataPelajaran $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    // Menyimpan perubahan
    public function update(Request $request, MataPelajaran $mapel)
    {
        $request->validate([
            'kode_mapel' => ['required', 'string', 'max:20', 'unique:mata_pelajaran,kode_mapel,' . $mapel->id_mata_pelajaran . ',id_mata_pelajaran'],
            'nama_mapel' => ['required', 'string', 'max:100'],
        ], [
            'kode_mapel.unique' => 'Kode mapel ini sudah digunakan.',
        ]);

        // Mengambil data perubahan dan menyertakan prioritas_jam_pagi (boolean 1/0)
        $data = $request->only('kode_mapel', 'nama_mapel');
        $data['prioritas_jam_pagi'] = $request->has('prioritas_jam_pagi') ? 1 : 0;

        $mapel->update($data);

        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    // Menghapus mata pelajaran
    public function destroy(MataPelajaran $mapel)
    {
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}