<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_bantuan'];

    public function usulanDanaBantuan()
    {
        return $this->hasMany(UsulanDanaBantuan::class, 'id_bantuans');
    }
}