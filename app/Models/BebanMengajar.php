<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BebanMengajar extends Model
{
    use HasFactory;

    protected $table = 'beban_mengajar';
    protected $primaryKey = 'id_beban_mengajar';

    protected $fillable = [
        'guru_id',
        'kelas_id',
        'mata_pelajaran_id',
        'jam_per_minggu',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id_mata_pelajaran');
    }
}