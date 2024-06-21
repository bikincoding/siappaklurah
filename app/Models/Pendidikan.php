<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikans'; // Pastikan ini sesuai dengan nama tabel Anda
    protected $fillable = [
        'tingkatan_pendidikan', 
        'laki_laki', 
        'perempuan', 
        'id_laporan_bulan_tahuns', 
        'id_banjars'
    ];
}
