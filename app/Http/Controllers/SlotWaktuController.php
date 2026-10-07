<?php

namespace App\Http\Controllers;

use App\Models\SlotWaktu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SlotWaktuController extends Controller
{
    public function index(Request $request)
    {
        $hariAktif = $request->get('hari', 'Senin');
        
        $slots = SlotWaktu::where('hari', $hariAktif)
                    ->orderBy('urutan', 'asc')
                    ->get();

        return view('slot-waktu.index', compact('slots', 'hariAktif'));
    }

    public function create(Request $request)
    {
        $hariPilihan = $request->get('hari', 'Senin');
        $urutanSaran = SlotWaktu::where('hari', $hariPilihan)->max('urutan') + 1;

        // Ambil daftar slot yang sudah ada di hari tersebut untuk referensi tampilan
        $existingSlots = SlotWaktu::where('hari', $hariPilihan)->orderBy('urutan', 'asc')->get();

        return view('slot-waktu.create', compact('hariPilihan', 'urutanSaran', 'existingSlots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'jenis' => 'required|in:jp,istirahat,terkunci',
            'keterangan' => 'nullable|string|max:255',
            'urutan' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('slot_waktus')->where(function ($query) use ($request) {
                    return $query->where('hari', $request->hari);
                }),
            ],
        ], [
            'urutan.unique' => 'Gagal! Nomor urut ini sudah terdaftar untuk hari tersebut.',
        ]);

        $hari = $request->hari;
        $jamMulai = $request->jam_mulai;
        $jamSelesai = $request->jam_selesai;

        // Validasi Cek Tabrakan Waktu (Membolehkan jam sambung pas, misal 07:45 bertemu 07:45)
        $adaTabrakan = SlotWaktu::where('hari', $hari)
            ->where('jam_mulai', '<', $jamSelesai)
            ->where('jam_selesai', '>', $jamMulai)
            ->exists();

        if ($adaTabrakan) {
            return back()->withInput()->withErrors([
                'jam_mulai' => 'Gagal! Rentang jam bertumpang tindih (overlap) dengan slot waktu lain di hari ' . $hari . '.'
            ]);
        }

        SlotWaktu::create($request->all());

        return redirect()->route('slot-waktu.index', ['hari' => $request->hari])
                        ->with('success', 'Slot waktu berhasil ditambahkan.');
    }

    public function edit(SlotWaktu $slotWaktu)
    {
        $existingSlots = SlotWaktu::where('hari', $slotWaktu->hari)->orderBy('urutan', 'asc')->get();
        return view('slot-waktu.edit', compact('slotWaktu', 'existingSlots'));
    }

    public function update(Request $request, SlotWaktu $slotWaktu)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'jenis' => 'required|in:jp,istirahat,terkunci',
            'keterangan' => 'nullable|string|max:100',
            'urutan' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('slot_waktus')->where(function ($query) use ($request) {
                    return $query->where('hari', $request->hari);
                })->ignore($slotWaktu->id),
            ],
        ], [
            'urutan.unique' => 'Nomor urut ini sudah digunakan pada hari tersebut.',
        ]);

        $hari = $request->hari;
        $jamMulai = $request->jam_mulai;
        $jamSelesai = $request->jam_selesai;

        $adaTabrakan = SlotWaktu::where('hari', $hari)
            ->where('id', '!=', $slotWaktu->id)
            ->where('jam_mulai', '<', $jamSelesai)
            ->where('jam_selesai', '>', $jamMulai)
            ->exists();

        if ($adaTabrakan) {
            return back()->withInput()->withErrors([
                'jam_mulai' => 'Gagal! Perubahan jam bertumpang tindih dengan slot waktu lain di hari ' . $hari . '.'
            ]);
        }

        $slotWaktu->update($request->all());

        return redirect()->route('slot-waktu.index', ['hari' => $request->hari])
                         ->with('success', 'Slot waktu berhasil diperbarui.');
    }

    public function destroy(SlotWaktu $slotWaktu)
    {
        $hari = $slotWaktu->hari;
        $slotWaktu->delete();

        return redirect()->route('slot-waktu.index', ['hari' => $hari])
                         ->with('success', 'Slot waktu berhasil dihapus.');
    }
}