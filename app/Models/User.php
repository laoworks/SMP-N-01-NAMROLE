<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'foto',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'last_login' => 'datetime',
    ];

    // Relasi: User memiliki banyak log aktivitas
    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class);
    }

    // Relasi: User memverifikasi banyak pendaftar
    public function verifikasiPendaftar(): HasMany
    {
        return $this->hasMany(Pendaftar::class, 'verifikator_id');
    }
}
