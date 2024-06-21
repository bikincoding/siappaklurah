<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;

    protected $table = 'agamas';

    protected $fillable = [
        'agama',
        'laki_laki',
        'perempuan',
        'id_laporan_bulan_tahuns',
        'id_banjars',
        'created_at',
        'updated_at'
    ];
}
