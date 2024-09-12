<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanDanaBantuan extends Model
{
    use HasFactory;

    protected $table = 'usulan_dana_bantuans';
    protected $fillable = ['usulan_ktp','surat_pernyataan_kaling','nama', 'alamat', 'id_bantuans', 'id_banjars', 'status','keterangan', 'id_banjars', 'tgl_musreng'];

    public function banjar()
    {
        return $this->belongsTo(Banjar::class, 'id_banjars');
    }

    public function bantuan()
    {
        return $this->belongsTo(Bantuan::class, 'id_bantuans');
    }

    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Ditolak Permanen';
            case 1:
                return 'Diterima';
            case 2:
                return 'Pengajuan Baru';
            case 3:
                return 'Ditolak Sementara';
            default:
                return 'Status Tidak Diketahui';
        }
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d-m-Y'); // Menggunakan format 'YYYY-MM-DD'
    }

    public function getUsulanKtpAttribute($value)
    {
        return $value ?: 'default-id-card.JPG'; // Jika usulan_ktp kosong, kembalikan 'default.jpg'
    }

    
}