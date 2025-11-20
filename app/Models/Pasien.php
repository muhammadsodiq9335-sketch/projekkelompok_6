<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'no_rm',
        'no_ktp',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'email',
        'jenis_pasien',
        'no_bpjs',
        'golongan_darah',
        'riwayat_alergi',
        'created_by'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir ? Carbon::parse($this->tanggal_lahir)->age : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pasien) {
            if (empty($pasien->no_rm)) {
                $lastPasien = static::latest('id')->first();
                $nextId = $lastPasien ? $lastPasien->id + 1 : 1;
                $pasien->no_rm = 'RM' . date('Ym') . str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}