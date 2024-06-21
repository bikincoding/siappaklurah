<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaLingkungan extends Model
{
    use HasFactory;

    protected $table = 'kepala_lingkungans';
    protected $fillable = ['foto', 'nama_kepala_lingkungan', 'alamat', 'id_banjars', 'telepon'];

    public function banjar()
    {
        return $this->belongsTo(Banjar::class, 'id_banjars');
    }
}
