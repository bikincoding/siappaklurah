<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KualitasAngkatanKerja extends Model
{
    use HasFactory;

    protected $table = 'kualitas_angkatan_kerjas';

    protected $fillable = [
        'angkatan_kerja',
        'laki_laki',
        'perempuan',
        'id_laporan_bulan_tahuns',
        'id_banjars',
        'created_at',
        'updated_at'
    ];
}
