<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDasarKeluarga extends Model
{
    //use HasFactory;

    protected $table = 'data_dasar_keluargas';
    protected $fillable = ['no_kartu_keluarga','id_banjars', 'alamat'];

    public function details()
    {
        return $this->hasMany(DataDasarKeluargaDetail::class, 'id_data_dasar_keluargas');
    }

    public function banjar()
    {
        return $this->belongsTo(Banjar::class, 'id_banjars');
    }
}
