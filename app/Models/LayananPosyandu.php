<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananPosyandu extends Model
{
    use HasFactory;

    protected $table = 'layanan_posyandus'; // nama tabel di database
    protected $primaryKey = 'id';  // primary key

    protected $fillable = [
        'jadwal_id',
        'warga_id',
        'berat',
        'tinggi',
        'vitamin',
        'konseling',
    ];
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
