<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDasarKeluargaDetail extends Model
{
    //use HasFactory;

    protected $table = 'data_dasar_keluarga_details';
    protected $fillable = [
        'id_data_dasar_keluargas', 'nama', 'jenis_kelamin', 'hubungan_dengan_kepala_keluarga', 
        'tempat_lahir', 'tgl_lahir', 'status_perkawinan', 'agama', 
        'golongan_darah', 'kewarganegaraan', 'etnis_suku', 'status'
    ];

    public function keluarga()
    {
        return $this->belongsTo(DataDasarKeluarga::class, 'id_data_dasar_keluargas');
    }

    
}
