<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'no_antrian',
        'pasien_id',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'poliklinik',
        'dokter_id',
        'keluhan',
        'jenis_kunjungan',
        'status',
        'petugas_id'
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function vitalSign()
    {
        return $this->hasOne(VitalSign::class);
    }

    public function pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pendaftaran) {
            if (empty($pendaftaran->no_antrian)) {
                $lastAntrian = static::whereDate('tanggal_kunjungan', $pendaftaran->tanggal_kunjungan)
                    ->where('poliklinik', $pendaftaran->poliklinik)
                    ->latest('id')
                    ->first();
                
                $nextNumber = $lastAntrian ? ((int)substr($lastAntrian->no_antrian, -3)) + 1 : 1;
                $poliCode = strtoupper(substr($pendaftaran->poliklinik, 0, 3));
                $pendaftaran->no_antrian = $poliCode . date('dmy') . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}