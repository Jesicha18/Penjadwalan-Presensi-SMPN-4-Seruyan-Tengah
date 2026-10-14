<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pelajarans';

    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'guru_id',
        'kelas_id',
        'mata_pelajaran_id',
        'slot_waktu_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    // Relasi ke Guru
    public function guru() {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(
            MataPelajaran::class,
            'mata_pelajaran_id',
            'id_mata_pelajaran'
        );
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function slotWaktu()
{
    return $this->belongsTo(SlotWaktu::class, 'slot_waktu_id');
}
    
}