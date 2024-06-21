<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'id_kepala_lingkungans',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function banjar()
    {
        return $this->belongsTo(Banjar::class, 'id_banjars');
    }

    public function kepala_lingkungan()
    {
        return $this->belongsTo(KepalaLingkungan::class, 'id_kepala_lingkungans');
    }

    public function hasRole($role)
    {
        // Asumsi peran disimpan dalam kolom 'role' di tabel users
        return $this->role === $role;
    }
    
}