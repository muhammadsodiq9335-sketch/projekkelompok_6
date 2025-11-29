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
        'perawat_id',
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

    public function perawat()
    {
        return $this->belongsTo(User::class, 'perawat_id');
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

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function resep()
    {
        return $this->hasOne(Resep::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pendaftaran) {
            if (empty($pendaftaran->no_antrian)) {
                $poliCode = strtoupper(substr($pendaftaran->poliklinik, 0, 3));
                // Ensure we use the date from the input, not just today's date
                $dateCode = date('dmy', strtotime($pendaftaran->tanggal_kunjungan));
                $prefix = $poliCode . $dateCode;

                // Find the last number used for this specific prefix
                // We use a raw query for length to ensure we sort correctly (e.g. 10 > 2)
                $lastRecord = static::where('no_antrian', 'like', $prefix . '%')
                    ->orderByRaw('LENGTH(no_antrian) DESC')
                    ->orderBy('no_antrian', 'desc')
                    ->first();

                $nextNumber = 1;
                if ($lastRecord) {
                    // Extract the numeric part after the prefix
                    // e.g. POL281125001 -> 001
                    $lastNumber = (int)substr($lastRecord->no_antrian, strlen($prefix));
                    $nextNumber = $lastNumber + 1;
                }

                $candidate = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

                // Final safety check to ensure uniqueness (in case of race conditions or manual inserts)
                while (static::where('no_antrian', $candidate)->exists()) {
                    $nextNumber++;
                    $candidate = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                }

                $pendaftaran->no_antrian = $candidate;
            }
        });
    }
}