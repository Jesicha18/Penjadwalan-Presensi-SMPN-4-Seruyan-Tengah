<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiGuru extends Model
{
    use HasFactory;

    protected $table = 'presensi_gurus';
    protected $primaryKey = 'id_presensi_guru';

    // TAMBAHKAN KODE INI
    protected $fillable = [
        'guru_id',
        'tanggal',
        'status_kehadiran',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }
}