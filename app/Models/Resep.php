<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';
    protected $fillable = [
        'pendaftaran_id',
        'dokter_id',
        'status',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function details()
    {
        return $this->hasMany(DetailResep::class);
    }
}
