<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiSiswa extends Model
{
    use HasFactory;

    protected $table = 'presensi_siswas';

    protected $fillable = [
        'jadwal_pelajaran_id',
        'siswa_id',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke data siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    /**
     * Relasi ke jadwal pelajaran.
     */
    public function jadwalPelajaran()
    {
        return $this->belongsTo(
            JadwalPelajaran::class,
            'jadwal_pelajaran_id',
            'id'
        );
    }
}
