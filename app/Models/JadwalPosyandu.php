<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_posyandu';
    protected $primaryKey = 'jadwal_id';

    protected $fillable = [
        'posyandu_id',
        'tanggal',
        'tema',
        'keterangan',
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }

    public function layanan()
    {
        return $this->hasMany(LayananPosyandu::class, 'jadwal_id', 'jadwal_id');
    }
}
