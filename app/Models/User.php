<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nip',
        'spesialis',
        'phone',
        'alamat',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pasienCreated()
    {
        return $this->hasMany(Pasien::class, 'created_by');
    }

    public function pendaftaranAsPetugas()
    {
        return $this->hasMany(Pendaftaran::class, 'petugas_id');
    }

    public function pendaftaranAsDokter()
    {
        return $this->hasMany(Pendaftaran::class, 'dokter_id');
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class, 'perawat_id');
    }

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'dokter_id');
    }

    public function isPetugas(): bool
    {
        return $this->role === 'petugas';
    }

    public function isPerawat(): bool
    {
        return $this->role === 'perawat';
    }

    public function isDokter(): bool
    {
        return $this->role === 'dokter';
    }
}