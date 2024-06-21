<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CacatMentalFisik extends Model
{
    use HasFactory;

    protected $table = 'cacat_mental_fisiks';

    protected $fillable = [
        'jenis_cacat',
        'laki_laki',
        'perempuan',
        'id_laporan_bulan_tahuns',
        'id_banjars',
        'created_at',
        'updated_at'
    ];
}
