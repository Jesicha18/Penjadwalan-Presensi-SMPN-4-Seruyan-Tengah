<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotWaktu extends Model
{
    use HasFactory;

    protected $table = 'slot_waktus';
    
    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'jenis',
        'keterangan',
        'urutan'
    ];
}