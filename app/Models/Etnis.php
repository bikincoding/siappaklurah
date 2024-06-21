<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etnis extends Model
{
    use HasFactory;

    protected $table = 'etniss';

    protected $fillable = [
        'etnis',
        'laki_laki',
        'perempuan',
        'id_laporan_bulan_tahuns',
        'id_banjars',
        'created_at',
        'updated_at'
    ];
}
