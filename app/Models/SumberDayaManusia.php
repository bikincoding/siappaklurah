<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDayaManusia extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'jumlah_total',
        'jumlah_kepala_keluarga',
        'kepadatan_penduduk',
        // Other fields
    ];

    public function banjar()
    {
        return $this->belongsTo(Banjar::class, 'id_banjars');
    }
    public function laporan_bulan_tahun()
    {
        return $this->belongsTo(LaporanBulanTahun::class, 'id_laporan_bulan_tahuns');
    }
}