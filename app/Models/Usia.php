<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usia extends Model
{
    use HasFactory;

    protected $fillable = [
        'usia',
        'laki_laki',
        'perempuan',
        'id_laporan_bulan_tahuns',
        'id_banjars'
    ];
}
