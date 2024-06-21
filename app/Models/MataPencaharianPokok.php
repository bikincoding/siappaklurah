<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPencaharianPokok extends Model
{
    use HasFactory;

    protected $table = 'mata_pencaharian_pokoks';

    protected $fillable = [
        'jenis_pekerjaan',
        'laki_laki',
        'perempuan',
        'id_laporan_bulan_tahuns',
        'id_banjars'
    ];
}
