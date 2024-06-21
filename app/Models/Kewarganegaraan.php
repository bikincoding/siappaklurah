<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kewarganegaraan extends Model
{
    use HasFactory;

    protected $table = 'kewarganegaraans';

    protected $fillable = [
        'kewarganegaraan',
        'laki_laki',
        'perempuan',
        'id_laporan_bulan_tahuns',
        'id_banjars',
        'created_at',
        'updated_at'
    ];
}
