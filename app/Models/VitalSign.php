<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VitalSign extends Model
{
    use HasFactory;

    protected $table = 'vital_signs';

    protected $fillable = [
        'pendaftaran_id',
        'tekanan_darah',
        'nadi',
        'suhu',
        'pernapasan',
        'berat_badan',
        'tinggi_badan',
        'catatan',
        'perawat_id'
    ];

    protected $casts = [
        'nadi' => 'integer',
        'pernapasan' => 'integer',
        'berat_badan' => 'float',
        'tinggi_badan' => 'float',
        'suhu' => 'float',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function perawat()
    {
        return $this->belongsTo(User::class, 'perawat_id');
    }

    public function getBmiAttribute()
    {
        $berat = $this->berat_badan ?? 0;
        $tinggi = $this->tinggi_badan ?? 0;

        if ($berat <= 0 || $tinggi <= 0) {
            return null;
        }

        $tinggiMeter = $tinggi / 100;
        if ($tinggiMeter <= 0) {
            return null;
        }

        return round($berat / ($tinggiMeter * $tinggiMeter), 2);
    }

    public function getStatusBmiAttribute()
    {
        $bmi = $this->bmi;
        if ($bmi === null) {
            return null;
        }

        if ($bmi < 18.5) return 'Kurus';
        if ($bmi < 25) return 'Normal';
        if ($bmi < 30) return 'Gemuk';
        return 'Obesitas';
    }
}