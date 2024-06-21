<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulanTahun extends Model
{
    use HasFactory;

    protected $table = 'laporan_bulan_tahuns';

    protected $fillable = [
        'bulan',
        'tahun',
        'status',
        // Other fields
    ];

    public function sumber_daya_manusia()
    {
        return $this->hasMany(SumberDayaManusia::class, 'id_laporan_bulan_tahuns');
    }
}