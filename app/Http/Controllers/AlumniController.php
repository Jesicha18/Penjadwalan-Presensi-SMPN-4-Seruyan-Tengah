<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa; // Pastikan model Siswa sudah di-import

class AlumniController extends Controller
{
    /**
     * Menampilkan daftar data alumni.
     */
    public function index(Request $request)
    {
        // Contoh query: Mengambil data siswa yang statusnya sudah 'Lulus'
        // Kamu bisa menyesuaikan kolom 'status' dengan struktur database kamu
        $query = Siswa::where('status', 'Lulus');

        // (Opsional) Fitur Pencarian Nama atau Tahun Lulus
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        // Ambil data dengan pagination (10 data per halaman)
        $alumni = $query->paginate(10);

        // Kirim data ke view resources/views/alumni/index.blade.php
        return view('alumni.index', compact('alumni'));
    }

    /**
     * (Opsional) Menampilkan detail data alumni tertentu
     */
    public function show($id)
    {
        $alumni = Siswa::where('status', 'Lulus')->findOrFail($id);
        return view('alumni.show', compact('alumni'));
    }

    /**
     * (Opsional) Menghapus data alumni
     */
    public function destroy($id)
    {
        $alumni = Siswa::where('status', 'Lulus')->findOrFail($id);
        $alumni->delete();

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil dihapus.');
    }
}