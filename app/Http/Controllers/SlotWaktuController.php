<?php

namespace App\Http\Controllers;

use App\Models\SlotWaktu;
use App\Models\JadwalPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SlotWaktuController extends Controller
{
    /**
     * Menampilkan daftar slot waktu berdasarkan hari.
     */
    public function index(Request $request)
    {
        $hariAktif = $request->get('hari', 'Senin');

        $slots = SlotWaktu::where('hari', $hariAktif)
            ->orderBy('urutan', 'asc')
            ->get();

        return view('slot-waktu.index', compact('slots', 'hariAktif'));
    }

    /**
     * Menampilkan form tambah slot waktu.
     */
    public function create(Request $request)
    {
        $hariPilihan = $request->get('hari', 'Senin');

        $urutanSaran = (SlotWaktu::where('hari', $hariPilihan)
            ->max('urutan') ?? 0) + 1;

        $existingSlots = SlotWaktu::where('hari', $hariPilihan)
            ->orderBy('urutan', 'asc')
            ->get();

        return view(
            'slot-waktu.create',
            compact('hariPilihan', 'urutanSaran', 'existingSlots')
        );
    }

    /**
     * Menyimpan slot waktu baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => [
                'required',
                Rule::in([
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                ]),
            ],

            'jam_mulai' => [
                'required',
                'date_format:H:i',
            ],

            'jam_selesai' => [
                'required',
                'date_format:H:i',
                'after:jam_mulai',
            ],

            'jenis' => [
                'required',
                Rule::in(['jp', 'istirahat', 'terkunci']),
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'urutan' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('slot_waktus', 'urutan')
                    ->where(function ($query) use ($request) {
                        return $query->where('hari', $request->hari);
                    }),
            ],
        ], [
            'hari.required' => 'Hari wajib dipilih.',
            'hari.in' => 'Hari yang dipilih tidak valid.',

            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' =>
                'Format jam mulai harus berupa jam dan menit, misalnya 07:15.',

            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' =>
                'Format jam selesai harus berupa jam dan menit, misalnya 07:45.',
            'jam_selesai.after' =>
                'Jam selesai harus lebih besar daripada jam mulai.',

            'jenis.required' => 'Jenis slot wajib dipilih.',
            'jenis.in' => 'Jenis slot tidak valid.',

            'keterangan.max' =>
                'Keterangan maksimal 255 karakter.',

            'urutan.required' => 'Nomor urut wajib diisi.',
            'urutan.integer' => 'Nomor urut harus berupa angka.',
            'urutan.min' => 'Nomor urut minimal 1.',
            'urutan.unique' =>
                'Nomor urut ini sudah digunakan pada hari tersebut.',
        ]);

        // Periksa apakah rentang waktu bertabrakan dengan slot lain.
        if ($this->adaTabrakan(
            $validated['hari'],
            $validated['jam_mulai'],
            $validated['jam_selesai']
        )) {
            return back()
                ->withInput()
                ->withErrors([
                    'jam_mulai' =>
                        'Rentang waktu bertumpang tindih dengan slot lain pada hari '
                        . $validated['hari'] . '.',
                ]);
        }

        SlotWaktu::create($validated);

        return redirect()
            ->route('slot-waktu.index', [
                'hari' => $validated['hari'],
            ])
            ->with('success', 'Slot waktu berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit slot waktu.
     */
    public function edit(SlotWaktu $slotWaktu)
    {
        $existingSlots = SlotWaktu::where('hari', $slotWaktu->hari)
            ->orderBy('urutan', 'asc')
            ->get();

        return view(
            'slot-waktu.edit',
            compact('slotWaktu', 'existingSlots')
        );
    }

    /**
     * Memperbarui slot waktu.
     *
     * Jika slot sudah digunakan dalam jadwal pelajaran,
     * data hari dan jam pada jadwal terkait ikut disinkronkan.
     */
    public function update(Request $request, SlotWaktu $slotWaktu)
    {
        $validated = $request->validate([
            'hari' => [
                'required',
                Rule::in([
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                ]),
            ],

            'jam_mulai' => [
                'required',
                'date_format:H:i',
            ],

            'jam_selesai' => [
                'required',
                'date_format:H:i',
                'after:jam_mulai',
            ],

            'jenis' => [
                'required',
                Rule::in(['jp', 'istirahat', 'terkunci']),
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'urutan' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('slot_waktus', 'urutan')
                    ->where(function ($query) use ($request) {
                        return $query->where('hari', $request->hari);
                    })
                    ->ignore($slotWaktu->getKey()),
            ],
        ], [
            'hari.required' => 'Hari wajib dipilih.',
            'hari.in' => 'Hari yang dipilih tidak valid.',

            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' =>
                'Format jam mulai harus berupa jam dan menit, misalnya 07:15.',

            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' =>
                'Format jam selesai harus berupa jam dan menit, misalnya 07:45.',
            'jam_selesai.after' =>
                'Jam selesai harus lebih besar daripada jam mulai.',

            'jenis.required' => 'Jenis slot wajib dipilih.',
            'jenis.in' => 'Jenis slot tidak valid.',

            'keterangan.max' =>
                'Keterangan maksimal 255 karakter.',

            'urutan.required' => 'Nomor urut wajib diisi.',
            'urutan.integer' => 'Nomor urut harus berupa angka.',
            'urutan.min' => 'Nomor urut minimal 1.',
            'urutan.unique' =>
                'Nomor urut ini sudah digunakan pada hari tersebut.',
        ]);

        // Slot yang sedang diedit tidak dihitung sebagai tabrakan.
        if ($this->adaTabrakan(
            $validated['hari'],
            $validated['jam_mulai'],
            $validated['jam_selesai'],
            $slotWaktu->getKey()
        )) {
            return back()
                ->withInput()
                ->withErrors([
                    'jam_mulai' =>
                        'Perubahan waktu bertumpang tindih dengan slot lain pada hari '
                        . $validated['hari'] . '.',
                ]);
        }

        DB::transaction(function () use ($slotWaktu, $validated) {
            $slotWaktu->update($validated);

            // Sinkronkan salinan hari dan jam pada jadwal yang
            // menggunakan slot ini, tanpa mengubah mapel, guru,
            // kelas, tahun ajaran, atau semester.
            JadwalPelajaran::where(
                'slot_waktu_id',
                $slotWaktu->getKey()
            )->update([
                'hari' => $validated['hari'],
                'jam_mulai' => $validated['jam_mulai'],
                'jam_selesai' => $validated['jam_selesai'],
                'updated_at' => now(),
            ]);
        });

        return redirect()
            ->route('slot-waktu.index', [
                'hari' => $validated['hari'],
            ])
            ->with('success', 'Slot waktu berhasil diperbarui.');
    }

    /**
     * Menghapus slot waktu yang belum digunakan oleh jadwal.
     */
    public function destroy(SlotWaktu $slotWaktu)
    {
        $hari = $slotWaktu->hari;

        $slotDigunakan = JadwalPelajaran::where(
            'slot_waktu_id',
            $slotWaktu->getKey()
        )->exists();

        if ($slotDigunakan) {
            return redirect()
                ->route('slot-waktu.index', ['hari' => $hari])
                ->with(
                    'error',
                    'Slot waktu tidak dapat dihapus karena masih digunakan '
                    . 'oleh jadwal pelajaran. Ubah atau hapus jadwal terkait terlebih dahulu.'
                );
        }

        $slotWaktu->delete();

        return redirect()
            ->route('slot-waktu.index', ['hari' => $hari])
            ->with('success', 'Slot waktu berhasil dihapus.');
    }

    /**
     * Memeriksa apakah rentang waktu bertabrakan dengan slot lain.
     *
     * Slot yang selesai tepat saat slot berikutnya dimulai
     * tidak dianggap bertabrakan.
     *
     * Contoh:
     * 07:15-07:45 dan 07:45-08:25 = diperbolehkan.
     * 07:15-07:50 dan 07:45-08:25 = bertabrakan.
     */
    private function adaTabrakan(
        string $hari,
        string $jamMulai,
        string $jamSelesai,
        $excludeId = null
    ): bool {
        $query = SlotWaktu::where('hari', $hari)
            ->where('jam_mulai', '<', $jamSelesai)
            ->where('jam_selesai', '>', $jamMulai);

        if ($excludeId !== null) {
            $query->where(
                (new SlotWaktu())->getKeyName(),
                '!=',
                $excludeId
            );
        }

        return $query->exists();
    }
}
