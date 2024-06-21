<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model
    protected $table = 'pegawais';

    // Primary key tabel
    protected $primaryKey = 'id';

    // Fields yang boleh diisi
    protected $fillable = [
        'foto_pegawai',
        'nama_pegawai',
        'nip',
        'jabatan',
        'pangkat_golongan',
        'alamat',
        'tgl_lahir',
        'no_ktp',
        'npwp',
        'no_karpeg',
        'no_rek',
        'email',
        'telp',
        'golongan_darah'
    ];

    // Fields yang disembunyikan dari array dan JSON
    protected $hidden = [];

    // Casts, untuk konversi tipe data otomatis
    protected $casts = [
        'tgl_lahir' => 'date',
    ];
}