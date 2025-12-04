<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaderPosyandu extends Model
{
    protected $table      = 'kader_posyandu';
    protected $primaryKey = 'kader_id';

    protected $fillable = [
        'posyandu_id',
        'warga_id',
        'peran',
        'mulai_tugas',
        'akhir_tugas',
    ];
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
