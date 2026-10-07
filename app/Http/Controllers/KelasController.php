<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Kelas;
use App\Models\Guru;

class KelasController extends Controller
{
    // Menampilkan daftar kelas
    public function index()
    {
        $kelasList = Kelas::with('guru')->orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('kelas.index', compact('kelasList'));
    }

    // Menampilkan form tambah kelas
    public function create()
    {
        $guruList = Guru::all(); 
        return view('kelas.create', compact('guruList'));
    }

    // Menyimpan kelas baru
    public function store(Request $request)
    {
        // Otomatis hilangkan spasi dan ubah ke huruf kapital (misal: "7 A" menjadi "7A")
        if ($request->has('nama_kelas')) {
            $request->merge([
                'nama_kelas' => strtoupper(str_replace(' ', '', $request->nama_kelas))
            ]);
        }

        $request->validate([
            'tingkat'       => ['required', 'string', 'max:20'],
            // Validasi agar nama kelas tidak boleh duplikat pada tingkat yang sama
            'nama_kelas'    => [
                'required', 
                'string', 
                'max:50', 
                Rule::unique('kelas')->where(function ($query) use ($request) {
                    return $query->where('tingkat', $request->tingkat);
                }),
            ],
            // Validasi unique menggunakan wali_kelas_id (satu guru satu kelas)
            'wali_kelas_id' => ['nullable', 'exists:gurus,id', 'unique:kelas,wali_kelas_id'],
        ], [
            'nama_kelas.unique'    => 'Kelas dengan nama tersebut sudah ada pada tingkat ini! Tidak boleh ada kelas kembar.',
            'wali_kelas_id.unique' => 'Guru ini sudah menjadi wali kelas di kelas lain! Satu guru hanya boleh memegang satu kelas.',
        ]);

        Kelas::create([
            'nama_kelas'    => $request->nama_kelas,
            'tingkat'       => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id,
            'is_active'     => true, // Default aktif saat dibuat baru
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id_kelas)
    {
        // Ambil data kelas berdasarkan id_kelas
        $kelas = Kelas::findOrFail($id_kelas);

        // Ambil semua data guru untuk pilihan di dropdown wali kelas
        $guruList = Guru::all(); 

        // Kirim variabel $kelas dan $guruList ke view
        return view('kelas.edit', compact('kelas', 'guruList'));
    }

    // Menyimpan perubahan
    public function update(Request $request, $id_kelas)
    {
        // Otomatis hilangkan spasi dan ubah ke huruf kapital saat update
        if ($request->has('nama_kelas')) {
            $request->merge([
                'nama_kelas' => strtoupper(str_replace(' ', '', $request->nama_kelas))
            ]);
        }

        $request->validate([
            'tingkat'       => ['required', 'string', 'max:20'],
            // Validasi unique nama kelas per tingkat, abaikan data milik ID yang sedang diedit
            'nama_kelas'    => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('kelas', 'nama_kelas')->ignore($id_kelas, 'id_kelas')->where(function ($query) use ($request) {
                    return $query->where('tingkat', $request->tingkat);
                }),
            ],
            // Perbaikan: Menggunakan wali_kelas_id dan mengabaikan id_kelas yang sedang diedit
            'wali_kelas_id' => 'nullable|exists:gurus,id|unique:kelas,wali_kelas_id,' . $id_kelas . ',id_kelas',
        ], [
            'nama_kelas.unique'    => 'Kelas dengan nama tersebut sudah ada pada tingkat ini! Tidak boleh ada kelas kembar.',
            'wali_kelas_id.unique' => 'Guru ini sudah menjadi wali kelas di kelas lain! Satu guru hanya boleh memegang satu kelas.',
        ]);

        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->update([
            'nama_kelas'    => $request->nama_kelas,
            'tingkat'       => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id, // Menyimpan 1 wali kelas untuk 1 kelas
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    // Fitur Nonaktifkan / Aktifkan Kelas (Alternatif selain hapus permanen)
    public function toggleStatus(Kelas $kelas)
    {
        // Membalik status aktif (jika true jadi false, jika false jadi true)
        $kelas->is_active = !$kelas->is_active;
        $kelas->save();

        $statusText = $kelas->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('kelas.index')->with('success', "Kelas berhasil {$statusText}.");
    }

    // Menghapus kelas (opsional, jika benar-benar ingin dihapus permanen)
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus permanen.');
    }
}