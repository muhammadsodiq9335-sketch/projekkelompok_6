<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';

    protected $fillable = [
        'pendaftaran_id',
        'anamnesis',
        'pemeriksaan_fisik',
        'diagnosis_utama',
        'diagnosis_tambahan',
        'tindakan',
        'resep_obat',
        'catatan_dokter',
        'rencana_tindak_lanjut',
        'tanggal_kontrol',
        'dokter_id'
    ];

    protected $casts = [
        'tanggal_kontrol' => 'date',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function resep()
    {
        return $this->hasOne(Resep::class, 'pendaftaran_id', 'pendaftaran_id');
    }
}